<?php
namespace Visol\EasyvoteSmartvote\Command;

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

use TYPO3\CMS\Extbase\Mvc\Controller\CommandController;
use Visol\EasyvoteSmartvote\Domain\Model\Election;
use Visol\EasyvoteSmartvote\Importer\ImporterInterface;

/**
 * Command Controller which imports the Postal Box as voting location.
 */
class SmartVoteCommandController extends CommandController {

	/**
	 * @var \Visol\EasyvoteSmartvote\Domain\Repository\ElectionRepository
	 * @inject
	 */
	protected $electionRepository;

	/**
	 * @var bool
	 */
	protected $verbose;

	/**
	 * Import a bunch of data form SmartVote using its API.
	 *
	 * @param bool $verbose
	 */
	public function importCommand($verbose = FALSE) {

		$this->verbose = $verbose;

		$elections = $this->electionRepository->findAll();

		foreach ($elections as $election) {

			/** @var $election Election */
			$this->outputLine('***********************************************');
			$this->outputLine('Smart Vote identifier: ' . $election->getSmartVoteIdentifier());
			$this->outputLine();

			$this->import('Denomination', $election);
			$this->import('CivilState', $election);
			$this->import('Education', $election);
			$this->import('District', $election);
			$this->import('ElectionList', $election);
			$this->import('Party', $election);
			$this->import('Candidate', $election);
			$this->import('Question', $election);
			$this->import('QuestionCategory', $election);

			$this->outputLine();
		}
	}

	/**
	 * @param string $dataType
	 * @param Election $election
	 */
	protected function import($dataType, Election $election){

		// Party
		$this->output(sprintf('Importing %s... ', $dataType));

		/** @var ImporterInterface $importer */
		$className = sprintf('Visol\EasyvoteSmartvote\Importer\%sImporter', $dataType);
		$importer = $this->objectManager->get($className, $election);
		$collectedData = $importer->import();
		$this->outputLine(sprintf('%s', $collectedData['numberOfItems']));

		if ($this->verbose) {
			$this->outputLine(sprintf('  -> %s', $collectedData['url']));
		}
	}

}
