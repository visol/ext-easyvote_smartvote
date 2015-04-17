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
 * Test case for class \Visol\EasyvoteSmartvote\Domain\Model\Party.
 *
 * @copyright Copyright belongs to the respective authors
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 *
 * @author Fabien Udriot <fabien@omic.ch>
 */
class PartyTest extends \TYPO3\CMS\Core\Tests\UnitTestCase {
	/**
	 * @var \Visol\EasyvoteSmartvote\Domain\Model\Party
	 */
	protected $subject = NULL;

	protected function setUp() {
		$this->subject = new \Visol\EasyvoteSmartvote\Domain\Model\Party();
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
	public function getNameShortReturnsInitialValueForString() {
		$this->assertSame(
			'',
			$this->subject->getNameShort()
		);
	}

	/**
	 * @test
	 */
	public function setNameShortForStringSetsNameShort() {
		$this->subject->setNameShort('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'nameShort',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getLogoReturnsInitialValueForString() {
		$this->assertSame(
			'',
			$this->subject->getLogo()
		);
	}

	/**
	 * @test
	 */
	public function setLogoForStringSetsLogo() {
		$this->subject->setLogo('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'logo',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getNumberOfCandidatesReturnsInitialValueForInteger() {
		$this->assertSame(
			0,
			$this->subject->getNumberOfCandidates()
		);
	}

	/**
	 * @test
	 */
	public function setNumberOfCandidatesForIntegerSetsNumberOfCandidates() {
		$this->subject->setNumberOfCandidates(12);

		$this->assertAttributeEquals(
			12,
			'numberOfCandidates',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getNumberOfAnswersReturnsInitialValueForInteger() {
		$this->assertSame(
			0,
			$this->subject->getNumberOfAnswers()
		);
	}

	/**
	 * @test
	 */
	public function setNumberOfAnswersForIntegerSetsNumberOfAnswers() {
		$this->subject->setNumberOfAnswers(12);

		$this->assertAttributeEquals(
			12,
			'numberOfAnswers',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getFacebookProfileReturnsInitialValueForString() {
		$this->assertSame(
			'',
			$this->subject->getFacebookProfile()
		);
	}

	/**
	 * @test
	 */
	public function setFacebookProfileForStringSetsFacebookProfile() {
		$this->subject->setFacebookProfile('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'facebookProfile',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getWebsiteReturnsInitialValueForString() {
		$this->assertSame(
			'',
			$this->subject->getWebsite()
		);
	}

	/**
	 * @test
	 */
	public function setWebsiteForStringSetsWebsite() {
		$this->subject->setWebsite('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'website',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getDistrictsReturnsInitialValueForInteger() {
		$this->assertSame(
			0,
			$this->subject->getDistricts()
		);
	}

	/**
	 * @test
	 */
	public function setDistrictsForIntegerSetsDistricts() {
		$this->subject->setDistricts(12);

		$this->assertAttributeEquals(
			12,
			'districts',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getElectionListsReturnsInitialValueForInteger() {
		$this->assertSame(
			0,
			$this->subject->getElectionLists()
		);
	}

	/**
	 * @test
	 */
	public function setElectionListsForIntegerSetsElectionLists() {
		$this->subject->setElectionLists(12);

		$this->assertAttributeEquals(
			12,
			'electionLists',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getAnswersReturnsInitialValueForInteger() {
		$this->assertSame(
			0,
			$this->subject->getAnswers()
		);
	}

	/**
	 * @test
	 */
	public function setAnswersForIntegerSetsAnswers() {
		$this->subject->setAnswers(12);

		$this->assertAttributeEquals(
			12,
			'answers',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getSerializedDistrictsReturnsInitialValueForString() {
		$this->assertSame(
			'',
			$this->subject->getSerializedDistricts()
		);
	}

	/**
	 * @test
	 */
	public function setSerializedDistrictsForStringSetsSerializedDistricts() {
		$this->subject->setSerializedDistricts('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'serializedDistricts',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getSerializedElectionListsReturnsInitialValueForString() {
		$this->assertSame(
			'',
			$this->subject->getSerializedElectionLists()
		);
	}

	/**
	 * @test
	 */
	public function setSerializedElectionListsForStringSetsSerializedElectionLists() {
		$this->subject->setSerializedElectionLists('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'serializedElectionLists',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getSerializedAnswersReturnsInitialValueForString() {
		$this->assertSame(
			'',
			$this->subject->getSerializedAnswers()
		);
	}

	/**
	 * @test
	 */
	public function setSerializedAnswersForStringSetsSerializedAnswers() {
		$this->subject->setSerializedAnswers('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'serializedAnswers',
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
