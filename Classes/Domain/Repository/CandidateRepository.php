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
		$clause .= $this->getPageRepository()->deleteClause($tableName);
		$clause .= $this->getPageRepository()->enableFields($tableName);

		$fields = ' uid, first_name, last_name, gender, year_of_birth, city,
		            elected, slogan, party_short, serialized_answers,
		            serialized_spider_values, serialized_photos';
		return $this->getDatabaseConnection()->exec_SELECTgetRows($fields, $tableName, $clause, '', 'uid ASC');
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