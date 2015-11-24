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
class PartyMatcherService
{

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
     * @var \Visol\EasyvoteSmartvote\Domain\Repository\CandidateRepository
     * @inject
     */
    protected $candidateRepository;

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

    public function initializeObject()
    {
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
    public function matchPartiesToNationalParty($verbose = FALSE)
    {
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
     * Sets the national party for all candidates based on their party
     * Having the national party stored directly in the candidate table increases performance
     *
     * @param bool $verbose
     * @return array
     */
    public function setNationalPartyForCandidates($verbose = FALSE)
    {
        $candidates = $this->candidateRepository->findByElectionReturnObjectStorage($this->election);
        $i = 0;
        foreach ($candidates as $candidate) {
            /** @var $candidate \Visol\EasyvoteSmartvote\Domain\Model\Candidate */
            if ($candidate->getParty() instanceof \Visol\EasyvoteSmartvote\Domain\Model\Party) {
                if ($candidate->getParty()->getNationalParty() instanceof \Visol\Easyvote\Domain\Model\Party) {
                    if ($verbose) {
                        $this->log('[OK]   Set national party ' . $candidate->getParty()->getNationalParty()->getTitle() . ' | ' . $candidate->getFirstName() . ' ' . $candidate->getLastName());
                        $candidate->setNationalParty($candidate->getParty()->getNationalParty());
                        $this->candidateRepository->update($candidate);
                    }
                } else {
                    if ($verbose) {
                        $this->log('[FAIL] Candidate\'s party has no national party: ' . $candidate->getParty()->getName() . ' | ' . $candidate->getFirstName() . ' ' . $candidate->getLastName());
                    }
                }
            } else {
                if ($verbose) {
                    $this->log('[FAIL] Candidate has no party. | ' . $candidate->getFirstName() . ' ' . $candidate->getLastName());
                }
            }
            if ($i % 50 === 0) {
                $this->persistenceManager->persistAll();
            }
            $i++;
        }
        $this->persistenceManager->persistAll();
        return $this->logs;
    }

    /**
     * @param string $log
     * @return void
     */
    protected function log($log)
    {
        $this->logs[] = $log . "\n";
    }

    /**
     * @param Election $election
     */
    public function setElection(Election $election)
    {
        $this->election = $election;
    }

}
