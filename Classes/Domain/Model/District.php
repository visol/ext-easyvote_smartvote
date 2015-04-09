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
 * District
 */
class District extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity {

	/**
	 * name
	 *
	 * @var string
	 */
	protected $name = '';

	/**
	 * seats
	 *
	 * @var integer
	 */
	protected $seats = 0;

	/**
	 * internalIdentifier
	 *
	 * @var integer
	 */
	protected $internalIdentifier = 0;

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
	 * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Visol\EasyvoteSmartvote\Domain\Model\Election>
	 * @cascade remove
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
		$this->election = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
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
	 * Returns the seats
	 *
	 * @return integer $seats
	 */
	public function getSeats() {
		return $this->seats;
	}

	/**
	 * Sets the seats
	 *
	 * @param integer $seats
	 * @return void
	 */
	public function setSeats($seats) {
		$this->seats = $seats;
	}

	/**
	 * Returns the internalIdentifier
	 *
	 * @return integer $internalIdentifier
	 */
	public function getInternalIdentifier() {
		return $this->internalIdentifier;
	}

	/**
	 * Sets the internalIdentifier
	 *
	 * @param integer $internalIdentifier
	 * @return void
	 */
	public function setInternalIdentifier($internalIdentifier) {
		$this->internalIdentifier = $internalIdentifier;
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
	 * Adds a Election
	 *
	 * @param \Visol\EasyvoteSmartvote\Domain\Model\Election $election
	 * @return void
	 */
	public function addElection(\Visol\EasyvoteSmartvote\Domain\Model\Election $election) {
		$this->election->attach($election);
	}

	/**
	 * Removes a Election
	 *
	 * @param \Visol\EasyvoteSmartvote\Domain\Model\Election $electionToRemove The Election to be removed
	 * @return void
	 */
	public function removeElection(\Visol\EasyvoteSmartvote\Domain\Model\Election $electionToRemove) {
		$this->election->detach($electionToRemove);
	}

	/**
	 * Returns the election
	 *
	 * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Visol\EasyvoteSmartvote\Domain\Model\Election> $election
	 */
	public function getElection() {
		return $this->election;
	}

	/**
	 * Sets the election
	 *
	 * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Visol\EasyvoteSmartvote\Domain\Model\Election> $election
	 * @return void
	 */
	public function setElection(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $election) {
		$this->election = $election;
	}

}