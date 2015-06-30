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

use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Mvc\Controller\CommandController;
use Visol\EasyvoteSmartvote\Domain\Model\Election;
use Visol\EasyvoteSmartvote\Importer\ImporterService;

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
	 * Import a bunch of data form SmartVote using its API.
	 *
	 * @param bool $verbose
	 * @param string $identifier
	 * @throws \TYPO3\CMS\Extbase\Persistence\Exception\IllegalObjectTypeException
	 */
	public function importCommand($verbose = FALSE, $identifier = '') {

		if ($identifier) {
			$election = $this->electionRepository->findOneBySmartVoteIdentifier($identifier);
			$elections = array($election);
		} else {
			$elections = $this->electionRepository->findAll();
		}

		foreach ($elections as $election) {

			/** @var $election Election */
			$this->outputLine('***********************************************');
			$this->outputLine('Smart Vote identifier: ' . $election->getSmartVoteIdentifier());
			$this->outputLine('***********************************************');
			$this->outputLine();

			$logs = $this->getImporterService($election)->import($verbose);
			$logLines = implode('', $logs);

			$election->setImportLog($logLines);
			$this->electionRepository->update($election);

			$this->outputLine($logLines);
		}
	}

	/**
	 * @param Election $election
	 * @return ImporterService
	 */
	protected function getImporterService(Election $election){
		return GeneralUtility::makeInstance(ImporterService::class, $election);
	}

}
