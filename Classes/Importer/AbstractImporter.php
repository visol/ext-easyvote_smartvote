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
use TYPO3\CMS\Core\Utility\GeneralUtility;
use Visol\EasyvoteSmartvote\Domain\Model\Election;
use Visol\EasyvoteSmartvote\Enumeration\Language;
use Visol\EasyvoteSmartvote\Enumeration\Model;

/**
 * Import Data from SmartVote
 */
abstract class AbstractImporter implements ImporterInterface {

	/**
	 * @var string
	 */
	protected $baseUrl = 'http://smartvote.ch/api/1.0';

	/**
	 * @var string
	 */
	protected $key = 'be9bbde6c7ee3adf6ab93803da1de736';

	/**
	 * @var array
	 */
	protected $models = array(
		Model::PARTY => 'parties.json',
		Model::CANDIDATE => 'candidates.json',
		Model::DISTRICT => 'constituencies.json',
		Model::QUESTION => 'questions.json',
		Model::QUESTION_CATEGORY => 'categories.json',
		Model::DENOMINATION => 'denominations.json',
		Model::CIVIL_STATE => 'civilStates.json',
		Model::EDUCATION => 'educations.json',
	);

	/**
	 * @var
	 */
	protected $tableName = '';

	/**
	 * @var
	 */
	protected $internalIdentifier = '';

	/**
	 * @var Election
	 */
	protected $election;

	/**
	 * @var
	 */
	protected $mappingFields = array();

	/**
	 * @param Election $election
	 */
	public function __construct(Election $election){
		$this->election = $election;
	}

	/**
	 * Import the
	 *
	 * @param string $dataType
	 * @return int
	 */
	public function import($dataType = '') {

		$items = $this->getItemsFromDatasource($dataType);

		$counter = 0;
		foreach ($items as $item) {
			if (!$this->itemExists($item)) {
				$this->createItem($item);
			}

			$this->updateItem($item);
			$counter++;
		}

		return $counter;
	}

	/**
	 * @param string $modelType
	 * @return array
	 */
	protected function getItemsFromDatasource($modelType) {
		$url = $this->getUrl($this->election->getSmartVoteIdentifier(), $modelType, Language::GERMAN);

		$items = array();
		try {
			$data = file_get_contents($url);
			$items = json_decode($data, TRUE);
		} catch(\Exception $e) {
			$this->getLogger()->alert('I could not load SmartVote data given the URL', $url);

		}
		return $items;
	}

	/**
	 * @param array $item
	 * @return bool
	 */
	protected function itemExists(array $item) {

		$clause = sprintf(
			'internal_identifier = "%s" AND election = %s',
			$item[$this->internalIdentifier],
			$this->election->getUid()
		);
		$clause .= BackendUtility::deleteClause($this->tableName);

		$record = $this->getDatabaseConnection()->exec_SELECTgetSingleRow('uid', $this->tableName, $clause);
		return !empty($record);
	}

	/**
	 * @param array $item
	 * @return bool
	 */
	protected function createItem(array $item) {
		$values['internal_identifier'] = $item[$this->internalIdentifier];
		$values['crdate'] = time();
		$values['election'] = $this->election->getUid();

		$result = $this->getDatabaseConnection()->exec_INSERTquery($this->tableName, $values);
		if (!$result) {
			$query = $result = $this->getDatabaseConnection()->INSERTquery($this->tableName, $values);

			$message = 'SQL query failed when importing data from SmartVote - ERROR 1429115031';
			print $message . chr(10) . chr(10);
			$this->getLogger()->error($message, array($query));
			die($query);
		}
	}

	/**
	 * @param array $item
	 * @return bool
	 */
	protected function updateItem(array $item) {

		$values = array();
		foreach ($this->mappingFields as $key => $field) {
			if (isset($item[$key]) && is_scalar($item[$key])) {
				$values[$this->mappingFields[$key]] = $item[$key];
			}
		}

		// Automatic values
		$values['election'] = $this->election->getUid();
		$values['tstamp'] = time();
		$values['pid'] = '276';

		$clause = sprintf(
			'internal_identifier = "%s" AND election = %s',
			$item[$this->internalIdentifier],
			$this->election->getUid()
		);

		$clause .= BackendUtility::deleteClause($this->tableName);
		$result = $this->getDatabaseConnection()->exec_UPDATEquery($this->tableName, $clause, $values);
		if (!$result) {
			$query = $this->getDatabaseConnection()->UPDATEquery($this->tableName, $clause, $values);

			$message = 'SQL query failed when importing data from SmartVote - ERROR 1429115032';
			print $message . chr(10) . chr(10);
			$this->getLogger()->error($message, array($query));
			die($query);
		}
	}

	/**
	 * @param string $smartVoteIdentifier
	 * @param string $modelType
	 * @param string $locale
	 * @return string
	 */
	protected function getUrl($smartVoteIdentifier, $modelType, $locale) {

		$segments[] = $smartVoteIdentifier;
		$segments[] = $this->models[$modelType];

		$arguments[] = 'lang=' . $locale;
		$arguments[] = 'key=' . $this->key;

		$url = sprintf(
			'%s/%s?%s',
			$this->baseUrl,
			implode('/', $segments),
			implode('&', $arguments)
		);

		return $url;
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
	 * @return \TYPO3\CMS\Core\Log\Logger
	 */
	protected function getLogger(){

		/** @var $loggerManager \TYPO3\CMS\Core\Log\LogManager */
		$loggerManager = GeneralUtility::makeInstance('TYPO3\CMS\Core\Log\LogManager');

		/** @var $logger \TYPO3\CMS\Core\Log\Logger */
		return $loggerManager->getLogger(get_class($this));
	}

}
