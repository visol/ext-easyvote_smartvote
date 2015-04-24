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
 * Photo
 */
class Photo extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity {

	/**
	 * fileNameAndPath
	 *
	 * @var string
	 */
	protected $fileNameAndPath = '';

	/**
	 * election
	 *
	 * @var \Visol\EasyvoteSmartvote\Domain\Model\Election
	 */
	protected $election = NULL;

	/**
	 * Returns the fileNameAndPath
	 *
	 * @return string $fileNameAndPath
	 */
	public function getFileNameAndPath() {
		return $this->fileNameAndPath;
	}

	/**
	 * Sets the fileNameAndPath
	 *
	 * @param string $fileNameAndPath
	 * @return void
	 */
	public function setFileNameAndPath($fileNameAndPath) {
		$this->fileNameAndPath = $fileNameAndPath;
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