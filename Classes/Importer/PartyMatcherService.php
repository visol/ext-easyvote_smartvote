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
class PartyMatcherService {

	/**
	 * @var \Visol\EasyvoteSmartvote\Domain\Repository\PartyRepository
	 * @inject
	 */
	protected $partyRepository;

	/**
	 * @var \Visol\Easyvote\Domain\Repository\PartyRepository
	 * @inject
	 */
	protected $nationalPartyRepository;

	/**
	 * @var \TYPO3\CMS\Extbase\Object\ObjectManagerInterface
	 * @inject
	 */
	protected $objectManager;

	/**
	 * @var \TYPO3\CMS\Extbase\Persistence\Generic\PersistenceManager
	 * @inject
	 */
	protected $persistenceManager;

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

	public function initializeObject() {
		/** @var $querySettings \TYPO3\CMS\Extbase\Persistence\Generic\Typo3QuerySettings */
		$querySettings = $this->objectManager->get('TYPO3\\CMS\\Extbase\\Persistence\\Generic\\Typo3QuerySettings');
		$querySettings->setRespectStoragePage(FALSE);
		$this->partyRepository->setDefaultQuerySettings($querySettings);
		$this->nationalPartyRepository->setDefaultQuerySettings($querySettings);
	}

	/**
	 * Match a party to its national party
	 *
	 * @param bool $verbose
	 * @return array
	 */
	public function matchPartiesToNationalParty($verbose = FALSE) {
		$parties = $this->partyRepository->findByElection($this->election);
		foreach ($parties as $party) {
			/** @var $party \Visol\EasyvoteSmartvote\Domain\Model\Party */
			$nationalParty = $this->nationalPartyRepository->findOneByShortTitle($party->getNameShort());
			if ($nationalParty instanceof \Visol\Easyvote\Domain\Model\Party) {
				if ($verbose) {
					$this->log('[MATCH]    Party: ' . $party->getName() . ' (' . $party->getNameShort() . ') --> ' . $nationalParty->getTitle() . ' (' . $nationalParty->getShortTitle() . ')');
				}
				$party->setNationalParty($nationalParty);
				$this->partyRepository->update($party);
				$this->persistenceManager->persistAll();
			} else {
				if ($verbose) {
					$this->log('[NO MATCH] Party: ' . $party->getName() . ' (' . $party->getNameShort() . ')');
				}
			}

		}
		return $this->logs;
	}

	/**
	 * @param string $log
	 * @return void
	 */
	protected function log($log){
		$this->logs[] = $log . "\n";
	}

	/**
	 * @param Election $election
	 */
	public function setElection(Election $election) {
		$this->election = $election;
	}

}
