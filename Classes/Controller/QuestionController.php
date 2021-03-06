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

/**
 * Question Controller
 */
class QuestionController extends ActionController
{

    /**
     * @var \Visol\EasyvoteSmartvote\Domain\Repository\ElectionRepository
     * @inject
     */
    protected $electionRepository;

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
        /** @var $querySettings \TYPO3\CMS\Extbase\Persistence\Generic\Typo3QuerySettings */
        $querySettings = $this->objectManager->get(Typo3QuerySettings::class);
        $querySettings->setRespectStoragePage(FALSE);
        $this->districtRepository->setDefaultQuerySettings($querySettings);
    }

    /**
     * @return void
     */
    public function indexAction()
    {
        $electionIdentifier = (int)$this->settings['election'];
        $currentElection = $this->electionRepository->findByUid($electionIdentifier);
        $this->view->assign('contentObjectData', $this->configurationManager->getContentObject()->data);
        $this->view->assign('currentElection', $currentElection);
        $this->view->assign('settings', $this->settings);

        $districts = $this->districtRepository->findByElection($currentElection);
        $this->view->assign('districts', $districts);
    }

}