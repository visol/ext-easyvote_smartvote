<?php
namespace Visol\EasyvoteSmartvote\Controller;


/***************************************************************
 *
 *  Copyright notice
 *
 *  (c) 2015 Fabien Udriot <fabien@omic.ch>, Visol
 *
 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 3 of the License, or
 *  (at your option) any later version.
 *
 *  The GNU General Public License can be found at
 *  http://www.gnu.org/copyleft/gpl.html.
 *
 *  This script is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  This copyright notice MUST APPEAR in all copies of the script!
 ***************************************************************/

/**
 * CandidateController
 */
class CandidateController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController {

	/**
	 * candidateRepository
	 *
	 * @var \Visol\EasyvoteSmartvote\Domain\Repository\CandidateRepository
	 * @inject
	 */
	protected $candidateRepository = NULL;

	/**
	 * action list
	 *
	 * @return void
	 */
	public function listAction() {
		$candidates = $this->candidateRepository->findAll();
		$this->view->assign('candidates', $candidates);
	}

	/**
	 * action show
	 *
	 * @param \Visol\EasyvoteSmartvote\Domain\Model\Candidate $candidate
	 * @return void
	 */
	public function showAction(\Visol\EasyvoteSmartvote\Domain\Model\Candidate $candidate) {
		$this->view->assign('candidate', $candidate);
	}

}