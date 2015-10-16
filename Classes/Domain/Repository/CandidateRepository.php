<?php
namespace Visol\EasyvoteSmartvote\Domain\Repository;

/**
 * This file is part of the TYPO3 CMS project.
 *
 * It is free software; you can redistribute it and/or modify it under
 * the terms of the GNU General Public License, either version 2
 * of the License, or any later version.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 * The TYPO3 project - inspiring people to share!
 */

use TYPO3\CMS\Backend\Utility\BackendUtility;
use TYPO3\CMS\Extbase\Persistence\Repository;
use Visol\EasyvoteSmartvote\Domain\Model\Election;

/**
 * The repository for Candidates
 */
class CandidateRepository extends Repository {

	/**
	 * [!!!] Only use in Frontend Context
	 *
	 * @param Election $election
	 * @param int $district
	 * @param int $nationalParty
	 * @param int $persona
	 * @param int $elected
	 * @param int $deselected
	 * @return array|NULL
	 */
	public function findByElection(Election $election, $district = 0, $nationalParty = 0, $persona = 0, $elected = 0, $deselected = 0) {

		// Fetch the parties and do the overlay
		$partyTable = 'tx_easyvotesmartvote_domain_model_party';
		$clause = 'election = ' . $election->getUid();
		$clause .= ' AND (sys_language_uid IN (-1,0) OR (sys_language_uid = ' . $GLOBALS['TSFE']->sys_language_uid. ' AND l10n_parent = 0))';
		$clause .= $this->getPageRepository()->deleteClause($partyTable);
		$clause .= $this->getPageRepository()->enableFields($partyTable);
		$fields = 'uid, pid, sys_language_uid, name';
		$parties = $this->getDatabaseConnection()->exec_SELECTgetRows($fields, $partyTable, $clause, NULL, NULL, NULL, 'uid');
		if (count($parties)) {
			foreach ($parties as $key => $row) {
				$parties[$key] = $this->getPageRepository()->getRecordOverlay($partyTable, $row, $GLOBALS['TSFE']->sys_language_content, $GLOBALS['TSFE']->sys_language_contentOL);
			}
		}

		// Fetch the educations and do the overlay
		$educationTable = 'tx_easyvotesmartvote_domain_model_education';
		$clause = 'election = ' . $election->getUid();
		$clause .= ' AND (sys_language_uid IN (-1,0) OR (sys_language_uid = ' . $GLOBALS['TSFE']->sys_language_uid. ' AND l10n_parent = 0))';
		$clause .= $this->getPageRepository()->deleteClause($educationTable);
		$clause .= $this->getPageRepository()->enableFields($educationTable);
		$fields = 'uid, pid, sys_language_uid, name';
		$educations = $this->getDatabaseConnection()->exec_SELECTgetRows($fields, $educationTable, $clause, NULL, NULL, NULL, 'uid');
		if (count($educations)) {
			foreach ($educations as $key => $row) {
				$educations[$key] = $this->getPageRepository()->getRecordOverlay($educationTable, $row, $GLOBALS['TSFE']->sys_language_content, $GLOBALS['TSFE']->sys_language_contentOL);
			}
		}

		// Fetch cantonAbbreviation for each district
		$sql = 'SELECT district.uid, kanton.abbreviation AS canton_abbreviation
			FROM tx_easyvotesmartvote_domain_model_district AS district
			JOIN tx_easyvote_domain_model_kanton AS kanton ON district.canton = kanton.uid;';
		$res = $this->getDatabaseConnection()->sql_query($sql);
		$cantonForDistricts = array();
		while ($row = $this->getDatabaseConnection()->sql_fetch_assoc($res)) {
			$cantonForDistricts[$row['uid']] = $row['canton_abbreviation'];
		}

		// Fetch the candidates
		$tableName = 'tx_easyvotesmartvote_domain_model_candidate';

		$clause = 'election = ' . $election->getUid();
		$clause .= $this->getDeleteClauseAndEnableFieldsConstraint($tableName);

		if ($district > 0) {
			$clause .= ' AND district = ' . $district;
		}

		if ($nationalParty > 0) {
			$clause .= ' AND national_party = ' . $nationalParty;
		}

		if ($persona !== 0) {
			$clause .= ' AND persona = \'' . $persona . '\'';
		}

		if ($elected !== 0) {
			$clause .= ' AND elected';
		}

		if ($deselected !== 0) {
			$clause .= ' AND deselected';
		}

		$fields = ' uid, pid, first_name, last_name, gender, year_of_birth, city, national_party,
		            incumbent, elected, deselected, slogan, district, serialized_answers_processed, election_list_name,
		            serialized_spider_values, serialized_photos, photo_cached_remote_filesize,
		            serialized_list_places, occupation, education, hobbies, personal_website,
		            link_to_twitter,link_to_facebook,email,ch2055,motivation, easyvote_supporter,
		            polittalk_participant, persona, party';
		$candidates = $this->getDatabaseConnection()->exec_SELECTgetRows($fields, $tableName, $clause, '', 'uid ASC');

		// Add the overlaid partyName, educationName and cantonAbbreviation to the candidates
		if (count($candidates)) {
			foreach ($candidates as $key => $row) {
				if (array_key_exists($row['party'], $parties)) {
					$candidates[$key]['party_name'] = $parties[$row['party']]['name'];
				} else {
					$candidates[$key]['party_name'] = '';
				}
				if (array_key_exists($row['education'], $educations)) {
					$candidates[$key]['education_name'] = $educations[$row['education']]['name'];
				} else {
					$candidates[$key]['education_name'] = '';
				}
				if (array_key_exists($row['district'], $cantonForDistricts)) {
					$candidates[$key]['canton_abbreviation'] = strtolower($cantonForDistricts[$row['district']]);
				} else {
					$candidates[$key]['canton_abbreviation'] = '';
				}
			}
		}

		return $candidates;

	}

