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
use TYPO3\CMS\Extbase\Persistence\Generic\Typo3QuerySettings;
use TYPO3\CMS\Extbase\Utility\LocalizationUtility;
use Visol\EasyvoteSmartvote\Domain\Model\Candidate;
use Visol\EasyvoteSmartvote\Domain\Model\Election;
use Visol\EasyvoteSmartvote\Service\DistrictService;
use Visol\EasyvoteSmartvote\Service\VotablePlugin;

/**
 * CandidateController
 */
class CandidateController extends ActionController
{

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
     * @var \Visol\EasyvoteSmartvote\Domain\Repository\PartyRepository
     * @inject
     */
    protected $partyRepository;

    /**
     * @var \Visol\EasyvoteSmartvote\Domain\Repository\DistrictRepository
     * @inject
     */
    protected $districtRepository;

    /**
     * Object initialization.
     */
    public function initializeObject()
    {
        /** @var $querySettings Typo3QuerySettings */
        $querySettings = $this->objectManager->get(Typo3QuerySettings::class);
        $querySettings->setRespectStoragePage(FALSE);
        $this->nationalPartyRepository->setDefaultQuerySettings($querySettings);
        $this->partyRepository->setDefaultQuerySettings($querySettings);
        $this->districtRepository->setDefaultQuerySettings($querySettings);
    }

    /**
     * @return void
     */
    public function indexAction()
    {
        $electionIdentifier = (int)$this->settings['election'];

        /** @var \Visol\EasyvoteSmartvote\Domain\Model\Election $currentElection */
        $currentElection = $this->electionRepository->findByUid($electionIdentifier);

        $userDistrict = $this->getDistrictService()->getUserDistrictForCurrentElection($currentElection);

        $this->view->assign('contentObjectData', $this->configurationManager->getContentObject()->data);
        $this->view->assign('currentElection', $currentElection);
        $this->view->assign('settings', $this->settings);
        $this->view->assign('hasVotableActive', (int)VotablePlugin::getInstance()->isActiveOnCurrentPage());
        $this->view->assign('userDistrict', $userDistrict);

        $currentPageId = $this->getFrontendObject()->id;
        $page = $this->getFrontendObject()->sys_page->getPage($currentPageId);
        $this->view->assign('page', $page);

        $this->filterAction(); // to get the "nationalParties" and "districts" Fluid variable assigned.
    }

    /**
     * @return void
     */
    public function filterAction()
    {

        $electionIdentifier = (int)$this->settings['election'];

        /** @var Election $election */
        $election = $this->electionRepository->findByUid($electionIdentifier);
        $districts = $this->districtRepository->findByElection($election);
        $this->view->assign('districts', $districts);


        if ($election->isNationalScope()) {
            $politicalParties = $this->nationalPartyRepository->findAll();
        } else {
            $politicalParties = $this->partyRepository->findByElection($election);
        }

        $this->view->assign('politicalParties', $politicalParties);

        $smartvotePersonaValues = array('GAMER', 'PARTY_ANIMAL', 'HIPPIE', 'REDNECK', 'EMO', 'HIPSTER', 'REDNECK',
            'TOEFFLIBUEB', 'SHOPPING_QUEEN', 'ROCKER', 'HIP-HOP_HEAD', 'HEARTTHROB', 'REBEL', 'CLASS_CLOWN',
            'FITNESS_JUNKIE', 'SCOUT', 'ANIMAL_FRIEND', 'CHILLER', 'GLOBETROTTER', 'ARTIST', 'NATURE_LOVER');
        $personas = array();
        foreach ($smartvotePersonaValues as $value) {
            $labelKey = 'candidate.persona.' . strtolower($value);
            $personas[$value] = LocalizationUtility::translate($labelKey, 'easyvote_smartvote');
        }

        $this->view->assign('currentElection', $election);
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
    public function initializePermalinkAction()
    {
        if ($this->request->hasArgument('candidate')) {

            // Decode arguments
            $candidateAndLanguage = GeneralUtility::trimExplode('-', $this->request->getArgument('candidate'), true);

            // ... and rearrange them.
            $this->request->setArgument('candidate', (int)$candidateAndLanguage[0]);
            $this->request->setArgument('language', isset($candidateAndLanguage[1]) ? (int)$candidateAndLanguage[1] : 0);
            $this->request->setArgument('targetPid', isset($candidateAndLanguage[2]) ? (int)$candidateAndLanguage[2] : 0);
        }
    }

    /**
     * @param Candidate $candidate
     * @throws \TYPO3\CMS\Extbase\Mvc\Exception\NoSuchArgumentException
     * @throws \TYPO3\CMS\Extbase\Mvc\Exception\StopActionException
     * @throws \TYPO3\CMS\Extbase\Mvc\Exception\UnsupportedRequestTypeException
     */
    public function permalinkAction(Candidate $candidate = NULL)
    {
        $languageUid = (int)$this->request->getArgument('language');
        $targetPageUid = (int)$this->request->getArgument('targetPid');
        if ($candidate instanceof Candidate && $targetPageUid > 0) {
            if (strpos(GeneralUtility::getIndpEnv('HTTP_USER_AGENT'), 'facebookexternalhit') !== FALSE) {
                $this->view->assign('languageUid', $languageUid);
                $this->view->assign('candidate', $candidate);
                $this->view->assign('baseUrl', GeneralUtility::getIndpEnv('TYPO3_REQUEST_HOST'));
                $this->view->assign('requestUri', GeneralUtility::getIndpEnv('TYPO3_REQUEST_URL'));
            } else {
                $section = 'candidate=' . $candidate->getUid() . '&district=' . $candidate->getDistrict()->getUid();
                $redirectUri = $this->uriBuilder->setTargetPageUid($targetPageUid)->setSection($section)->setUseCacheHash(FALSE)->setArguments(array('L' => $languageUid))->build();
                $this->redirectToUri($redirectUri);
            }
        } else {
            // We can't resolve the permalink, redirect to a 404.
            $this->getFrontendObject()->pageNotFoundAndExit();
        }
    }

    /**
     * @return DistrictService
     */
    protected function getDistrictService()
    {
        return GeneralUtility::makeInstance(DistrictService::class);
    }

    /**
     * Returns an instance of the Frontend object.
     *
     * @return \TYPO3\CMS\Frontend\Controller\TypoScriptFrontendController
     */
    protected function getFrontendObject()
    {
        return $GLOBALS['TSFE'];
    }

}