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

use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;
use Visol\EasyvoteSmartvote\Domain\Model\Candidate;

/**
 * CandidateController
 */
class CandidateController extends ActionController {

	/**
	 * @var \Visol\EasyvoteSmartvote\Domain\Repository\CandidateRepository
	 * @inject
	 */
	protected $candidateRepository = NULL;

	/**
	 * @return void
	 */
	public function listAction() {

		// @todo this action is not being used. Possibly remove me.
		$candidates = $this->candidateRepository->findAll();
		$this->view->assign('candidates', $candidates);
	}

	/**
	 * @param Candidate $candidate
	 * @return void
	 */
	public function showAction(Candidate $candidate) {

		// @todo this action is not being used. Possibly remove me.
		$this->view->assign('candidate', $candidate);
	}

}