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
 * Party
 */
class Party extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity {

	/**
	 * name
	 *
	 * @var string
	 */
	protected $name = '';

	/**
	 * internalIdentifier
	 *
	 * @var string
	 */
	protected $internalIdentifier = '';

	/**
	 * nameShort
	 *
	 * @var string
	 */
	protected $nameShort = '';

	/**
	 * logo
	 *
	 * @var string
	 */
	protected $logo = '';

	/**
	 * numberOfCandidates
	 *
	 * @var integer
	 */
	protected $numberOfCandidates = 0;

	/**
	 * numberOfAnswers
	 *
	 * @var integer
	 */
	protected $numberOfAnswers = 0;

	/**
	 * facebookProfile
	 *
	 * @var string
	 */
	protected $facebookProfile = '';

	/**
	 * website
	 *
	 * @var string
	 */
	protected $website = '';

	/**
	 * candidates
	 *
	 * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<>
	 * @cascade remove
	 */
	protected $candidates = NULL;

	/**
	 * election
	 *
	 * @var \Visol\EasyvoteSmartvote\Domain\Model\Election
	 */
	protected $election = NULL;

	/**
	 * __construct
	 */
	public function __construct() {
		//Do not remove the next line: It would break the functionality
		$this->initStorageObjects();
	}

	/**
	 * Initializes all ObjectStorage properties
	 * Do not modify this method!
	 * It will be rewritten on each save in the extension builder
	 * You may modify the constructor of this class instead
	 *
	 * @return void
	 */
	protected function initStorageObjects() {
		$this->candidates = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
	}

	/**
	 * Returns the name
	 *
	 * @return string $name
	 */
	public function getName() {
		return $this->name;
	}

	/**
	 * Sets the name
	 *
	 * @param string $name
	 * @return void
	 */
	public function setName($name) {
		$this->name = $name;
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
	 * Returns the nameShort
	 *
	 * @return string $nameShort
	 */
	public function getNameShort() {
		return $this->nameShort;
	}

	/**
	 * Sets the nameShort
	 *
	 * @param string $nameShort
	 * @return void
	 */
	public function setNameShort($nameShort) {
		$this->nameShort = $nameShort;
	}

	/**
	 * Returns the logo
	 *
	 * @return string $logo
	 */
	public function getLogo() {
		return $this->logo;
	}

	/**
	 * Sets the logo
	 *
	 * @param string $logo
	 * @return void
	 */
	public function setLogo($logo) {
		$this->logo = $logo;
	}

	/**
	 * Returns the numberOfCandidates
	 *
	 * @return integer $numberOfCandidates
	 */
	public function getNumberOfCandidates() {
		return $this->numberOfCandidates;
	}

	/**
	 * Sets the numberOfCandidates
	 *
	 * @param integer $numberOfCandidates
	 * @return void
	 */
	public function setNumberOfCandidates($numberOfCandidates) {
		$this->numberOfCandidates = $numberOfCandidates;
	}

	/**
	 * Returns the numberOfAnswers
	 *
	 * @return integer $numberOfAnswers
	 */
	public function getNumberOfAnswers() {
		return $this->numberOfAnswers;
	}

	/**
	 * Sets the numberOfAnswers
	 *
	 * @param integer $numberOfAnswers
	 * @return void
	 */
	public function setNumberOfAnswers($numberOfAnswers) {
		$this->numberOfAnswers = $numberOfAnswers;
	}

	/**
	 * Returns the facebookProfile
	 *
	 * @return string $facebookProfile
	 */
	public function getFacebookProfile() {
		return $this->facebookProfile;
	}

	/**
	 * Sets the facebookProfile
	 *
	 * @param string $facebookProfile
	 * @return void
	 */
	public function setFacebookProfile($facebookProfile) {
		$this->facebookProfile = $facebookProfile;
	}

	/**
	 * Returns the website
	 *
	 * @return string $website
	 */
	public function getWebsite() {
		return $this->website;
	}

	/**
	 * Sets the website
	 *
	 * @param string $website
	 * @return void
	 */
	public function setWebsite($website) {
		$this->website = $website;
	}

	/**
	 * Adds a
	 *
	 * @param  $candidate
	 * @return void
	 */
	public function addCandidate($candidate) {
		$this->candidates->attach($candidate);
	}

	/**
	 * Removes a
	 *
	 * @param $candidateToRemove The  to be removed
	 * @return void
	 */
	public function removeCandidate($candidateToRemove) {
		$this->candidates->detach($candidateToRemove);
	}

	/**
	 * Returns the candidates
	 *
	 * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<> $candidates
	 */
	public function getCandidates() {
		return $this->candidates;
	}

	/**
	 * Sets the candidates
	 *
	 * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<> $candidates
	 * @return void
	 */
	public function setCandidates(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $candidates) {
		$this->candidates = $candidates;
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