<?php
namespace Visol\EasyvoteSmartvote\Domain\Model;

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

use TYPO3\CMS\Extbase\DomainObject\AbstractEntity;

/**
 * Candidate
 */
class Candidate extends AbstractEntity {

	/**
	 * firstName
	 *
	 * @var string
	 */
	protected $firstName = '';

	/**
	 * lastName
	 *
	 * @var string
	 */
	protected $lastName = '';

	/**
	 * internalIdentifier
	 *
	 * @var string
	 */
	protected $internalIdentifier = '';

	/**
	 * gender
	 *
	 * @var string
	 */
	protected $gender = '';

	/**
	 * yearOfBirth
	 *
	 * @var string
	 */
	protected $yearOfBirth = '';

	/**
	 * city
	 *
	 * @var string
	 */
	protected $city = '';

	/**
	 * language
	 *
	 * @var string
	 */
	protected $language = '';

	/**
	 * districtName
	 *
	 * @var string
	 */
	protected $districtName = '';

	/**
	 * partyShort
	 *
	 * @var string
	 */
	protected $partyShort = '';

	/**
	 * incumbent
	 *
	 * @var boolean
	 */
	protected $incumbent = FALSE;

	/**
	 * easyvote Supporter
	 *
	 * @var boolean
	 */
	protected $easyvoteSupporter = FALSE;

	/**
	 * Polittalk Participant
	 *
	 * @var boolean
	 */
	protected $polittalkParticipant = FALSE;

	/**
	 * elected
	 *
	 * @var boolean
	 */
	protected $elected = FALSE;

	/**
	 * civilStateName
	 *
	 * @var string
	 */
	protected $civilStateName = '';

	/**
	 * denominationName
	 *
	 * @var string
	 */
	protected $denominationName = '';

	/**
	 * educationName
	 *
	 * @var string
	 */
	protected $educationName = '';

	/**
	 * employmentName
	 *
	 * @var string
	 */
	protected $employmentName = '';

	/**
	 * occupation
	 *
	 * @var string
	 */
	protected $occupation = '';

	/**
	 * numberOfChildren
	 *
	 * @var integer
	 */
	protected $numberOfChildren = 0;

	/**
	 * hobbies
	 *
	 * @var string
	 */
	protected $hobbies = '';

	/**
	 * favoriteBooks
	 *
	 * @var string
	 */
	protected $favoriteBooks = '';

	/**
	 * favoriteMusic
	 *
	 * @var string
	 */
	protected $favoriteMusic = '';

	/**
	 * favoriteMovies
	 *
	 * @var string
	 */
	protected $favoriteMovies = '';

	/**
	 * linkToSmartSpider
	 *
	 * @var string
	 */
	protected $linkToSmartSpider = '';

	/**
	 * linkToPortrait
	 *
	 * @var string
	 */
	protected $linkToPortrait = '';

	/**
	 * linkToFacebook
	 *
	 * @var string
	 */
	protected $linkToFacebook = '';

	/**
	 * linkToTwitter
	 *
	 * @var string
	 */
	protected $linkToTwitter = '';

	/**
	 * linkToPolitnetz
	 *
	 * @var string
	 */
	protected $linkToPolitnetz = '';

	/**
	 * linkToYoutube
	 *
	 * @var string
	 */
	protected $linkToYoutube = '';

	/**
	 * linkToVimeo
	 *
	 * @var string
	 */
	protected $linkToVimeo = '';

	/**
	 * email
	 *
	 * @var string
	 */
	protected $email = '';

	/**
	 * whyMe
	 *
	 * @var string
	 */
	protected $whyMe = '';

	/**
	 * slogan
	 *
	 * @var string
	 */
	protected $slogan = '';

	/**
	 * personalWebsite
	 *
	 * @var string
	 */
	protected $personalWebsite = '';

	/**
	 * electionListName
	 *
	 * @var string
	 */
	protected $electionListName = '';

