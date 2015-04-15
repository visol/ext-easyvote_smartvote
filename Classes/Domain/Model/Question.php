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
 * Question
 */
class Question extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity {

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
	 * groupping
	 *
	 * @var integer
	 */
	protected $groupping = 0;

	/**
	 * type
	 *
	 * @var string
	 */
	protected $type = '';

	/**
	 * rapide
	 *
	 * @var boolean
	 */
	protected $rapide = FALSE;

	/**
	 * education
	 *
	 * @var boolean
	 */
	protected $education = FALSE;

	/**
	 * cleavage1
	 *
	 * @var integer
	 */
	protected $cleavage1 = 0;

	/**
	 * cleavage2
	 *
	 * @var integer
	 */
	protected $cleavage2 = 0;

	/**
	 * cleavage3
	 *
	 * @var integer
	 */
	protected $cleavage3 = 0;

	/**
	 * cleavage4
	 *
	 * @var string
	 */
	protected $cleavage4 = '';

	/**
	 * cleavage5
	 *
	 * @var string
	 */
	protected $cleavage5 = '';

	/**
	 * cleavage6
	 *
	 * @var string
	 */
	protected $cleavage6 = '';

	/**
	 * cleavage7
	 *
	 * @var string
	 */
	protected $cleavage7 = '';

	/**
	 * cleavage8
	 *
	 * @var string
	 */
	protected $cleavage8 = '';

	/**
	 * info
	 *
	 * @var string
	 */
	protected $info = '';

	/**
	 * pro
	 *
	 * @var string
	 */
	protected $pro = '';

	/**
	 * contra
	 *
	 * @var string
	 */
	protected $contra = '';

	/**
	 * election
	 *
	 * @var \Visol\EasyvoteSmartvote\Domain\Model\Election
	 */
	protected $election = NULL;

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
	 * Returns the groupping
	 *
	 * @return integer $groupping
	 */
	public function getGroupping() {
		return $this->groupping;
	}

	/**
	 * Sets the groupping
	 *
	 * @param integer $groupping
	 * @return void
	 */
	public function setGroupping($groupping) {
		$this->groupping = $groupping;
	}

	/**
	 * Returns the type
	 *
	 * @return string $type
	 */
	public function getType() {
		return $this->type;
	}

	/**
	 * Sets the type
	 *
	 * @param string $type
	 * @return void
	 */
	public function setType($type) {
		$this->type = $type;
	}

	/**
	 * Returns the rapide
	 *
	 * @return boolean $rapide
	 */
	public function getRapide() {
		return $this->rapide;
	}

	/**
	 * Sets the rapide
	 *
	 * @param boolean $rapide
	 * @return void
	 */
	public function setRapide($rapide) {
		$this->rapide = $rapide;
	}

	/**
	 * Returns the boolean state of rapide
	 *
	 * @return boolean
	 */
	public function isRapide() {
		return $this->rapide;
	}

	/**
	 * Returns the education
	 *
	 * @return boolean $education
	 */
	public function getEducation() {
		return $this->education;
	}

	/**
	 * Sets the education
	 *
	 * @param boolean $education
	 * @return void
	 */
	public function setEducation($education) {
		$this->education = $education;
	}

	/**
	 * Returns the boolean state of education
	 *
	 * @return boolean
	 */
	public function isEducation() {
		return $this->education;
	}

	/**
	 * Returns the cleavage1
	 *
	 * @return integer $cleavage1
	 */
	public function getCleavage1() {
		return $this->cleavage1;
	}

	/**
	 * Sets the cleavage1
	 *
	 * @param integer $cleavage1
	 * @return void
	 */
	public function setCleavage1($cleavage1) {
		$this->cleavage1 = $cleavage1;
	}

	/**
	 * Returns the cleavage2
	 *
	 * @return integer $cleavage2
	 */
	public function getCleavage2() {
		return $this->cleavage2;
	}

	/**
	 * Sets the cleavage2
	 *
	 * @param integer $cleavage2
	 * @return void
	 */
	public function setCleavage2($cleavage2) {
		$this->cleavage2 = $cleavage2;
	}

	/**
	 * Returns the cleavage3
	 *
	 * @return integer $cleavage3
	 */
	public function getCleavage3() {
		return $this->cleavage3;
	}

	/**
	 * Sets the cleavage3
	 *
	 * @param integer $cleavage3
	 * @return void
	 */
	public function setCleavage3($cleavage3) {
		$this->cleavage3 = $cleavage3;
	}

	/**
	 * Returns the cleavage4
	 *
	 * @return string $cleavage4
	 */
	public function getCleavage4() {
		return $this->cleavage4;
	}

	/**
	 * Sets the cleavage4
	 *
	 * @param string $cleavage4
	 * @return void
	 */
	public function setCleavage4($cleavage4) {
		$this->cleavage4 = $cleavage4;
	}

	/**
	 * Returns the cleavage5
	 *
	 * @return string $cleavage5
	 */
	public function getCleavage5() {
		return $this->cleavage5;
	}

	/**
	 * Sets the cleavage5
	 *
	 * @param string $cleavage5
	 * @return void
	 */
	public function setCleavage5($cleavage5) {
		$this->cleavage5 = $cleavage5;
	}

	/**
	 * Returns the cleavage6
	 *
	 * @return string $cleavage6
	 */
	public function getCleavage6() {
		return $this->cleavage6;
	}

	/**
	 * Sets the cleavage6
	 *
	 * @param string $cleavage6
	 * @return void
	 */
	public function setCleavage6($cleavage6) {
		$this->cleavage6 = $cleavage6;
	}

	/**
	 * Returns the cleavage7
	 *
	 * @return string $cleavage7
	 */
	public function getCleavage7() {
		return $this->cleavage7;
	}

	/**
	 * Sets the cleavage7
	 *
	 * @param string $cleavage7
	 * @return void
	 */
	public function setCleavage7($cleavage7) {
		$this->cleavage7 = $cleavage7;
	}

	/**
	 * Returns the cleavage8
	 *
	 * @return string $cleavage8
	 */
	public function getCleavage8() {
		return $this->cleavage8;
	}

	/**
	 * Sets the cleavage8
	 *
	 * @param string $cleavage8
	 * @return void
	 */
	public function setCleavage8($cleavage8) {
		$this->cleavage8 = $cleavage8;
	}

	/**
	 * Returns the info
	 *
	 * @return string $info
	 */
	public function getInfo() {
		return $this->info;
	}

	/**
	 * Sets the info
	 *
	 * @param string $info
	 * @return void
	 */
	public function setInfo($info) {
		$this->info = $info;
	}

	/**
	 * Returns the pro
	 *
	 * @return string $pro
	 */
	public function getPro() {
		return $this->pro;
	}

	/**
	 * Sets the pro
	 *
	 * @param string $pro
	 * @return void
	 */
	public function setPro($pro) {
		$this->pro = $pro;
	}

	/**
	 * Returns the contra
	 *
	 * @return string $contra
	 */
	public function getContra() {
		return $this->contra;
	}

	/**
	 * Sets the contra
	 *
	 * @param string $contra
	 * @return void
	 */
	public function setContra($contra) {
		$this->contra = $contra;
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