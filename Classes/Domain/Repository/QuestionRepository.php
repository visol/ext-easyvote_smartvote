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
	public function findByElection(Election $election) {
		/*
		 * Note: In TYPO3, if you need language overlays, you cannot use queries with joins. Therefore both the
		 * question and the question category are fetched, overlaid and then the join is done manually.
		 */

		// Fetch the question categories and do the overlay
		$questionCategoryTable = 'tx_easyvotesmartvote_domain_model_questioncategory';
		$clause = 'election = ' . $election->getUid();
		$clause .= ' AND (sys_language_uid IN (-1,0) OR (sys_language_uid = ' . $GLOBALS['TSFE']->sys_language_uid. ' AND l10n_parent = 0))';
		$clause .= $this->getPageRepository()->deleteClause($questionCategoryTable);
		$clause .= $this->getPageRepository()->enableFields($questionCategoryTable);
		$fields = 'uid, pid, sys_language_uid, name';
		$questionCategories = $this->getDatabaseConnection()->exec_SELECTgetRows($fields, $questionCategoryTable, $clause, NULL, NULL, NULL, 'uid');
		if (count($questionCategories)) {
			foreach ($questionCategories as $key => $row) {
				$questionCategories[$key] = $this->getPageRepository()->getRecordOverlay($questionCategoryTable, $row, $GLOBALS['TSFE']->sys_language_content, $GLOBALS['TSFE']->sys_language_contentOL);
			}
		}

		// Fetch the questions, do the overlay and enrich with the questionCategory name
		$questionTable = 'tx_easyvotesmartvote_domain_model_question';
		$clause = 'election = ' . $election->getUid();
		$clause .= ' AND (sys_language_uid IN (-1,0) OR (sys_language_uid = ' . $GLOBALS['TSFE']->sys_language_uid. ' AND l10n_parent = 0))';
		$clause .= $this->getPageRepository()->deleteClause($questionTable);
		$clause .= $this->getPageRepository()->enableFields($questionTable);
		$fields = 'uid, pid, sys_language_uid, name, category,
			cleavage1, cleavage2, cleavage3, cleavage4, cleavage5, cleavage6, cleavage7, cleavage8,
			alternative_uid, type, rapide';
		$questions = $this->getDatabaseConnection()->exec_SELECTgetRows($fields, $questionTable, $clause, '', 'rapide DESC, uid ASC');
		if (count($questions)) {
			foreach ($questions as $key => $row) {
				$questions[$key] = $this->getPageRepository()->getRecordOverlay($questionTable, $row, $GLOBALS['TSFE']->sys_language_content, $GLOBALS['TSFE']->sys_language_contentOL);
				if (array_key_exists($row['category'], $questionCategories)) {
					$questions[$key]['categoryName'] = $questionCategories[$row['category']]['name'];
				} else {
					$questions[$key]['categoryName'] = '';
				}
			}
		}
		return $questions;

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