	/**
	 * photos
	 *
	 * @var integer
	 */
	protected $photos = 0;

	/**
	 * links
	 *
	 * @var integer
	 */
	protected $links = 0;

	/**
	 * answers
	 *
	 * @var integer
	 */
	protected $answers = 0;

	/**
	 * spiderValues
	 *
	 * @var integer
	 */
	protected $spiderValues = 0;

	/**
	 * coordinate
	 *
	 * @var integer
	 */
	protected $coordinate = 0;

	/**
	 * serializedPhotos
	 *
	 * @var string
	 */
	protected $serializedPhotos = '';

	/**
	 * serializedLinks
	 *
	 * @var string
	 */
	protected $serializedLinks = '';

	/**
	 * serializedAnswers
	 *
	 * @var string
	 */
	protected $serializedAnswers = '';

	/**
	 * serializedSpiderValues
	 *
	 * @var string
	 */
	protected $serializedSpiderValues = '';

	/**
	 * serializedCoordinate
	 *
	 * @var string
	 */
	protected $serializedCoordinate = '';

	/**
	 * serializedListPlaces
	 *
	 * @var string
	 */
	protected $serializedListPlaces = '';

	/**
	 * party
	 *
	 * @var \Visol\EasyvoteSmartvote\Domain\Model\Party
	 */
	protected $party = NULL;

	/**
	 * national party
	 *
	 * @var \Visol\Easyvote\Domain\Model\Party
	 * @lazy
	 */
	protected $nationalParty = NULL;

	/**
	 * district
	 *
	 * @var \Visol\EasyvoteSmartvote\Domain\Model\District
	 */
	protected $district = NULL;

	/**
	 * election
	 *
	 * @var \Visol\EasyvoteSmartvote\Domain\Model\Election
	 */
	protected $election = NULL;

	/**
	 * electionList
	 *
	 * @var \Visol\EasyvoteSmartvote\Domain\Model\ElectionList
	 */
	protected $electionList = NULL;

	/**
	 * civilState
	 *
	 * @var \Visol\EasyvoteSmartvote\Domain\Model\CivilState
	 */
	protected $civilState = NULL;

	/**
	 * denomination
	 *
	 * @var \Visol\EasyvoteSmartvote\Domain\Model\Denomination
	 */
	protected $denomination = NULL;

	/**
	 * education
	 *
	 * @var \Visol\EasyvoteSmartvote\Domain\Model\Education
	 */
	protected $education = NULL;

	/**
	 * Returns the firstName
	 *
	 * @return string $firstName
	 */
	public function getFirstName() {
		return $this->firstName;
	}

	/**
	 * Sets the firstName
	 *
	 * @param string $firstName
	 * @return void
	 */
	public function setFirstName($firstName) {
		$this->firstName = $firstName;
	}

	/**
	 * Returns the lastName
	 *
	 * @return string $lastName
	 */
	public function getLastName() {
		return $this->lastName;
	}

	/**
	 * Sets the lastName
	 *
	 * @param string $lastName
	 * @return void
	 */
	public function setLastName($lastName) {
		$this->lastName = $lastName;
	}

	/**
	 * Returns the internalIdentifier
	 *
	 * @return string $internalIdentifier
	 */
	public function getInternalIdentifier() {
		return $this->internalIdentifier;
	}

	/**
	 * Sets the internalIdentifier
	 *
	 * @param string $internalIdentifier
	 * @return void
	 */
	public function setInternalIdentifier($internalIdentifier) {
		$this->internalIdentifier = $internalIdentifier;
	}

	/**
	 * Returns the gender
	 *
	 * @return string $gender
	 */
	public function getGender() {
		return $this->gender;
	}

	/**
	 * Sets the gender
	 *
	 * @param string $gender
	 * @return void
	 */
	public function setGender($gender) {
		$this->gender = $gender;
	}

