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
 * Test case for class \Visol\EasyvoteSmartvote\Domain\Model\Question.
 *
 * @copyright Copyright belongs to the respective authors
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 *
 * @author Fabien Udriot <fabien@omic.ch>
 */
class QuestionTest extends \TYPO3\CMS\Core\Tests\UnitTestCase {
	/**
	 * @var \Visol\EasyvoteSmartvote\Domain\Model\Question
	 */
	protected $subject = NULL;

	protected function setUp() {
		$this->subject = new \Visol\EasyvoteSmartvote\Domain\Model\Question();
	}

	protected function tearDown() {
		unset($this->subject);
	}

	/**
	 * @test
	 */
	public function getNameReturnsInitialValueForString() {
		$this->assertSame(
			'',
			$this->subject->getName()
		);
	}

	/**
	 * @test
	 */
	public function setNameForStringSetsName() {
		$this->subject->setName('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'name',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getInternalIdentifierReturnsInitialValueForString() {
		$this->assertSame(
			'',
			$this->subject->getInternalIdentifier()
		);
	}

	/**
	 * @test
	 */
	public function setInternalIdentifierForStringSetsInternalIdentifier() {
		$this->subject->setInternalIdentifier('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'internalIdentifier',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getGrouppingReturnsInitialValueForInteger() {
		$this->assertSame(
			0,
			$this->subject->getGroupping()
		);
	}

	/**
	 * @test
	 */
	public function setGrouppingForIntegerSetsGroupping() {
		$this->subject->setGroupping(12);

		$this->assertAttributeEquals(
			12,
			'groupping',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getTypeReturnsInitialValueForString() {
		$this->assertSame(
			'',
			$this->subject->getType()
		);
	}

	/**
	 * @test
	 */
	public function setTypeForStringSetsType() {
		$this->subject->setType('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'type',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getRapideReturnsInitialValueForBoolean() {
		$this->assertSame(
			FALSE,
			$this->subject->getRapide()
		);
	}

	/**
	 * @test
	 */
	public function setRapideForBooleanSetsRapide() {
		$this->subject->setRapide(TRUE);

		$this->assertAttributeEquals(
			TRUE,
			'rapide',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getEducationReturnsInitialValueForBoolean() {
		$this->assertSame(
			FALSE,
			$this->subject->getEducation()
		);
	}

	/**
	 * @test
	 */
	public function setEducationForBooleanSetsEducation() {
		$this->subject->setEducation(TRUE);

		$this->assertAttributeEquals(
			TRUE,
			'education',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getCleavage1ReturnsInitialValueForInteger() {
		$this->assertSame(
			0,
			$this->subject->getCleavage1()
		);
	}

	/**
	 * @test
	 */
	public function setCleavage1ForIntegerSetsCleavage1() {
		$this->subject->setCleavage1(12);

		$this->assertAttributeEquals(
			12,
			'cleavage1',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getCleavage2ReturnsInitialValueForInteger() {
		$this->assertSame(
			0,
			$this->subject->getCleavage2()
		);
	}

	/**
	 * @test
	 */
	public function setCleavage2ForIntegerSetsCleavage2() {
		$this->subject->setCleavage2(12);

		$this->assertAttributeEquals(
			12,
			'cleavage2',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getCleavage3ReturnsInitialValueForInteger() {
		$this->assertSame(
			0,
			$this->subject->getCleavage3()
		);
	}

	/**
	 * @test
	 */
	public function setCleavage3ForIntegerSetsCleavage3() {
		$this->subject->setCleavage3(12);

		$this->assertAttributeEquals(
			12,
			'cleavage3',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getCleavage4ReturnsInitialValueForString() {
		$this->assertSame(
			'',
			$this->subject->getCleavage4()
		);
	}

	/**
	 * @test
	 */
	public function setCleavage4ForStringSetsCleavage4() {
		$this->subject->setCleavage4('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'cleavage4',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getCleavage5ReturnsInitialValueForString() {
		$this->assertSame(
			'',
			$this->subject->getCleavage5()
		);
	}

	/**
	 * @test
	 */
	public function setCleavage5ForStringSetsCleavage5() {
		$this->subject->setCleavage5('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'cleavage5',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getCleavage6ReturnsInitialValueForString() {
		$this->assertSame(
			'',
			$this->subject->getCleavage6()
		);
	}

	/**
	 * @test
	 */
	public function setCleavage6ForStringSetsCleavage6() {
		$this->subject->setCleavage6('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'cleavage6',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getCleavage7ReturnsInitialValueForString() {
		$this->assertSame(
			'',
			$this->subject->getCleavage7()
		);
	}

	/**
	 * @test
	 */
	public function setCleavage7ForStringSetsCleavage7() {
		$this->subject->setCleavage7('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'cleavage7',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getCleavage8ReturnsInitialValueForString() {
		$this->assertSame(
			'',
			$this->subject->getCleavage8()
		);
	}

	/**
	 * @test
	 */
	public function setCleavage8ForStringSetsCleavage8() {
		$this->subject->setCleavage8('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'cleavage8',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getInfoReturnsInitialValueForString() {
		$this->assertSame(
			'',
			$this->subject->getInfo()
		);
	}

	/**
	 * @test
	 */
	public function setInfoForStringSetsInfo() {
		$this->subject->setInfo('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'info',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getProReturnsInitialValueForString() {
		$this->assertSame(
			'',
			$this->subject->getPro()
		);
	}

	/**
	 * @test
	 */
	public function setProForStringSetsPro() {
		$this->subject->setPro('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'pro',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getContraReturnsInitialValueForString() {
		$this->assertSame(
			'',
			$this->subject->getContra()
		);
	}

	/**
	 * @test
	 */
	public function setContraForStringSetsContra() {
		$this->subject->setContra('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'contra',
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

	/**
	 * @test
	 */
	public function getCategoryReturnsInitialValueForQuestionCategory() {
		$this->assertEquals(
			NULL,
			$this->subject->getCategory()
		);
	}

	/**
	 * @test
	 */
	public function setCategoryForQuestionCategorySetsCategory() {
		$categoryFixture = new \Visol\EasyvoteSmartvote\Domain\Model\QuestionCategory();
		$this->subject->setCategory($categoryFixture);

		$this->assertAttributeEquals(
			$categoryFixture,
			'category',
			$this->subject
		);
	}
}
