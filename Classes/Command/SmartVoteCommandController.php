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

use TYPO3\CMS\Backend\Utility\BackendUtility;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Mvc\Controller\CommandController;
use Visol\EasyvoteSmartvote\Domain\Model\Election;
use Visol\EasyvoteSmartvote\Importer\CandidateImageImporterService;
use Visol\EasyvoteSmartvote\Importer\DistrictToKantonMatcherService;
use Visol\EasyvoteSmartvote\Importer\ImporterService;
use Visol\EasyvoteSmartvote\Importer\PartyMatcherService;

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
	 * @var \Visol\Easyvote\Domain\Repository\PartyRepository
	 * @inject
	 */
	protected $nationalPartyRepository;

	/**
	 * @var \Visol\EasyvoteSmartvote\Domain\Repository\DistrictRepository
	 * @inject
	 */
	protected $districtRepository;

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
			$this->outputLine('smartvote identifier: ' . $election->getSmartVoteIdentifier());
			$this->outputLine('***********************************************');
			$this->outputLine();

			$logs = $this->getImporterService($election)->import($verbose);
			$logLines = implode('', $logs);
			$logs = $this->getImporterService($election)->localize($verbose);
			$logLines = $logLines . implode('', $logs);

			$election->setImportLog($logLines);
			$this->electionRepository->update($election);

			$this->outputLine($logLines);
		}
	}

	/**
	 * Try matching local parties to their national parties
	 *
	 * @param bool $verbose
	 * @param string $identifier
	 */
	public function connectPartiesToNationalPartyCommand($verbose = FALSE, $identifier = '') {
		if ($identifier) {
			$election = $this->electionRepository->findOneBySmartVoteIdentifier($identifier);
			$elections = array($election);
		} else {
			$elections = $this->electionRepository->findAll();
		}

		foreach ($elections as $election) {
			/** @var $election Election */
			$this->outputLine('***********************************************');
			$this->outputLine('smartvote identifier: ' . $election->getSmartVoteIdentifier());
			$this->outputLine('***********************************************');
			$this->outputLine();

			$logs = $this->getPartyMatcherService($election)->matchPartiesToNationalParty($verbose);
			$logLines = implode('', $logs);
			$logs = $this->getPartyMatcherService($election)->setNationalPartyForCandidates($verbose);
			$logLines = $logLines . implode('', $logs);
			$this->outputLine($logLines);
		}
	}

	/**
	 * Try matching districts to their Canton. Only works for national elections.
	 *
	 * @param bool $verbose
	 * @param string $identifier
	 */
	public function connectDistrictsToCantonCommand($verbose = FALSE, $identifier = '') {
		if ($identifier) {
			$election = $this->electionRepository->findOneBySmartVoteIdentifier($identifier);
			$elections = array($election);
		} else {
			$elections = $this->electionRepository->findAll();
		}

		foreach ($elections as $election) {
			/** @var $election Election */
			$this->outputLine('***********************************************');
			$this->outputLine('smartvote identifier: ' . $election->getSmartVoteIdentifier());
			$this->outputLine('***********************************************');
			$this->outputLine();

			$logs = $this->getDistrictToKantonMatcherService($election)->matchDistrictsToKanton($verbose);
			$logLines = implode('', $logs);
			$this->outputLine($logLines);
		}

	}

	/**
	 * Import and resize the main image for all candidates
	 *
	 * @param bool $verbose Display information during import
	 * @param string $identifier Identifier of election, all elections are selected if not indicated
	 * @param bool $forceReimport Force reimport of images even if they are unchanged on the server
	 */
	public function importCandidateImageCommand($verbose = FALSE, $identifier = '', $forceReimport = FALSE) {
		if ($identifier) {
			$election = $this->electionRepository->findOneBySmartVoteIdentifier($identifier);
			$elections = array($election);
		} else {
			$elections = $this->electionRepository->findAll();
		}

		foreach ($elections as $election) {
			/** @var $election Election */
			$this->outputLine('***********************************************');
			$this->outputLine('smartvote identifier: ' . $election->getSmartVoteIdentifier());
			$this->outputLine('***********************************************');
			if ($forceReimport) {
				$this->outputLine('Forced re-import');
				$this->outputLine('***********************************************');
			}

			$logs = $this->getCandidateImageImporterService($election)->importImages($forceReimport);
			if ($verbose) {
				$logLines = implode('', $logs);
				$this->outputLine($logLines);
			}
		}
	}

	/**
	 * Warmup the cache for the candidates and party directory
	 *
	 * @param bool $verbose Display information during import
	 * @param string $identifier Identifier of election, all elections are selected if not indicated
	 */
	public function warmupCacheCommand($verbose = FALSE, $identifier = '') {
		if ($identifier) {
			$election = $this->electionRepository->findOneBySmartVoteIdentifier($identifier);
			$elections = array($election);
		} else {
			$elections = $this->electionRepository->findAll();
		}

		foreach ($elections as $election) {
			/** @var $election Election */
			$this->outputLine('***********************************************');
			$this->outputLine('smartvote identifier: ' . $election->getSmartVoteIdentifier());
			$this->outputLine('***********************************************');
			$logs = array();

			$logs[] = $this->warmupCandidatesCache($election);
			$logs[] = $this->warmupPartiesCache($election);

			if ($verbose) {
				$logLines = implode('', $logs);
				$this->outputLine($logLines);
			}
		}

	}

	/**
	 * @param $election \Visol\EasyvoteSmartvote\Domain\Model\Election
	 * @return array
	 */
	protected function warmupPartiesCache($election) {
		if ($election->getSmartVoteIdentifier() === '15_ch_sr') {
			return 'We do not warum up parties cache for 15_ch_sr.';
		}

		$pageUidForCmsConfiguration = 201;
		$rootLine = array(array('uid' => $pageUidForCmsConfiguration));
		$domain = BackendUtility::firstDomainRecord($rootLine);

		$logs = array();
		$languageUids = array(0, 1, 2);

		foreach ($languageUids as $languageUid) {
			$requestUrl = sprintf('http://%s/routing/parties/%s?id=%s&L=%s', $domain, $election->getUid(), $pageUidForCmsConfiguration, $languageUid);
			$logs[] = 'URL requested: ' . $requestUrl;
			GeneralUtility::getUrl($requestUrl);
		}

		return implode("\n", $logs);
	}

	/**
	 * @param $election \Visol\EasyvoteSmartvote\Domain\Model\Election
	 * @return array
	 */
	protected function warmupCandidatesCache($election) {
		/** @var $querySettings \TYPO3\CMS\Extbase\Persistence\Generic\Typo3QuerySettings */
		$querySettings = $this->objectManager->get('TYPO3\\CMS\\Extbase\\Persistence\\Generic\\Typo3QuerySettings');
		$querySettings->setRespectStoragePage(FALSE);
		$this->districtRepository->setDefaultQuerySettings($querySettings);
		$this->nationalPartyRepository->setDefaultQuerySettings($querySettings);

		$pageUidForCmsConfiguration = 201;
		$rootLine = array(array('uid' => $pageUidForCmsConfiguration));
		$domain = BackendUtility::firstDomainRecord($rootLine);

		$logs = array();
		$languageUids = array(0, 1, 2);

		$nationalParties = $this->nationalPartyRepository->findAll();
		$nationalPartyUids = array();
		// we also need to query all variants an empty value
		$nationalPartyUids[] = '';
		foreach ($nationalParties as $nationalParty) {
			/** @var $nationalParty \Visol\Easyvote\Domain\Model\Party */
			$nationalPartyUids[] = $nationalParty->getUid();
		}

		$districts = $this->districtRepository->findByElection($election);
		$districtUids = array();
		// we also need to query all variants an empty value
		$districtUids[] = '';
		foreach ($districts as $district) {
			/** @var $district \Visol\EasyvoteSmartvote\Domain\Model\District */
			$districtUids[] = $district->getUid();
		}

		$smartvotePersonaValues = array('GAMER', 'PARTY_ANIMAL', 'HIPPIE', 'REDNECK', 'EMO', 'HIPSTER', 'REDNECK',
			'TOEFFLIBUEB', 'SHOPPING_QUEEN', 'ROCKER', 'HIP-HOP_HEAD', 'HEARTTHROB', 'REBEL', 'CLASS_CLOWN',
			'FITNESS_JUNKIE', 'SCOUT', 'ANIMAL_FRIEND', 'CHILLER', 'GLOBETROTTER', 'ARTIST', 'NATURE_LOVER');

		foreach ($languageUids as $languageUid) {
			// Warmup the cache for all district / nationalParty combination
			foreach ($districtUids as $districtUid) {
				foreach ($nationalPartyUids as $nationalPartyUid) {
					$persona = '';
					$requestUrl = sprintf('http://%s/routing/candidates/%s?id=%s&L=%s&district=%s&nationalParty=%s&persona=%s', $domain, $election->getUid(), $pageUidForCmsConfiguration, $languageUid, $districtUid, $nationalPartyUid, $persona);
					$logs[] = 'URL requested: ' . $requestUrl;
					GeneralUtility::getUrl($requestUrl);
				}
			}
			// Warmup the cache for all personas
			foreach ($smartvotePersonaValues as $persona) {
				$districtUid = '';
				$nationalPartyUid = '';
				$requestUrl = sprintf('http://%s/routing/candidates/%s?id=%s&L=%s&district=%s&nationalParty=%s&persona=%s', $domain, $election->getUid(), $pageUidForCmsConfiguration, $languageUid, $districtUid, $nationalPartyUid, $persona);
				$logs[] = 'URL requested: ' . $requestUrl;
				GeneralUtility::getUrl($requestUrl);
			}
		}

		return implode("\n", $logs);

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

	/**
	 * @return DistrictToKantonMatcherService
	 */
	protected function getDistrictToKantonMatcherService(Election $election){
		$districtToKantonMatcherService = $this->objectManager->get(DistrictToKantonMatcherService::class);
		$districtToKantonMatcherService->setElection($election);
		return $districtToKantonMatcherService;
	}

	/**
	 * @return CandidateImageImporterService
	 */
	protected function getCandidateImageImporterService(Election $election){
		$candidateImageImporterService = $this->objectManager->get(CandidateImageImporterService::class);
		$candidateImageImporterService->setElection($election);
		return $candidateImageImporterService;
	}

}