	/**
	 * Returns the yearOfBirth
	 *
	 * @return string $yearOfBirth
	 */
	public function getYearOfBirth() {
		return $this->yearOfBirth;
	}

	/**
	 * Sets the yearOfBirth
	 *
	 * @param string $yearOfBirth
	 * @return void
	 */
	public function setYearOfBirth($yearOfBirth) {
		$this->yearOfBirth = $yearOfBirth;
	}

	/**
	 * Returns the city
	 *
	 * @return string $city
	 */
	public function getCity() {
		return $this->city;
	}

	/**
	 * Sets the city
	 *
	 * @param string $city
	 * @return void
	 */
	public function setCity($city) {
		$this->city = $city;
	}

	/**
	 * Returns the language
	 *
	 * @return string $language
	 */
	public function getLanguage() {
		return $this->language;
	}

	/**
	 * Sets the language
	 *
	 * @param string $language
	 * @return void
	 */
	public function setLanguage($language) {
		$this->language = $language;
	}

	/**
	 * Returns the districtName
	 *
	 * @return string $districtName
	 */
	public function getDistrictName() {
		return $this->districtName;
	}

	/**
	 * Sets the districtName
	 *
	 * @param string $districtName
	 * @return void
	 */
	public function setDistrictName($districtName) {
		$this->districtName = $districtName;
	}

	/**
	 * Returns the partyShort
	 *
	 * @return string $partyShort
	 */
	public function getPartyShort() {
		return $this->partyShort;
	}

	/**
	 * Sets the partyShort
	 *
	 * @param string $partyShort
	 * @return void
	 */
	public function setPartyShort($partyShort) {
		$this->partyShort = $partyShort;
	}

	/**
	 * Returns the incumbent
	 *
	 * @return boolean $incumbent
	 */
	public function getIncumbent() {
		return $this->incumbent;
	}

	/**
	 * Sets the incumbent
	 *
	 * @param boolean $incumbent
	 * @return void
	 */
	public function setIncumbent($incumbent) {
		$this->incumbent = $incumbent;
	}

	/**
	 * Returns the boolean state of incumbent
	 *
	 * @return boolean
	 */
	public function isIncumbent() {
		return $this->incumbent;
	}

	/**
	 * Returns the elected
	 *
	 * @return boolean $elected
	 */
	public function getElected() {
		return $this->elected;
	}

	/**
	 * Sets the elected
	 *
	 * @param boolean $elected
	 * @return void
	 */
	public function setElected($elected) {
		$this->elected = $elected;
	}

	/**
	 * Returns the boolean state of elected
	 *
	 * @return boolean
	 */
	public function isElected() {
		return $this->elected;
	}

	/**
	 * Returns the civilStateName
	 *
	 * @return string $civilStateName
	 */
	public function getCivilStateName() {
		return $this->civilStateName;
	}

	/**
	 * Sets the civilStateName
	 *
	 * @param string $civilStateName
	 * @return void
	 */
	public function setCivilStateName($civilStateName) {
		$this->civilStateName = $civilStateName;
	}

	/**
	 * Returns the denominationName
	 *
	 * @return string $denominationName
	 */
	public function getDenominationName() {
		return $this->denominationName;
	}

	/**
	 * Sets the denominationName
	 *
	 * @param string $denominationName
	 * @return void
	 */
	public function setDenominationName($denominationName) {
		$this->denominationName = $denominationName;
	}

	/**
	 * Returns the educationName
	 *
	 * @return string $educationName
	 */
	public function getEducationName() {
		return $this->educationName;
	}

	/**
	 * Sets the educationName
	 *
	 * @param string $educationName
	 * @return void
	 */
	public function setEducationName($educationName) {
		$this->educationName = $educationName;
	}

	/**
	 * Returns the employmentName
	 *
	 * @return string $employmentName
	 */
	public function getEmploymentName() {
		return $this->employmentName;
	}

