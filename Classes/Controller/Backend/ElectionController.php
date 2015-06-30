<?php
namespace Visol\EasyvoteSmartvote\Controller\Backend;

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
use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;
use Visol\EasyvoteSmartvote\Domain\Model\Election;
use Visol\EasyvoteSmartvote\Importer\ImporterService;
use Visol\EasyvoteSmartvote\Importer\PartyMatcherService;

/**
 * Question Controller
 */
class ElectionController extends ActionController {

	/**
	 * @var \Visol\EasyvoteSmartvote\Domain\Repository\ElectionRepository
	 * @inject
	 */
	protected $electionRepository;

	/**
	 * @param Election $election
	 * @return string
	 */
	public function importAction(Election $election) {

		$logs = $this->getImporterService($election)->import();
		$election->setImportLog(implode('', $logs));
		$this->electionRepository->update($election);

		$this->getPartyMatcherService($election)->matchPartiesToNationalParty();

		# Json header is not automatically sent in the BE...
		$this->response->setHeader('Content-Type', 'application/json');
		$this->response->sendHeaders();
		return json_encode($logs);
	}

	/**
	 * @param Election $election
	 * @return ImporterService
	 */
	protected function getImporterService(Election $election){
		return GeneralUtility::makeInstance(ImporterService::class, $election);
	}

	/**
	 * @return PartyMatcherService
	 */
	protected function getPartyMatcherService(Election $election){
		$partyMatcherService = $this->objectManager->get(PartyMatcherService::class);
		$partyMatcherService->setElection($election);
		return $partyMatcherService;
	}

}