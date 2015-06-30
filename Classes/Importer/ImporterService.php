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
 * Importer service
 */
class ImporterService {

	/**
	 * @var Election
	 */
	protected $election;

	/**
	 * @var array
	 */
	protected $logs = array();

	/**
	 * @var bool
	 */
	protected $verbose;

	/**
	 * Constructor
	 *
	 * @param Election $election
	 */
	public function __construct(Election $election){
		$this->election = $election;
	}

	/**
	 * @param bool $verbose
	 * @return array
	 */
	public function import($verbose = FALSE) {

		$this->verbose = $verbose;

		$this->importFor('Denomination');
		$this->importFor('CivilState');
		$this->importFor('Education');
		$this->importFor('District');
		$this->importFor('ElectionList');
		$this->importFor('Party');
		$this->importFor('QuestionCategory');
		$this->importFor('Question');
		$this->importFor('Candidate');

		return $this->logs;
	}

	/**
	 * @param string $dataType
	 */
	protected function importFor($dataType){

		$log = sprintf('Importing %s... ', $dataType);

		/** @var ImporterInterface $importer */
		$className = sprintf('Visol\EasyvoteSmartvote\Importer\%sImporter', $dataType);
		$importer = GeneralUtility::makeInstance($className, $this->election);

		$collectedData = $importer->import();
		$this->log(sprintf($log . '%s', $collectedData['numberOfItems']));

		if ($this->verbose) {
			$this->log(sprintf('  -> %s', $collectedData['url']));
		}
	}

	/**
	 * @param string $log
	 * @return void
	 */
	protected function log($log){
		$this->logs[] = $log . "\n";
	}

}
