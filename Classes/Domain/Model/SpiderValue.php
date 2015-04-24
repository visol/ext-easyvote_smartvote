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
 * SpiderValue
 */
class SpiderValue extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity {

	/**
	 * cleavage
	 *
	 * @var integer
	 */
	protected $cleavage = 0;

	/**
	 * internalIdentifier
	 *
	 * @var integer
	 */
	protected $internalIdentifier = 0;

	/**
	 * value
	 *
	 * @var float
	 */
	protected $value = 0.0;

	/**
	 * election
	 *
	 * @var \Visol\EasyvoteSmartvote\Domain\Model\Election
	 */
	protected $election = NULL;

	/**
	 * Returns the cleavage
	 *
	 * @return integer $cleavage
	 */
	public function getCleavage() {
		return $this->cleavage;
	}

	/**
	 * Sets the cleavage
	 *
	 * @param integer $cleavage
	 * @return void
	 */
	public function setCleavage($cleavage) {
		$this->cleavage = $cleavage;
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
	 * Returns the value
	 *
	 * @return float $value
	 */
	public function getValue() {
		return $this->value;
	}

	/**
	 * Sets the value
	 *
	 * @param float $value
	 * @return void
	 */
	public function setValue($value) {
		$this->value = $value;
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