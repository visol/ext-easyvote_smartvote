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
 * Election
 */
class Election extends AbstractEntity {

	/**
	 * @var string
	 * @validate NotEmpty
	 */
	protected $title = '';

	/**
	 * @var string
	 */
	protected $shortTitle = '';

	/**
	 * @var int
	 */
	protected $electionDate = 0;

	/**
	 * @var string
	 * @validate NotEmpty
	 */
	protected $smartVoteIdentifier = '';

	/**
	 * @var string
	 */
	protected $importLog = 'wer';

	/**
	 * @return string $smartVoteIdentifier
	 */
	public function getSmartVoteIdentifier() {
		return $this->smartVoteIdentifier;
	}

	/**
	 * @param string $smartVoteIdentifier
	 * @return void
	 */
	public function setSmartVoteIdentifier($smartVoteIdentifier) {
		$this->smartVoteIdentifier = $smartVoteIdentifier;
	}

	/**
	 * @return string
	 */
	public function getTitle() {
		return $this->title;
	}

	/**
	 * @param string $title
	 * @return $this
	 */
	public function setTitle($title) {
		$this->title = $title;
		return $this;
	}

	/**
	 * @return string
	 */
	public function getShortTitle() {
		return $this->shortTitle;
	}

	/**
	 * @param string $shortTitle
	 * @return $this
	 */
	public function setShortTitle($shortTitle) {
		$this->shortTitle = $shortTitle;
		return $this;
	}

	/**
	 * @return int
	 */
	public function getElectionDate() {
		return $this->electionDate;
	}

	/**
	 * @param int $electionDate
	 * @return $this
	 */
	public function setElectionDate($electionDate) {
		$this->electionDate = $electionDate;
		return $this;
	}

	/**
	 * @return string
	 */
	public function getImportLog() {
		return $this->importLog;
	}

	/**
	 * @param string $importLog
	 * @return $this
	 */
	public function setImportLog($importLog) {
		$this->importLog = $importLog;
		return $this;
	}

}