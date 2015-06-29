<?php
namespace Visol\EasyvoteSmartvote\Processor;

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
 * Processor Interface
 */
class CandidateProcessor extends AbstractProcessor {

	/**
	 * @param $items
	 * @return array
	 */
	public function process(array $items) {
		$items = $this->deserializeSomeValues($items);
		$items = $this->convertKeysToCamelCase($items);
		$items = $this->convertToInteger($items);
		return $items;
	}

	/**
	 * @param array $items
	 * @return array
	 */
	protected function convertToInteger(array $items) {
		$convertedItems = array();
		foreach ($items as $item) {
			$item['uid'] = (int)$item['uid'];
			$item['yearOfBirth'] = (int)$item['yearOfBirth'];
			$item['elected'] = (int)$item['elected'];
			$convertedItems[] = $item;
		}
		return $convertedItems;
	}

	/**
	 * @param array $items
	 * @return array
	 */
	protected function deserializeSomeValues(array $items) {
		$itemsWithNewValues = array();
		foreach ($items as $index => $item) {

			// Adding SpiderChartValues
			$spiderChartValues = json_decode($item['serialized_photos'], TRUE);
			$photo = is_array($spiderChartValues) && isset($spiderChartValues[0]) ? $spiderChartValues[0] : '';
			$item['photo'] = 'https://www.smartvote.ch' . $photo;
			unset($item['serialized_photos']);

			// Adding SpiderChartValues
			$spiderChartValues = json_decode($item['serialized_spider_values'], TRUE);
			$item['spiderChart'] = $spiderChartValues;
			unset($item['serialized_spider_values']);

			// Adding answers
			$answers = json_decode($item['serialized_answers'], TRUE);
			$item['answers'] = $this->optimizeAnswers($answers);
			unset($item['serialized_answers']);

			$itemsWithNewValues[$index] = $item;
		}

		return $itemsWithNewValues;
	}

	/**
	 * @param array $answers
	 * @return array
	 */
	protected function optimizeAnswers(array $answers) {
		$optimizedAnswers = array();
		foreach ($answers as $answer) {
			unset($answer['comment']);
			$optimizedAnswers[] = $answer;
		}
		return $optimizedAnswers;
	}

}