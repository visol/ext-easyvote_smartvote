<?php
namespace Visol\EasyvoteSmartvote\Tests\Unit\Importer;

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

use Visol\EasyvoteSmartvote\Domain\Model\Election;
use Visol\EasyvoteSmartvote\Enumeration\Language;
use Visol\EasyvoteSmartvote\Enumeration\Model;
use Visol\EasyvoteSmartvote\Importer\PartyImporter;

/**
 * Import Parties from Smart Vote
 */
class PartyTest extends \TYPO3\CMS\Core\Tests\UnitTestCase {

	/**
	 * @var PartyImporter
	 */
	protected $fixture;

	/**
	 * @var \ReflectionClass
	 */
	protected $reflection;

	protected function setUp() {
		$election = new Election();
		$this->fixture = new PartyImporter($election);
		$this->reflection = new \ReflectionClass($this->fixture);

		$property = $this->reflection->getProperty('baseUrl');
		$property->setAccessible(true);
		$property->setValue($this->fixture, 'http://bar');

		$property = $this->reflection->getProperty('key');
		$property->setAccessible(true);
		$property->setValue($this->fixture, '123456');
	}

	protected function tearDown() {
		unset($this->fixture);
	}

	/**
	 * @test
	 */
	public function canInstantiateObject() {

		// Makes method public
		$method = new \ReflectionMethod(
			PartyImporter::class, 'getUrl'
		);
		$method->setAccessible(TRUE);

		$smartVoteIdentifier = 'foo';
		$dataType = Model::PARTY;
		$locale = Language::GERMAN;

		$actual = $method->invokeArgs($this->fixture, array($smartVoteIdentifier, $dataType, $locale));
		$expected = 'http://bar/foo/parties.json?lang=de_CH&key=123456';

		$this->assertEquals($expected, $actual);
	}

}
