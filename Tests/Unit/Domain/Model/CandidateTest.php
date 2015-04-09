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
 * Test case for class \Visol\EasyvoteSmartvote\Domain\Model\Candidate.
 *
 * @copyright Copyright belongs to the respective authors
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 *
 * @author Fabien Udriot <fabien@omic.ch>
 */
class CandidateTest extends \TYPO3\CMS\Core\Tests\UnitTestCase {
	/**
	 * @var \Visol\EasyvoteSmartvote\Domain\Model\Candidate
	 */
	protected $subject = NULL;

	protected function setUp() {
		$this->subject = new \Visol\EasyvoteSmartvote\Domain\Model\Candidate();
	}

	protected function tearDown() {
		unset($this->subject);
	}

	/**
	 * @test
	 */
	public function getFirstNameReturnsInitialValueForString() {
		$this->assertSame(
			'',
			$this->subject->getFirstName()
		);
	}

	/**
	 * @test
	 */
	public function setFirstNameForStringSetsFirstName() {
		$this->subject->setFirstName('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'firstName',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getLastNameReturnsInitialValueForString() {
		$this->assertSame(
			'',
			$this->subject->getLastName()
		);
	}

	/**
	 * @test
	 */
	public function setLastNameForStringSetsLastName() {
		$this->subject->setLastName('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'lastName',
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
	public function getGenderReturnsInitialValueForString() {
		$this->assertSame(
			'',
			$this->subject->getGender()
		);
	}

	/**
	 * @test
	 */
	public function setGenderForStringSetsGender() {
		$this->subject->setGender('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'gender',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getYearOfBirthReturnsInitialValueForString() {
		$this->assertSame(
			'',
			$this->subject->getYearOfBirth()
		);
	}

	/**
	 * @test
	 */
	public function setYearOfBirthForStringSetsYearOfBirth() {
		$this->subject->setYearOfBirth('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'yearOfBirth',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getLanguageReturnsInitialValueForString() {
		$this->assertSame(
			'',
			$this->subject->getLanguage()
		);
	}

	/**
	 * @test
	 */
	public function setLanguageForStringSetsLanguage() {
		$this->subject->setLanguage('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'language',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getCityReturnsInitialValueForString() {
		$this->assertSame(
			'',
			$this->subject->getCity()
		);
	}

	/**
	 * @test
	 */
	public function setCityForStringSetsCity() {
		$this->subject->setCity('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'city',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getIncumbentReturnsInitialValueForBoolean() {
		$this->assertSame(
			FALSE,
			$this->subject->getIncumbent()
		);
	}

	/**
	 * @test
	 */
	public function setIncumbentForBooleanSetsIncumbent() {
		$this->subject->setIncumbent(TRUE);

		$this->assertAttributeEquals(
			TRUE,
			'incumbent',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getElectedReturnsInitialValueForBoolean() {
		$this->assertSame(
			FALSE,
			$this->subject->getElected()
		);
	}

	/**
	 * @test
	 */
	public function setElectedForBooleanSetsElected() {
		$this->subject->setElected(TRUE);

		$this->assertAttributeEquals(
			TRUE,
			'elected',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getPartyReturnsInitialValueForParty() {
		$this->assertEquals(
			NULL,
			$this->subject->getParty()
		);
	}

	/**
	 * @test
	 */
	public function setPartyForPartySetsParty() {
		$partyFixture = new \Visol\EasyvoteSmartvote\Domain\Model\Party();
		$this->subject->setParty($partyFixture);

		$this->assertAttributeEquals(
			$partyFixture,
			'party',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getDistrictReturnsInitialValueForDistrict() {
		$this->assertEquals(
			NULL,
			$this->subject->getDistrict()
		);
	}

	/**
	 * @test
	 */
	public function setDistrictForDistrictSetsDistrict() {
		$districtFixture = new \Visol\EasyvoteSmartvote\Domain\Model\District();
		$this->subject->setDistrict($districtFixture);

		$this->assertAttributeEquals(
			$districtFixture,
			'district',
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
