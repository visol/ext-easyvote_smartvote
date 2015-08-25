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
	 * @param Election $election
	 * @return array|NULL
	 */
	public function findByElection(Election $election){

		$tableName = 'tx_easyvotesmartvote_domain_model_candidate';

		$clause = 'election = ' . $election->getUid();
		$clause .= $this->getDeleteClauseAndEnableFieldsConstraint($tableName);

		$fields = ' uid, pid, first_name, last_name, gender, year_of_birth, city, national_party,
		            incumbent, slogan, party_short, district, serialized_answers, election_list_name,
		            serialized_spider_values, serialized_photos, photo_cached_remote_filesize,
		            serialized_list_places';
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