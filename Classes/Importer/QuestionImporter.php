<?php
namespace Visol\EasyvoteSmartvote\Importer;

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
use Visol\EasyvoteSmartvote\Domain\Model\Election;
use Visol\EasyvoteSmartvote\Enumeration\Language;
use Visol\EasyvoteSmartvote\Enumeration\Model;

/**
 * Import Questions from the SmartVote platform.
 */
class QuestionImporter extends AbstractImporter {

	/**
	 * @var
	 */
	protected $tableName = 'tx_easyvotesmartvote_domain_model_question';

	/**
	 * @var
	 */
	protected $internalIdentifier = 'ID_question';

	/**
	 * @var array
	 */
	protected $relations = array(
		'category' => array(
			'localField' => 'category',
			'foreignTable' => 'tx_easyvotesmartvote_domain_model_questioncategory',
		),
	);

	/**
	 * @var
	 */
	protected $mappingFields = array(
		'question' => 'name',
//		'category' => 'category', -> relation
		'group' => 'groupping',
		'type' => 'type',
		'rapide' => 'rapide',
		'edu' => 'education',
		'cleavage_1' => 'cleavage1',
		'cleavage_2' => 'cleavage2',
		'cleavage_3' => 'cleavage3',
		'cleavage_4' => 'cleavage4',
		'cleavage_5' => 'cleavage5',
		'cleavage_6' => 'cleavage6',
		'cleavage_7' => 'cleavage7',
		'cleavage_8' => 'cleavage8',
		'info' => 'info',
		'pro' => 'pro',
		'contra' => 'contra'
	);

	/**
	 * Import the Questions
	 *
	 * @return array
	 */
	public function import() {
		$collectedData = parent::import(Model::QUESTION);

		$this->postProcessAlternativeIdentifier();
		$this->postProcessTotalCleavage();

		return $collectedData;
	}

	/**
	 * @return array
	 */
	public function localize() {
		$collectedData =  parent::localize(Model::QUESTION);

		foreach ($this->typo3Languages as $languageUid) {
			$this->postProcessAlternativeIdentifier($languageUid);
			$this->postProcessTotalCleavage($languageUid);
		}

		return $collectedData;
	}

	/**
	 * Post-process the questions to compute alternative identifier
	 *
	 * @param int $languageUid
	 * @return void
	 */
	protected function postProcessAlternativeIdentifier($languageUid = 0) {

		$relatedElection = $this->election->getRelatedElection();
		if ($relatedElection) {

			$clause = sprintf('election = %s AND sys_language_uid = %s', $this->election->getUid(), $languageUid);
			$clause .= BackendUtility::deleteClause($this->tableName);
			$questions = $this->getDatabaseConnection()->exec_SELECTgetRows('uid, name', $this->tableName, $clause);

			// Loop around the questions and for each question retrieve the alternate question uid.
			array_map(
				function ($question) use ($languageUid) {

					// Find a possible related question.
					$relatedElection = $this->election->getRelatedElection();
					$clause = sprintf('election = %s AND name = "%s" AND sys_language_uid = %s', $relatedElection->getUid(), addslashes($question['name']), $languageUid);
					$clause .= BackendUtility::deleteClause($this->tableName);
					$relatedQuestion = $this->getDatabaseConnection()->exec_SELECTgetSingleRow('uid, l10n_parent', $this->tableName, $clause);

					if (empty($relatedQuestion)) {
						throw new \Exception('I could not determine a related question. Fix me otherwise data may be inconsistent', 1435737286);
					}

					// Update the question with the alternative uid
					$clause = sprintf('uid = %s AND sys_language_uid = %s', $question['uid'], $languageUid);
					$clause .= BackendUtility::deleteClause($this->tableName);
					if ($languageUid > 0) {
						// Relations must always be to the default version of a record, so we use the l10n_parent here
						$values = ['alternative_uid' => $relatedQuestion['l10n_parent']];
					} else {
						$values = ['alternative_uid' => $relatedQuestion['uid']];
					}
					$this->getDatabaseConnection()->exec_UPDATEquery($this->tableName, $clause, $values);
				},
				$questions
			);
		}
	}

	/**
	 * Post-process the questions to compute the total cleavage.
	 *
	 * @param int $languageUid
	 * @return void
	 */
	protected function postProcessTotalCleavage($languageUid = 0) {
		$values = array();
		for ($index = 1; $index <= 8; $index++) {

			$clause = sprintf('cleavage%s != 0 AND election = %s AND sys_language_uid = %s', $index, $this->election->getUid(), $languageUid);
			$clause .= BackendUtility::deleteClause($this->tableName);
			$totalCleavage = $this->getDatabaseConnection()->exec_SELECTcountRows('cleavage' . $index, $this->tableName, $clause);
			$values['total_cleavage' . $index] = $totalCleavage;
		}

		$this->getDatabaseConnection()->exec_UPDATEquery(
			'tx_easyvotesmartvote_domain_model_election',
			'uid = ' . $this->election->getUid() . ' AND sys_language_uid = ' . $languageUid,
			$values
		);
	}

}
