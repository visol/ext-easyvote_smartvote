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
use Visol\EasyvoteSmartvote\Service\DistrictService;

/**
 * CandidateController
 */
class CandidateController extends ActionController {

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
		$currentElection = $this->electionRepository->findByUid($electionIdentifier);

		$userDistrict = $this->getDistrictService()->getUserDistrictForCurrentElection($currentElection);

		$this->view->assign('contentObjectData', $this->configurationManager->getContentObject()->data);
		$this->view->assign('currentElection', $currentElection);
		$this->view->assign('settings', $this->settings);
		$this->view->assign('userDistrict', $userDistrict);

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
	}

	/**
	 * @return DistrictService
	 */
	protected function getDistrictService() {
		return GeneralUtility::makeInstance(DistrictService::class);
	}

}