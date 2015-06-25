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

/**
 * Question Controller
 */
class QuestionController extends ActionController {

	/**
	 * @var \Visol\EasyvoteSmartvote\Domain\Repository\QuestionRepository
	 * @inject
	 */
	protected $questionRepository;

	/**
	 * @var \Visol\EasyvoteSmartvote\Domain\Repository\ElectionRepository
	 * @inject
	 */
	protected $electionRepository;

	/**
	 * @return void
	 */
	public function indexAction() {
		$currentElection = $this->electionRepository->findByUid($this->getCurrentElectionIdentifier());
		$this->view->assign('contentObjectData', $this->configurationManager->getContentObject()->data);
		$this->view->assign('currentElection', $currentElection);
		$this->view->assign('settings', $this->settings);
	}

	/**
	 * Return the first election identifier.
	 *
	 * @return int
	 */
	protected function getCurrentElectionIdentifier() {
		$elections = GeneralUtility::trimExplode(',', $this->settings['elections'], TRUE);
		return (int)array_shift($elections);
	}

}