	/**
	 * Sets the employmentName
	 *
	 * @param string $employmentName
	 * @return void
	 */
	public function setEmploymentName($employmentName) {
		$this->employmentName = $employmentName;
	}

	/**
	 * Returns the occupation
	 *
	 * @return string $occupation
	 */
	public function getOccupation() {
		return $this->occupation;
	}

	/**
	 * Sets the occupation
	 *
	 * @param string $occupation
	 * @return void
	 */
	public function setOccupation($occupation) {
		$this->occupation = $occupation;
	}

	/**
	 * Returns the numberOfChildren
	 *
	 * @return integer $numberOfChildren
	 */
	public function getNumberOfChildren() {
		return $this->numberOfChildren;
	}

	/**
	 * Sets the numberOfChildren
	 *
	 * @param integer $numberOfChildren
	 * @return void
	 */
	public function setNumberOfChildren($numberOfChildren) {
		$this->numberOfChildren = $numberOfChildren;
	}

	/**
	 * Returns the hobbies
	 *
	 * @return string $hobbies
	 */
	public function getHobbies() {
		return $this->hobbies;
	}

	/**
	 * Sets the hobbies
	 *
	 * @param string $hobbies
	 * @return void
	 */
	public function setHobbies($hobbies) {
		$this->hobbies = $hobbies;
	}

	/**
	 * Returns the favoriteBooks
	 *
	 * @return string $favoriteBooks
	 */
	public function getFavoriteBooks() {
		return $this->favoriteBooks;
	}

	/**
	 * Sets the favoriteBooks
	 *
	 * @param string $favoriteBooks
	 * @return void
	 */
	public function setFavoriteBooks($favoriteBooks) {
		$this->favoriteBooks = $favoriteBooks;
	}

	/**
	 * Returns the favoriteMusic
	 *
	 * @return string $favoriteMusic
	 */
	public function getFavoriteMusic() {
		return $this->favoriteMusic;
	}

	/**
	 * Sets the favoriteMusic
	 *
	 * @param string $favoriteMusic
	 * @return void
	 */
	public function setFavoriteMusic($favoriteMusic) {
		$this->favoriteMusic = $favoriteMusic;
	}

	/**
	 * Returns the favoriteMovies
	 *
	 * @return string $favoriteMovies
	 */
	public function getFavoriteMovies() {
		return $this->favoriteMovies;
	}

	/**
	 * Sets the favoriteMovies
	 *
	 * @param string $favoriteMovies
	 * @return void
	 */
	public function setFavoriteMovies($favoriteMovies) {
		$this->favoriteMovies = $favoriteMovies;
	}

	/**
	 * Returns the linkToSmartSpider
	 *
	 * @return string $linkToSmartSpider
	 */
	public function getLinkToSmartSpider() {
		return $this->linkToSmartSpider;
	}

	/**
	 * Sets the linkToSmartSpider
	 *
	 * @param string $linkToSmartSpider
	 * @return void
	 */
	public function setLinkToSmartSpider($linkToSmartSpider) {
		$this->linkToSmartSpider = $linkToSmartSpider;
	}

	/**
	 * Returns the linkToPortrait
	 *
	 * @return string $linkToPortrait
	 */
	public function getLinkToPortrait() {
		return $this->linkToPortrait;
	}

	/**
	 * Sets the linkToPortrait
	 *
	 * @param string $linkToPortrait
	 * @return void
	 */
	public function setLinkToPortrait($linkToPortrait) {
		$this->linkToPortrait = $linkToPortrait;
	}

	/**
	 * Returns the linkToFacebook
	 *
	 * @return string $linkToFacebook
	 */
	public function getLinkToFacebook() {
		return $this->linkToFacebook;
	}

	/**
	 * Sets the linkToFacebook
	 *
	 * @param string $linkToFacebook
	 * @return void
	 */
	public function setLinkToFacebook($linkToFacebook) {
		$this->linkToFacebook = $linkToFacebook;
	}

