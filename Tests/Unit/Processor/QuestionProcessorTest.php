<?php
namespace Visol\EasyvoteSmartvote\Tests\Unit\Processor;

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

use TYPO3\CMS\Core\Tests\UnitTestCase;

/**
 * Import Parties from Smart Vote
 */
class QuestionProcessorTest extends UnitTestCase {

	/**
	 * @var \Visol\EasyvoteSmartvote\Processor\QuestionProcessor
	 */
	protected $fixture;

	/**
	 * @var array
	 */
	protected $fakeQuestions = [
		[
			'uid' => 1,
			'name' => 'foo',
		], [
			'uid' => 2,
			'name' => 'bar',
		],
	];

	protected function setUp() {
		$this->fixture = new \Visol\EasyvoteSmartvote\Processor\QuestionProcessor();
	}

	protected function tearDown() {
		unset($this->fixture);
	}

	/**
	 * @test
	 */
	public function processQuestionAndCheckOrderIsReversed() {
		$results = $this->fixture->process($this->fakeQuestions);
		$this->assertEquals(2, $results[0]['uid']);
	}

	/**
	 * @test
	 */
	public function processQuestionAndCheckFirstItemContainsAdditionalKeys() {
		$results = $this->fixture->process($this->fakeQuestions);
		$this->assertArrayHasKey('index', $results[0]);
		$this->assertArrayHasKey('visible', $results[0]);
		$this->assertArrayHasKey('answer', $results[0]);
	}

	/**
	 * @test
	 */
	public function processQuestionReturnsArray() {
		$results = $this->fixture->process($this->fakeQuestions);
		$this->assertTrue(is_array($results));
	}

}
