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
use Visol\EasyvoteSmartvote\Importer\PartyImporter;

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
	 * @return void
	 */
	public function importCommand() {

		$elections = $this->electionRepository->findAll();

		foreach ($elections as $election) {

			/** @var $election Election */
			$this->outputLine('***********************************************');
			$this->outputLine('Smart Vote identifier: ' . $election->getSmartVoteIdentifier());
			$this->outputLine();

			// Party
			$this->output('Importing Parties... ');

			/** @var PartyImporter $partyImporter */
			$partyImporter = $this->objectManager->get(PartyImporter::class, $election);
			$numberOfItems = $partyImporter->import();
			$this->outputLine(sprintf('%s Parties', $numberOfItems));
			$this->outputLine();
		}
	}

}
