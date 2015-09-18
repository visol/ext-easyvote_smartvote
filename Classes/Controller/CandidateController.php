<?php
namespace Visol\EasyvoteSmartvote\Controller;

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
use TYPO3\CMS\Extbase\Utility\LocalizationUtility;
use Visol\EasyvoteSmartvote\Service\DistrictService;

/**
 * CandidateController
 */
class CandidateController extends ActionController {

	/**
	 * @var \Visol\EasyvoteSmartvote\Domain\Repository\CandidateRepository
	 * @inject
	 */
	protected $candidateRepository;

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

	public function initializeObject() {
		/** @var $querySettings \TYPO3\CMS\Extbase\Persistence\Generic\Typo3QuerySettings */
		$querySettings = $this->objectManager->get('TYPO3\\CMS\\Extbase\\Persistence\\Generic\\Typo3QuerySettings');
		$querySettings->setRespectStoragePage(FALSE);
		$this->nationalPartyRepository->setDefaultQuerySettings($querySettings);
		$this->districtRepository->setDefaultQuerySettings($querySettings);
	}

	/**
	 * @return void
	 */
	public function indexAction() {
		$electionIdentifier = (int)$this->settings['election'];

		/** @var \Visol\EasyvoteSmartvote\Domain\Model\Election $currentElection */
		$currentElection = $this->electionRepository->findByUid($electionIdentifier);

		$userDistrict = $this->getDistrictService()->getUserDistrictForCurrentElection($currentElection);

		$this->view->assign('contentObjectData', $this->configurationManager->getContentObject()->data);
		$this->view->assign('currentElection', $currentElection);
		$this->view->assign('settings', $this->settings);
		$this->view->assign('userDistrict', $userDistrict);

		$this->filterAction(); // to get the "nationalParties" and "districts" Fluid variable assigned.
	}

	/**
	 * @return void
	 */
	public function filterAction() {
		$nationalParties = $this->nationalPartyRepository->findAll();
		$this->view->assign('nationalParties', $nationalParties);

		$electionIdentifier = (int)$this->settings['election'];
		$currentElection = $this->electionRepository->findByUid($electionIdentifier);
		$districts = $this->districtRepository->findByElection($currentElection);
		$this->view->assign('districts', $districts);

		$smartvotePersonaValues = array('GAMER', 'PARTY_ANIMAL', 'HIPPIE', 'REDNECK', 'EMO', 'HIPSTER', 'REDNECK',
			'TOEFFLIBUEB', 'SHOPPING_QUEEN', 'ROCKER', 'HIP-HOP_HEAD', 'HEARTTHROB', 'REBEL', 'CLASS_CLOWN',
			'FITNESS_JUNKIE', 'SCOUT', 'ANIMAL_FRIEND', 'CHILLER', 'GLOBETROTTER', 'ARTIST', 'NATURE_LOVER');
		$personas = array();
		foreach ($smartvotePersonaValues as $value) {
			$labelKey = 'candidate.persona.' . strtolower($value);
			$personas[$value] = LocalizationUtility::translate($labelKey, 'easyvote_smartvote');
		}
		$this->view->assign('personas', $personas);
	}

	/**
	 * Checks if the link requests a candidate and the candidate exists
	 * Redirects to the candidate directory if an error occurs
	 *
	 * @throws \TYPO3\CMS\Extbase\Mvc\Exception\NoSuchArgumentException
	 * @throws \TYPO3\CMS\Extbase\Mvc\Exception\StopActionException
	 * @throws \TYPO3\CMS\Extbase\Mvc\Exception\UnsupportedRequestTypeException
	 */
	public function initializePermalinkAction() {
		if ($this->request->hasArgument('candidate')) {
			$candidateAndLanguage = GeneralUtility::trimExplode('-', $this->request->getArgument('candidate'));
			$this->request->setArgument('candidate', (int)$candidateAndLanguage[0]);
			$this->request->setArgument('language', (int)$candidateAndLanguage[1]);
			if (is_null($this->candidateRepository->findByUid((int)$candidateAndLanguage[0]))) {
				$targetUri = $this->uriBuilder->setArguments(array('L' => $candidateAndLanguage[1]))->setTargetPageUid((int)$this->settings['candidateDirectoryNRPid'])->build();
				$this->redirectToUri($targetUri);
			}
		} else {
			$targetUri = $this->uriBuilder->setTargetPageUid((int)$this->settings['candidateDirectoryNRPid'])->build();
			$this->redirectToUri($targetUri);
		}
	}

	/**
	 * @param \Visol\EasyvoteSmartvote\Domain\Model\Candidate $candidate
	 * @throws \TYPO3\CMS\Extbase\Mvc\Exception\NoSuchArgumentException
	 * @throws \TYPO3\CMS\Extbase\Mvc\Exception\StopActionException
	 * @throws \TYPO3\CMS\Extbase\Mvc\Exception\UnsupportedRequestTypeException
	 */
	public function permalinkAction(\Visol\EasyvoteSmartvote\Domain\Model\Candidate $candidate = NULL) {
		$languageUid = (int)$this->request->getArgument('language');
		if ($candidate instanceof \Visol\EasyvoteSmartvote\Domain\Model\Candidate) {
			if (strpos(GeneralUtility::getIndpEnv('HTTP_USER_AGENT'), 'facebookexternalhit') !== FALSE) {
				$this->view->assign('languageUid', $languageUid);
				$this->view->assign('candidate', $candidate);
				$this->view->assign('baseUrl', GeneralUtility::getIndpEnv('TYPO3_REQUEST_HOST'));
				$this->view->assign('requestUri', GeneralUtility::getIndpEnv('TYPO3_REQUEST_URL'));
			} else {
				// TODO for future elections this should be made more flexible
				if (strpos($candidate->getElection()->getSmartVoteIdentifier(), 'nr') !== FALSE) {
					$targetPageUid = (int)$this->settings['candidateDirectoryNRPid'];
				} else {
					$targetPageUid = (int)$this->settings['candidateDirectorySRPid'];
				}
				$section = 'candidate=' . $candidate->getUid() . '&district=' . $candidate->getDistrict()->getUid();
				$redirectUri = $this->uriBuilder->setTargetPageUid($targetPageUid)->setSection($section)->setUseCacheHash(FALSE)->setArguments(array('L' => $languageUid))->build();
				$this->redirectToUri($redirectUri);
			}
		} else {
			// this shouldn't happen
			die();
		}
	}

	/**
	 * @return DistrictService
	 */
	protected function getDistrictService() {
		return GeneralUtility::makeInstance(DistrictService::class);
	}

}