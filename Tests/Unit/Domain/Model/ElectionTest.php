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
 * Test case for class \Visol\EasyvoteSmartvote\Domain\Model\Election.
 *
 * @copyright Copyright belongs to the respective authors
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 *
 * @author Fabien Udriot <fabien@omic.ch>
 */
class ElectionTest extends \TYPO3\CMS\Core\Tests\UnitTestCase {
	/**
	 * @var \Visol\EasyvoteSmartvote\Domain\Model\Election
	 */
	protected $subject = NULL;

	protected function setUp() {
		$this->subject = new \Visol\EasyvoteSmartvote\Domain\Model\Election();
	}

	protected function tearDown() {
		unset($this->subject);
	}

	/**
	 * @test
	 */
	public function getSmartVoteIdentifierReturnsInitialValueForString() {
		$this->assertSame(
			'',
			$this->subject->getSmartVoteIdentifier()
		);
	}

	/**
	 * @test
	 */
	public function setSmartVoteIdentifierForStringSetsSmartVoteIdentifier() {
		$this->subject->setSmartVoteIdentifier('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'smartVoteIdentifier',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getTypeReturnsInitialValueForInteger() {
		$this->assertSame(
			0,
			$this->subject->getType()
		);
	}

	/**
	 * @test
	 */
	public function setTypeForIntegerSetsType() {
		$this->subject->setType(12);

		$this->assertAttributeEquals(
			12,
			'type',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getYearReturnsInitialValueForInteger() {
		$this->assertSame(
			0,
			$this->subject->getYear()
		);
	}

	/**
	 * @test
	 */
	public function setYearForIntegerSetsYear() {
		$this->subject->setYear(12);

		$this->assertAttributeEquals(
			12,
			'year',
			$this->subject
		);
	}
}