	/**
	 * Returns the linkToTwitter
	 *
	 * @return string $linkToTwitter
	 */
	public function getLinkToTwitter() {
		return $this->linkToTwitter;
	}

	/**
	 * Sets the linkToTwitter
	 *
	 * @param string $linkToTwitter
	 * @return void
	 */
	public function setLinkToTwitter($linkToTwitter) {
		$this->linkToTwitter = $linkToTwitter;
	}

	/**
	 * Returns the linkToPolitnetz
	 *
	 * @return string $linkToPolitnetz
	 */
	public function getLinkToPolitnetz() {
		return $this->linkToPolitnetz;
	}

	/**
	 * Sets the linkToPolitnetz
	 *
	 * @param string $linkToPolitnetz
	 * @return void
	 */
	public function setLinkToPolitnetz($linkToPolitnetz) {
		$this->linkToPolitnetz = $linkToPolitnetz;
	}

	/**
	 * Returns the linkToYoutube
	 *
	 * @return string $linkToYoutube
	 */
	public function getLinkToYoutube() {
		return $this->linkToYoutube;
	}

	/**
	 * Sets the linkToYoutube
	 *
	 * @param string $linkToYoutube
	 * @return void
	 */
	public function setLinkToYoutube($linkToYoutube) {
		$this->linkToYoutube = $linkToYoutube;
	}

	/**
	 * Returns the linkToVimeo
	 *
	 * @return string $linkToVimeo
	 */
	public function getLinkToVimeo() {
		return $this->linkToVimeo;
	}

	/**
	 * Sets the linkToVimeo
	 *
	 * @param string $linkToVimeo
	 * @return void
	 */
	public function setLinkToVimeo($linkToVimeo) {
		$this->linkToVimeo = $linkToVimeo;
	}

	/**
	 * Returns the email
	 *
	 * @return string $email
	 */
	public function getEmail() {
		return $this->email;
	}

	/**
	 * Sets the email
	 *
	 * @param string $email
	 * @return void
	 */
	public function setEmail($email) {
		$this->email = $email;
	}

	/**
	 * Returns the whyMe
	 *
	 * @return string $whyMe
	 */
	public function getWhyMe() {
		return $this->whyMe;
	}

	/**
	 * Sets the whyMe
	 *
	 * @param string $whyMe
	 * @return void
	 */
	public function setWhyMe($whyMe) {
		$this->whyMe = $whyMe;
	}

	/**
	 * Returns the slogan
	 *
	 * @return string $slogan
	 */
	public function getSlogan() {
		return $this->slogan;
	}

	/**
	 * Sets the slogan
	 *
	 * @param string $slogan
	 * @return void
	 */
	public function setSlogan($slogan) {
		$this->slogan = $slogan;
	}

	/**
	 * Returns the personalWebsite
	 *
	 * @return string $personalWebsite
	 */
	public function getPersonalWebsite() {
		return $this->personalWebsite;
	}

	/**
	 * Sets the personalWebsite
	 *
	 * @param string $personalWebsite
	 * @return void
	 */
	public function setPersonalWebsite($personalWebsite) {
		$this->personalWebsite = $personalWebsite;
	}

	/**
	 * Returns the electionListName
	 *
	 * @return string $electionListName
	 */
	public function getElectionListName() {
		return $this->electionListName;
	}

	/**
	 * Sets the electionListName
	 *
	 * @param string $electionListName
	 * @return void
	 */
	public function setElectionListName($electionListName) {
		$this->electionListName = $electionListName;
	}

	/**
	 * Returns the photos
	 *
	 * @return integer $photos
	 */
	public function getPhotos() {
		return $this->photos;
	}

	/**
	 * Sets the photos
	 *
	 * @param integer $photos
	 * @return void
	 */
	public function setPhotos($photos) {
		$this->photos = $photos;
	}

