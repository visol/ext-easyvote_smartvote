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