	/**
	 * Find all candidates for an election
	 * Ignore frontend constraint (e.g. language)
	 *
	 * @param Election $election
	 * @return array|NULL
	 */
	public function findByElectionIgnoreFrontend(Election $election) {
		// Fetch the candidates
		$tableName = 'tx_easyvotesmartvote_domain_model_candidate';

		$clause = 'election = ' . $election->getUid();
		$clause .= $this->getDeleteClauseAndEnableFieldsConstraint($tableName);

		$fields = ' uid, pid, first_name, last_name, gender, year_of_birth, city, national_party,
		            incumbent, slogan, district, serialized_answers_processed, election_list_name,
		            serialized_spider_values, serialized_photos, photo_cached_remote_filesize,
		            serialized_list_places, occupation, education, hobbies, personal_website,
		            link_to_twitter,link_to_facebook,email,ch2055,motivation, easyvote_supporter,
		            polittalk_participant, persona, party';
		return $this->getDatabaseConnection()->exec_SELECTgetRows($fields, $tableName, $clause, '', 'uid ASC');
	}

	/**
	 * Build the enableFields constraint based on the current TYPO3 mode
	 * PageRepository is not available in CLI/Backend context
	 *
	 * @param $tableName
	 * @return string
	 */
	protected function getDeleteClauseAndEnableFieldsConstraint($tableName) {
		if (TYPO3_MODE === 'FE') {
			return $this->getPageRepository()->deleteClause($tableName) .
				$this->getPageRepository()->enableFields($tableName);
		} else {
			return BackendUtility::deleteClause($tableName);
		}
	}

	/**
	 * Finds all candidate and returns an Extbase ObjectStorage
	 *
	 * @param Election $election
	 * @return array|\TYPO3\CMS\Extbase\Persistence\QueryResultInterface
	 */
	public function findByElectionReturnObjectStorage(Election $election) {
		$query = $this->createQuery();
		$query->getQuerySettings()->setRespectStoragePage(FALSE);
		$query->matching(
			$query->equals('election', $election)
		);
		return $query->execute();
	}

	/**
	 * Returns a pointer to the database.
	 *
	 * @return \TYPO3\CMS\Core\Database\DatabaseConnection
	 */
	protected function getDatabaseConnection() {
		return $GLOBALS['TYPO3_DB'];
	}

	/**
	 * Returns an instance of the page repository.
	 *
	 * @return \TYPO3\CMS\Frontend\Page\PageRepository
	 */
	protected function getPageRepository() {
		return $GLOBALS['TSFE']->sys_page;
	}

}