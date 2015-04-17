<?php

namespace Visol\EasyvoteSmartvote\Tests\Unit\Domain\Model;

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
 * Test case for class \Visol\EasyvoteSmartvote\Domain\Model\Answer.
 *
 * @copyright Copyright belongs to the respective authors
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 *
 * @author Fabien Udriot <fabien@omic.ch>
 */
class AnswerTest extends \TYPO3\CMS\Core\Tests\UnitTestCase {
	/**
	 * @var \Visol\EasyvoteSmartvote\Domain\Model\Answer
	 */
	protected $subject = NULL;

	protected function setUp() {
		$this->subject = new \Visol\EasyvoteSmartvote\Domain\Model\Answer();
	}

	protected function tearDown() {
		unset($this->subject);
	}

	/**
	 * @test
	 */
	public function getQuestionReturnsInitialValueForInteger() {
		$this->assertSame(
			0,
			$this->subject->getQuestion()
		);
	}

	/**
	 * @test
	 */
	public function setQuestionForIntegerSetsQuestion() {
		$this->subject->setQuestion(12);

		$this->assertAttributeEquals(
			12,
			'question',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getInternalIdentifierReturnsInitialValueForInteger() {
		$this->assertSame(
			0,
			$this->subject->getInternalIdentifier()
		);
	}

	/**
	 * @test
	 */
	public function setInternalIdentifierForIntegerSetsInternalIdentifier() {
		$this->subject->setInternalIdentifier(12);

		$this->assertAttributeEquals(
			12,
			'internalIdentifier',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getValueReturnsInitialValueForInteger() {
		$this->assertSame(
			0,
			$this->subject->getValue()
		);
	}

	/**
	 * @test
	 */
	public function setValueForIntegerSetsValue() {
		$this->subject->setValue(12);

		$this->assertAttributeEquals(
			12,
			'value',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getCommentReturnsInitialValueForString() {
		$this->assertSame(
			'',
			$this->subject->getComment()
		);
	}

	/**
	 * @test
	 */
	public function setCommentForStringSetsComment() {
		$this->subject->setComment('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'comment',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getElectionReturnsInitialValueForElection() {
		$this->assertEquals(
			NULL,
			$this->subject->getElection()
		);
	}

	/**
	 * @test
	 */
	public function setElectionForElectionSetsElection() {
		$electionFixture = new \Visol\EasyvoteSmartvote\Domain\Model\Election();
		$this->subject->setElection($electionFixture);

		$this->assertAttributeEquals(
			$electionFixture,
			'election',
			$this->subject
		);
	}
}
