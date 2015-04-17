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
 * Test case for class \Visol\EasyvoteSmartvote\Domain\Model\Coordinate.
 *
 * @copyright Copyright belongs to the respective authors
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 *
 * @author Fabien Udriot <fabien@omic.ch>
 */
class CoordinateTest extends \TYPO3\CMS\Core\Tests\UnitTestCase {
	/**
	 * @var \Visol\EasyvoteSmartvote\Domain\Model\Coordinate
	 */
	protected $subject = NULL;

	protected function setUp() {
		$this->subject = new \Visol\EasyvoteSmartvote\Domain\Model\Coordinate();
	}

	protected function tearDown() {
		unset($this->subject);
	}

	/**
	 * @test
	 */
	public function getXReturnsInitialValueForFloat() {
		$this->assertSame(
			0.0,
			$this->subject->getX()
		);
	}

	/**
	 * @test
	 */
	public function setXForFloatSetsX() {
		$this->subject->setX(3.14159265);

		$this->assertAttributeEquals(
			3.14159265,
			'x',
			$this->subject,
			'',
			0.000000001
		);
	}

	/**
	 * @test
	 */
	public function getYReturnsInitialValueForFloat() {
		$this->assertSame(
			0.0,
			$this->subject->getY()
		);
	}

	/**
	 * @test
	 */
	public function setYForFloatSetsY() {
		$this->subject->setY(3.14159265);

		$this->assertAttributeEquals(
			3.14159265,
			'y',
			$this->subject,
			'',
			0.000000001
		);
	}

	/**
	 * @test
	 */
	public function getElectionReturnsInitialValueForElection() {
		$this->assertEquals(
			NULL,
			$this->subject->getElection()
		);
	}

	/**
	 * @test
	 */
	public function setElectionForElectionSetsElection() {
		$electionFixture = new \Visol\EasyvoteSmartvote\Domain\Model\Election();
		$this->subject->setElection($electionFixture);

		$this->assertAttributeEquals(
			$electionFixture,
			'election',
			$this->subject
		);
	}
}
