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
	public function getDistrictNameReturnsInitialValueForString() {
		$this->assertSame(
			'',
			$this->subject->getDistrictName()
		);
	}

	/**
	 * @test
	 */
	public function setDistrictNameForStringSetsDistrictName() {
		$this->subject->setDistrictName('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'districtName',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getPartyShortReturnsInitialValueForString() {
		$this->assertSame(
			'',
			$this->subject->getPartyShort()
		);
	}

	/**
	 * @test
	 */
	public function setPartyShortForStringSetsPartyShort() {
		$this->subject->setPartyShort('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'partyShort',
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
	public function getCivilStateNameReturnsInitialValueForString() {
		$this->assertSame(
			'',
			$this->subject->getCivilStateName()
		);
	}

	/**
	 * @test
	 */
	public function setCivilStateNameForStringSetsCivilStateName() {
		$this->subject->setCivilStateName('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'civilStateName',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getDenominationNameReturnsInitialValueForString() {
		$this->assertSame(
			'',
			$this->subject->getDenominationName()
		);
	}

	/**
	 * @test
	 */
	public function setDenominationNameForStringSetsDenominationName() {
		$this->subject->setDenominationName('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'denominationName',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getEducationNameReturnsInitialValueForString() {
		$this->assertSame(
			'',
			$this->subject->getEducationName()
		);
	}

	/**
	 * @test
	 */
	public function setEducationNameForStringSetsEducationName() {
		$this->subject->setEducationName('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'educationName',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getEmploymentNameReturnsInitialValueForString() {
		$this->assertSame(
			'',
			$this->subject->getEmploymentName()
		);
	}

	/**
	 * @test
	 */
	public function setEmploymentNameForStringSetsEmploymentName() {
		$this->subject->setEmploymentName('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'employmentName',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getOccupationReturnsInitialValueForString() {
		$this->assertSame(
			'',
			$this->subject->getOccupation()
		);
	}

	/**
	 * @test
	 */
	public function setOccupationForStringSetsOccupation() {
		$this->subject->setOccupation('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'occupation',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getNumberOfChildrenReturnsInitialValueForInteger() {
		$this->assertSame(
			0,
			$this->subject->getNumberOfChildren()
		);
	}

	/**
	 * @test
	 */
	public function setNumberOfChildrenForIntegerSetsNumberOfChildren() {
		$this->subject->setNumberOfChildren(12);

		$this->assertAttributeEquals(
			12,
			'numberOfChildren',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getHobbiesReturnsInitialValueForString() {
		$this->assertSame(
			'',
			$this->subject->getHobbies()
		);
	}

	/**
	 * @test
	 */
	public function setHobbiesForStringSetsHobbies() {
		$this->subject->setHobbies('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'hobbies',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getFavoriteBooksReturnsInitialValueForString() {
		$this->assertSame(
			'',
			$this->subject->getFavoriteBooks()
		);
	}

	/**
	 * @test
	 */
	public function setFavoriteBooksForStringSetsFavoriteBooks() {
		$this->subject->setFavoriteBooks('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'favoriteBooks',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getFavoriteMusicReturnsInitialValueForString() {
		$this->assertSame(
			'',
			$this->subject->getFavoriteMusic()
		);
	}

	/**
	 * @test
	 */
	public function setFavoriteMusicForStringSetsFavoriteMusic() {
		$this->subject->setFavoriteMusic('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'favoriteMusic',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getFavoriteMoviesReturnsInitialValueForString() {
		$this->assertSame(
			'',
			$this->subject->getFavoriteMovies()
		);
	}

	/**
	 * @test
	 */
	public function setFavoriteMoviesForStringSetsFavoriteMovies() {
		$this->subject->setFavoriteMovies('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'favoriteMovies',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getLinkToSmartSpiderReturnsInitialValueForString() {
		$this->assertSame(
			'',
			$this->subject->getLinkToSmartSpider()
		);
	}

	/**
	 * @test
	 */
	public function setLinkToSmartSpiderForStringSetsLinkToSmartSpider() {
		$this->subject->setLinkToSmartSpider('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'linkToSmartSpider',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getLinkToPortraitReturnsInitialValueForString() {
		$this->assertSame(
			'',
			$this->subject->getLinkToPortrait()
		);
	}

	/**
	 * @test
	 */
	public function setLinkToPortraitForStringSetsLinkToPortrait() {
		$this->subject->setLinkToPortrait('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'linkToPortrait',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getLinkToFacebookReturnsInitialValueForString() {
		$this->assertSame(
			'',
			$this->subject->getLinkToFacebook()
		);
	}

	/**
	 * @test
	 */
	public function setLinkToFacebookForStringSetsLinkToFacebook() {
		$this->subject->setLinkToFacebook('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'linkToFacebook',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getLinkToTwitterReturnsInitialValueForString() {
		$this->assertSame(
			'',
			$this->subject->getLinkToTwitter()
		);
	}

	/**
	 * @test
	 */
	public function setLinkToTwitterForStringSetsLinkToTwitter() {
		$this->subject->setLinkToTwitter('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'linkToTwitter',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getLinkToPolitnetzReturnsInitialValueForString() {
		$this->assertSame(
			'',
			$this->subject->getLinkToPolitnetz()
		);
	}

	/**
	 * @test
	 */
	public function setLinkToPolitnetzForStringSetsLinkToPolitnetz() {
		$this->subject->setLinkToPolitnetz('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'linkToPolitnetz',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getLinkToYoutubeReturnsInitialValueForString() {
		$this->assertSame(
			'',
			$this->subject->getLinkToYoutube()
		);
	}

	/**
	 * @test
	 */
	public function setLinkToYoutubeForStringSetsLinkToYoutube() {
		$this->subject->setLinkToYoutube('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'linkToYoutube',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getLinkToVimeoReturnsInitialValueForString() {
		$this->assertSame(
			'',
			$this->subject->getLinkToVimeo()
		);
	}

	/**
	 * @test
	 */
	public function setLinkToVimeoForStringSetsLinkToVimeo() {
		$this->subject->setLinkToVimeo('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'linkToVimeo',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getEmailReturnsInitialValueForString() {
		$this->assertSame(
			'',
			$this->subject->getEmail()
		);
	}

	/**
	 * @test
	 */
	public function setEmailForStringSetsEmail() {
		$this->subject->setEmail('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'email',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getWhyMeReturnsInitialValueForString() {
		$this->assertSame(
			'',
			$this->subject->getWhyMe()
		);
	}

	/**
	 * @test
	 */
	public function setWhyMeForStringSetsWhyMe() {
		$this->subject->setWhyMe('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'whyMe',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getSloganReturnsInitialValueForString() {
		$this->assertSame(
			'',
			$this->subject->getSlogan()
		);
	}

	/**
	 * @test
	 */
	public function setSloganForStringSetsSlogan() {
		$this->subject->setSlogan('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'slogan',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getPersonalWebsiteReturnsInitialValueForString() {
		$this->assertSame(
			'',
			$this->subject->getPersonalWebsite()
		);
	}

	/**
	 * @test
	 */
	public function setPersonalWebsiteForStringSetsPersonalWebsite() {
		$this->subject->setPersonalWebsite('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'personalWebsite',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getElectionListNameReturnsInitialValueForString() {
		$this->assertSame(
			'',
			$this->subject->getElectionListName()
		);
	}

	/**
	 * @test
	 */
	public function setElectionListNameForStringSetsElectionListName() {
		$this->subject->setElectionListName('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'electionListName',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getPhotosReturnsInitialValueForString() {
		$this->assertSame(
			'',
			$this->subject->getPhotos()
		);
	}

	/**
	 * @test
	 */
	public function setPhotosForStringSetsPhotos() {
		$this->subject->setPhotos('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'photos',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getLinksReturnsInitialValueForString() {
		$this->assertSame(
			'',
			$this->subject->getLinks()
		);
	}

	/**
	 * @test
	 */
	public function setLinksForStringSetsLinks() {
		$this->subject->setLinks('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'links',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getAnswersReturnsInitialValueForString() {
		$this->assertSame(
			'',
			$this->subject->getAnswers()
		);
	}

	/**
	 * @test
	 */
	public function setAnswersForStringSetsAnswers() {
		$this->subject->setAnswers('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'answers',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getSpiderValuesReturnsInitialValueForString() {
		$this->assertSame(
			'',
			$this->subject->getSpiderValues()
		);
	}

	/**
	 * @test
	 */
	public function setSpiderValuesForStringSetsSpiderValues() {
		$this->subject->setSpiderValues('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'spiderValues',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getCoordinatesReturnsInitialValueForString() {
		$this->assertSame(
			'',
			$this->subject->getCoordinates()
		);
	}

	/**
	 * @test
	 */
	public function setCoordinatesForStringSetsCoordinates() {
		$this->subject->setCoordinates('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'coordinates',
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

	/**
	 * @test
	 */
	public function getElectionListReturnsInitialValueForElectionList() {
		$this->assertEquals(
			NULL,
			$this->subject->getElectionList()
		);
	}

	/**
	 * @test
	 */
	public function setElectionListForElectionListSetsElectionList() {
		$electionListFixture = new \Visol\EasyvoteSmartvote\Domain\Model\ElectionList();
		$this->subject->setElectionList($electionListFixture);

		$this->assertAttributeEquals(
			$electionListFixture,
			'electionList',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getCivilStateReturnsInitialValueForCivilState() {
		$this->assertEquals(
			NULL,
			$this->subject->getCivilState()
		);
	}

	/**
	 * @test
	 */
	public function setCivilStateForCivilStateSetsCivilState() {
		$civilStateFixture = new \Visol\EasyvoteSmartvote\Domain\Model\CivilState();
		$this->subject->setCivilState($civilStateFixture);

		$this->assertAttributeEquals(
			$civilStateFixture,
			'civilState',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getDenominationReturnsInitialValueForDenomination() {
		$this->assertEquals(
			NULL,
			$this->subject->getDenomination()
		);
	}

	/**
	 * @test
	 */
	public function setDenominationForDenominationSetsDenomination() {
		$denominationFixture = new \Visol\EasyvoteSmartvote\Domain\Model\Denomination();
		$this->subject->setDenomination($denominationFixture);

		$this->assertAttributeEquals(
			$denominationFixture,
			'denomination',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getEducationReturnsInitialValueForEducation() {
		$this->assertEquals(
			NULL,
			$this->subject->getEducation()
		);
	}

	/**
	 * @test
	 */
	public function setEducationForEducationSetsEducation() {
		$educationFixture = new \Visol\EasyvoteSmartvote\Domain\Model\Education();
		$this->subject->setEducation($educationFixture);

		$this->assertAttributeEquals(
			$educationFixture,
			'education',
			$this->subject
		);
	}
}
