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
use TYPO3\CMS\Frontend\Page\PageRepository;
use Visol\EasyvoteSmartvote\Domain\Model\Election;

/**
 * The repository for Questions
 */
class QuestionRepository extends Repository {

	/**
	 * @param Election $election
	 * @return array|NULL
	 */
	public function findByElection(Election $election){
		$tableName = 'tx_easyvotesmartvote_domain_model_question';
		$tableNameAndJoin = 'tx_easyvotesmartvote_domain_model_question
			JOIN tx_easyvotesmartvote_domain_model_questioncategory AS cat
			ON tx_easyvotesmartvote_domain_model_question.category = cat.uid';
		$clause = 'tx_easyvotesmartvote_domain_model_question.election = ' . $election->getUid();
		$clause .= $this->getPageRepository()->deleteClause($tableName);
		$clause .= $this->getPageRepository()->enableFields($tableName);

		$fields = 'tx_easyvotesmartvote_domain_model_question.uid, tx_easyvotesmartvote_domain_model_question.name,
			cleavage1, cleavage2, cleavage3, cleavage4, cleavage5, cleavage6, cleavage7, cleavage8,
			cat.name as category_name, alternative_uid, type';

		return $this->getDatabaseConnection()->exec_SELECTgetRows($fields, $tableNameAndJoin, $clause, '', 'uid ASC');
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
	 * @return PageRepository
	 */
	protected function getPageRepository() {
		return $GLOBALS['TSFE']->sys_page;
	}

}