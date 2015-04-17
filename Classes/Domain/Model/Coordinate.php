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