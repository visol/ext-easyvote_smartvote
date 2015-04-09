<?php
namespace Visol\EasyvoteSmartvote\Domain\Model;


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
 * Candidate
 */
class Candidate extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity {

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
	 * language
	 *
	 * @var string
	 */
	protected $language = '';

	/**
	 * city
	 *
	 * @var string
	 */
	protected $city = '';

	/**
	 * incumbent
	 *
	 * @var boolean
	 */
	protected $incumbent = FALSE;

	/**
	 * elected
	 *
	 * @var boolean
	 */
	protected $elected = FALSE;

	/**
	 * party
	 *
	 * @var \Visol\EasyvoteSmartvote\Domain\Model\Party
	 */
	protected $party = NULL;

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

}