<?php
namespace Visol\EasyvoteSmartvote\Tests\Unit\Controller;
/***************************************************************
 *  Copyright notice
 *
 *  (c) 2015 Fabien Udriot <fabien@omic.ch>, Visol
 *  			
 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 2 of the License, or
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
 * Test case for class Visol\EasyvoteSmartvote\Controller\CandidateController.
 *
 * @author Fabien Udriot <fabien@omic.ch>
 */
class CandidateControllerTest extends \TYPO3\CMS\Core\Tests\UnitTestCase {

	/**
	 * @var \Visol\EasyvoteSmartvote\Controller\CandidateController
	 */
	protected $subject = NULL;

	protected function setUp() {
		$this->subject = $this->getMock('Visol\\EasyvoteSmartvote\\Controller\\CandidateController', array('redirect', 'forward', 'addFlashMessage'), array(), '', FALSE);
	}

	protected function tearDown() {
		unset($this->subject);
	}

	/**
	 * @test
	 */
	public function listActionFetchesAllCandidatesFromRepositoryAndAssignsThemToView() {

		$allCandidates = $this->getMock('TYPO3\\CMS\\Extbase\\Persistence\\ObjectStorage', array(), array(), '', FALSE);

		$candidateRepository = $this->getMock('Visol\\EasyvoteSmartvote\\Domain\\Repository\\CandidateRepository', array('findAll'), array(), '', FALSE);
		$candidateRepository->expects($this->once())->method('findAll')->will($this->returnValue($allCandidates));
		$this->inject($this->subject, 'candidateRepository', $candidateRepository);

		$view = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\View\\ViewInterface');
		$view->expects($this->once())->method('assign')->with('candidates', $allCandidates);
		$this->inject($this->subject, 'view', $view);

		$this->subject->listAction();
	}

	/**
	 * @test
	 */
	public function showActionAssignsTheGivenCandidateToView() {
		$candidate = new \Visol\EasyvoteSmartvote\Domain\Model\Candidate();

		$view = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\View\\ViewInterface');
		$this->inject($this->subject, 'view', $view);
		$view->expects($this->once())->method('assign')->with('candidate', $candidate);

		$this->subject->showAction($candidate);
	}
}
