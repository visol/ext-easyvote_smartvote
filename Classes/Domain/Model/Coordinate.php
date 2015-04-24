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
 * Coordinate
 */
class Coordinate extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity {

	/**
	 * x
	 *
	 * @var float
	 */
	protected $x = 0.0;

	/**
	 * y
	 *
	 * @var float
	 */
	protected $y = 0.0;

	/**
	 * election
	 *
	 * @var \Visol\EasyvoteSmartvote\Domain\Model\Election
	 */
	protected $election = NULL;

	/**
	 * Returns the x
	 *
	 * @return float $x
	 */
	public function getX() {
		return $this->x;
	}

	/**
	 * Sets the x
	 *
	 * @param float $x
	 * @return void
	 */
	public function setX($x) {
		$this->x = $x;
	}

	/**
	 * Returns the y
	 *
	 * @return float $y
	 */
	public function getY() {
		return $this->y;
	}

	/**
	 * Sets the y
	 *
	 * @param float $y
	 * @return void
	 */
	public function setY($y) {
		$this->y = $y;
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