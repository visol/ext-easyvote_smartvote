<?php

namespace Visol\EasyvoteSmartvote\Tests\Unit\Domain\Model;

/***************************************************************
 *  Copyright notice
 *
 *  (c) 2015 Fabien Udriot <fabien@omic.ch>, Visol
 *
 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 2 of the License, or
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
 * Test case for class \Visol\EasyvoteSmartvote\Domain\Model\District.
 *
 * @copyright Copyright belongs to the respective authors
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 *
 * @author Fabien Udriot <fabien@omic.ch>
 */
class DistrictTest extends \TYPO3\CMS\Core\Tests\UnitTestCase {
	/**
	 * @var \Visol\EasyvoteSmartvote\Domain\Model\District
	 */
	protected $subject = NULL;

	protected function setUp() {
		$this->subject = new \Visol\EasyvoteSmartvote\Domain\Model\District();
	}

	protected function tearDown() {
		unset($this->subject);
	}

	/**
	 * @test
	 */
	public function getNameReturnsInitialValueForString() {
		$this->assertSame(
			'',
			$this->subject->getName()
		);
	}

	/**
	 * @test
	 */
	public function setNameForStringSetsName() {
		$this->subject->setName('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'name',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getSeatsReturnsInitialValueForInteger() {
		$this->assertSame(
			0,
			$this->subject->getSeats()
		);
	}

	/**
	 * @test
	 */
	public function setSeatsForIntegerSetsSeats() {
		$this->subject->setSeats(12);

		$this->assertAttributeEquals(
			12,
			'seats',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getInternalIdentifierReturnsInitialValueForString() {
		$this->assertSame(
			'',
			$this->subject->getInternalIdentifier()
		);
	}

	/**
	 * @test
	 */
	public function setInternalIdentifierForStringSetsInternalIdentifier() {
		$this->subject->setInternalIdentifier('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'internalIdentifier',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getCandidatesReturnsInitialValueFor() {
		$newObjectStorage = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
		$this->assertEquals(
			$newObjectStorage,
			$this->subject->getCandidates()
		);
	}

	/**
	 * @test
	 */
	public function getElectionReturnsInitialValueForElection() {
		$newObjectStorage = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
		$this->assertEquals(
			$newObjectStorage,
			$this->subject->getElection()
		);
	}

	/**
	 * @test
	 */
	public function setElectionForObjectStorageContainingElectionSetsElection() {
		$election = new \Visol\EasyvoteSmartvote\Domain\Model\Election();
		$objectStorageHoldingExactlyOneElection = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
		$objectStorageHoldingExactlyOneElection->attach($election);
		$this->subject->setElection($objectStorageHoldingExactlyOneElection);

		$this->assertAttributeEquals(
			$objectStorageHoldingExactlyOneElection,
			'election',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function addElectionToObjectStorageHoldingElection() {
		$election = new \Visol\EasyvoteSmartvote\Domain\Model\Election();
		$electionObjectStorageMock = $this->getMock('TYPO3\\CMS\\Extbase\\Persistence\\ObjectStorage', array('attach'), array(), '', FALSE);
		$electionObjectStorageMock->expects($this->once())->method('attach')->with($this->equalTo($election));
		$this->inject($this->subject, 'election', $electionObjectStorageMock);

		$this->subject->addElection($election);
	}

	/**
	 * @test
	 */
	public function removeElectionFromObjectStorageHoldingElection() {
		$election = new \Visol\EasyvoteSmartvote\Domain\Model\Election();
		$electionObjectStorageMock = $this->getMock('TYPO3\\CMS\\Extbase\\Persistence\\ObjectStorage', array('detach'), array(), '', FALSE);
		$electionObjectStorageMock->expects($this->once())->method('detach')->with($this->equalTo($election));
		$this->inject($this->subject, 'election', $electionObjectStorageMock);

		$this->subject->removeElection($election);

	}
}
