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
 * Election
 */
class Election extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity {

	/**
	 * smartVoteIdentifier
	 *
	 * @var string
	 * @validate NotEmpty
	 */
	protected $smartVoteIdentifier = '';

	/**
	 * type
	 *
	 * @var integer
	 */
	protected $type = 0;

	/**
	 * year
	 *
	 * @var integer
	 */
	protected $year = 0;

	/**
	 * Returns the smartVoteIdentifier
	 *
	 * @return string $smartVoteIdentifier
	 */
	public function getSmartVoteIdentifier() {
		return $this->smartVoteIdentifier;
	}

	/**
	 * Sets the smartVoteIdentifier
	 *
	 * @param string $smartVoteIdentifier
	 * @return void
	 */
	public function setSmartVoteIdentifier($smartVoteIdentifier) {
		$this->smartVoteIdentifier = $smartVoteIdentifier;
	}

	/**
	 * Returns the type
	 *
	 * @return integer $type
	 */
	public function getType() {
		return $this->type;
	}

	/**
	 * Sets the type
	 *
	 * @param integer $type
	 * @return void
	 */
	public function setType($type) {
		$this->type = $type;
	}

	/**
	 * Returns the year
	 *
	 * @return integer $year
	 */
	public function getYear() {
		return $this->year;
	}

	/**
	 * Sets the year
	 *
	 * @param integer $year
	 * @return void
	 */
	public function setYear($year) {
		$this->year = $year;
	}

}