	/**
	 * Returns the links
	 *
	 * @return integer $links
	 */
	public function getLinks() {
		return $this->links;
	}

	/**
	 * Sets the links
	 *
	 * @param integer $links
	 * @return void
	 */
	public function setLinks($links) {
		$this->links = $links;
	}

	/**
	 * Returns the answers
	 *
	 * @return integer $answers
	 */
	public function getAnswers() {
		return $this->answers;
	}

	/**
	 * Sets the answers
	 *
	 * @param integer $answers
	 * @return void
	 */
	public function setAnswers($answers) {
		$this->answers = $answers;
	}

	/**
	 * Returns the spiderValues
	 *
	 * @return integer $spiderValues
	 */
	public function getSpiderValues() {
		return $this->spiderValues;
	}

	/**
	 * Sets the spiderValues
	 *
	 * @param integer $spiderValues
	 * @return void
	 */
	public function setSpiderValues($spiderValues) {
		$this->spiderValues = $spiderValues;
	}

	/**
	 * Returns the coordinate
	 *
	 * @return integer $coordinate
	 */
	public function getCoordinate() {
		return $this->coordinate;
	}

	/**
	 * Sets the coordinate
	 *
	 * @param integer $coordinate
	 * @return void
	 */
	public function setCoordinate($coordinate) {
		$this->coordinate = $coordinate;
	}

	/**
	 * Returns the serializedPhotos
	 *
	 * @return string $serializedPhotos
	 */
	public function getSerializedPhotos() {
		return $this->serializedPhotos;
	}

	/**
	 * Sets the serializedPhotos
	 *
	 * @param string $serializedPhotos
	 * @return void
	 */
	public function setSerializedPhotos($serializedPhotos) {
		$this->serializedPhotos = $serializedPhotos;
	}

	/**
	 * Returns the serializedLinks
	 *
	 * @return string $serializedLinks
	 */
	public function getSerializedLinks() {
		return $this->serializedLinks;
	}

	/**
	 * Sets the serializedLinks
	 *
	 * @param string $serializedLinks
	 * @return void
	 */
	public function setSerializedLinks($serializedLinks) {
		$this->serializedLinks = $serializedLinks;
	}

	/**
	 * Returns the serializedAnswers
	 *
	 * @return string $serializedAnswers
	 */
	public function getSerializedAnswers() {
		return $this->serializedAnswers;
	}

	/**
	 * Sets the serializedAnswers
	 *
	 * @param string $serializedAnswers
	 * @return void
	 */
	public function setSerializedAnswers($serializedAnswers) {
		$this->serializedAnswers = $serializedAnswers;
	}

	/**
	 * Returns the serializedSpiderValues
	 *
	 * @return string $serializedSpiderValues
	 */
	public function getSerializedSpiderValues() {
		return $this->serializedSpiderValues;
	}

	/**
	 * Sets the serializedSpiderValues
	 *
	 * @param string $serializedSpiderValues
	 * @return void
	 */
	public function setSerializedSpiderValues($serializedSpiderValues) {
		$this->serializedSpiderValues = $serializedSpiderValues;
	}

	/**
	 * Returns the serializedCoordinate
	 *
	 * @return string $serializedCoordinate
	 */
	public function getSerializedCoordinate() {
		return $this->serializedCoordinate;
	}

	/**
	 * Sets the serializedCoordinate
	 *
	 * @param string $serializedCoordinate
	 * @return void
	 */
	public function setSerializedCoordinate($serializedCoordinate) {
		$this->serializedCoordinate = $serializedCoordinate;
	}

	/**
	 * @return string
	 */
	public function getSerializedListPlaces() {
		return $this->serializedListPlaces;
	}

	/**
	 * @param string $serializedListPlaces
	 */
	public function setSerializedListPlaces($serializedListPlaces) {
		$this->serializedListPlaces = $serializedListPlaces;
	}

