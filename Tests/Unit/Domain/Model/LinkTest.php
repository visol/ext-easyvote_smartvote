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
 * Test case for class \Visol\EasyvoteSmartvote\Domain\Model\Link.
 *
 * @copyright Copyright belongs to the respective authors
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 *
 * @author Fabien Udriot <fabien@omic.ch>
 */
class LinkTest extends \TYPO3\CMS\Core\Tests\UnitTestCase {
	/**
	 * @var \Visol\EasyvoteSmartvote\Domain\Model\Link
	 */
	protected $subject = NULL;

	protected function setUp() {
		$this->subject = new \Visol\EasyvoteSmartvote\Domain\Model\Link();
	}

	protected function tearDown() {
		unset($this->subject);
	}

	/**
	 * @test
	 */
	public function getUrlReturnsInitialValueForString() {
		$this->assertSame(
			'',
			$this->subject->getUrl()
		);
	}

	/**
	 * @test
	 */
	public function setUrlForStringSetsUrl() {
		$this->subject->setUrl('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'url',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getDescriptionReturnsInitialValueForString() {
		$this->assertSame(
			'',
			$this->subject->getDescription()
		);
	}

	/**
	 * @test
	 */
	public function setDescriptionForStringSetsDescription() {
		$this->subject->setDescription('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'description',
			$this->subject
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
