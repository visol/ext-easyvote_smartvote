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
	 * @var string
	 */
	protected $internalIdentifier = '';

	/**
	 * candidates
	 *
	 * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Visol\EasyvoteSmartvote\Domain\Model\Candidate>
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
	 * canton
	 *
	 * @var \Visol\Easyvote\Domain\Model\Kanton
	 * @lazy
	 */
	protected $canton = NULL;

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
	 * Adds a candidate
	 *
	 * @param  $candidate \Visol\EasyvoteSmartvote\Domain\Model\Candidate
	 * @return void
	 */
	public function addCandidate(\Visol\EasyvoteSmartvote\Domain\Model\Candidate $candidate) {
		$this->candidates->attach($candidate);
	}

	/**
	 * Removes a candidate
	 *
	 * @param $candidateToRemove \Visol\EasyvoteSmartvote\Domain\Model\Candidate The candidate to be removed
	 * @return void
	 */
	public function removeCandidate(\Visol\EasyvoteSmartvote\Domain\Model\Candidate $candidateToRemove) {
		$this->candidates->detach($candidateToRemove);
	}

	/**
	 * Returns the candidates
	 *
	 * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Visol\EasyvoteSmartvote\Domain\Model\Candidate> $candidates
	 */
	public function getCandidates() {
		return $this->candidates;
	}

	/**
	 * Sets the candidates
	 *
	 * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Visol\EasyvoteSmartvote\Domain\Model\Candidate> $candidates
	 * @return void
	 */
	public function setCandidates(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $candidates) {
		$this->candidates = $candidates;
	}

	/**
	 * Returns the election
	 *
	 * @return \Visol\EasyvoteSmartvote\Domain\Model\Election
	 */
	public function getElection() {
		return $this->election;
	}

	/**
	 * Sets the election
	 *
	 * @param $election \Visol\EasyvoteSmartvote\Domain\Model\Election
	 * @return void
	 */
	public function setElection(\Visol\EasyvoteSmartvote\Domain\Model\Election $election) {
		$this->election = $election;
	}

	/**
	 * @return \Visol\Easyvote\Domain\Model\Kanton
	 */
	public function getCanton() {
		return $this->canton;
	}

	/**
	 * @param \Visol\Easyvote\Domain\Model\Kanton $canton
	 */
	public function setCanton($canton) {
		$this->canton = $canton;
	}

}