	/**
	 * Returns the party
	 *
	 * @return \Visol\EasyvoteSmartvote\Domain\Model\Party $party
	 */
	public function getParty() {
		return $this->party;
	}

	/**
	 * Sets the party
	 *
	 * @param \Visol\EasyvoteSmartvote\Domain\Model\Party $party
	 * @return void
	 */
	public function setParty(\Visol\EasyvoteSmartvote\Domain\Model\Party $party) {
		$this->party = $party;
	}

	/**
	 * @return \Visol\Easyvote\Domain\Model\Party
	 */
	public function getNationalParty() {
		return $this->nationalParty;
	}

	/**
	 * @param \Visol\Easyvote\Domain\Model\Party $nationalParty
	 */
	public function setNationalParty($nationalParty) {
		$this->nationalParty = $nationalParty;
	}

	/**
	 * Returns the district
	 *
	 * @return \Visol\EasyvoteSmartvote\Domain\Model\District $district
	 */
	public function getDistrict() {
		return $this->district;
	}

	/**
	 * Sets the district
	 *
	 * @param \Visol\EasyvoteSmartvote\Domain\Model\District $district
	 * @return void
	 */
	public function setDistrict(\Visol\EasyvoteSmartvote\Domain\Model\District $district) {
		$this->district = $district;
	}

	/**
	 * Returns the election
	 *
	 * @return \Visol\EasyvoteSmartvote\Domain\Model\Election $election
	 */
	public function getElection() {
		return $this->election;
	}

	/**
	 * Sets the election
	 *
	 * @param \Visol\EasyvoteSmartvote\Domain\Model\Election $election
	 * @return void
	 */
	public function setElection(\Visol\EasyvoteSmartvote\Domain\Model\Election $election) {
		$this->election = $election;
	}

	/**
	 * Returns the electionList
	 *
	 * @return \Visol\EasyvoteSmartvote\Domain\Model\ElectionList $electionList
	 */
	public function getElectionList() {
		return $this->electionList;
	}

	/**
	 * Sets the electionList
	 *
	 * @param \Visol\EasyvoteSmartvote\Domain\Model\ElectionList $electionList
	 * @return void
	 */
	public function setElectionList(\Visol\EasyvoteSmartvote\Domain\Model\ElectionList $electionList) {
		$this->electionList = $electionList;
	}

	/**
	 * Returns the civilState
	 *
	 * @return \Visol\EasyvoteSmartvote\Domain\Model\CivilState $civilState
	 */
	public function getCivilState() {
		return $this->civilState;
	}

	/**
	 * Sets the civilState
	 *
	 * @param \Visol\EasyvoteSmartvote\Domain\Model\CivilState $civilState
	 * @return void
	 */
	public function setCivilState(\Visol\EasyvoteSmartvote\Domain\Model\CivilState $civilState) {
		$this->civilState = $civilState;
	}

	/**
	 * Returns the denomination
	 *
	 * @return \Visol\EasyvoteSmartvote\Domain\Model\Denomination $denomination
	 */
	public function getDenomination() {
		return $this->denomination;
	}

	/**
	 * Sets the denomination
	 *
	 * @param \Visol\EasyvoteSmartvote\Domain\Model\Denomination $denomination
	 * @return void
	 */
	public function setDenomination(\Visol\EasyvoteSmartvote\Domain\Model\Denomination $denomination) {
		$this->denomination = $denomination;
	}

	/**
	 * Returns the education
	 *
	 * @return \Visol\EasyvoteSmartvote\Domain\Model\Education $education
	 */
	public function getEducation() {
		return $this->education;
	}

	/**
	 * Sets the education
	 *
	 * @param \Visol\EasyvoteSmartvote\Domain\Model\Education $education
	 * @return void
	 */
	public function setEducation(\Visol\EasyvoteSmartvote\Domain\Model\Education $education) {
		$this->education = $education;
	}

}