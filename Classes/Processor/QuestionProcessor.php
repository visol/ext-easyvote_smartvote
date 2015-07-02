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
use TYPO3\CMS\Core\Utility\GeneralUtility;

/**
 * Processor Interface
 */
class QuestionProcessor extends AbstractProcessor {

	/**
	 * @param $items
	 * @return array
	 */
	public function process(array $items) {
		$items = $this->addSomeDynamicValues($items);
		$items = $this->revertOrderOfItems($items);
		$items = $this->convertKeysToCamelCase($items);
		$items = $this->parseQuestionName($items);
		$items = $this->convertToInteger($items);
		$items = $this->convertUidToId($items);
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
			$item['alternativeId'] = (int)$item['alternativeUid'];
			unset($item['alternativeUid']);
			$convertedItems[] = $item;
		}
		return $convertedItems;
	}

	/**
	 * @param array $items
	 * @return array
	 */
	protected function addSomeDynamicValues(array $items) {
		$itemsWithNewValues = array();
		foreach ($items as $index => $item) {
			$item['index'] = $index + 1;
			$item['answer'] = NULL;
			$item['visible'] = $index === 0 ? TRUE : FALSE;
			$itemsWithNewValues[$index] = $item;
		}

		return $itemsWithNewValues;
	}

	/**
	 * @param array $items
	 * @return array
	 */
	protected function parseQuestionName(array $items) {
		$parsedQuestions = array();
		foreach ($items as $index => $item) {
			$item['name'] = $this->getContentObjectRenderer()->parseFunc($item['name'], $GLOBALS['TSFE']->tmpl->setup['lib.']['parseFunc_tagged.']);
			$parsedQuestions[$index] = $item;
		}
		return $parsedQuestions;
	}

	/**
	 * @param array $items
	 * @return array
	 */
	protected function revertOrderOfItems(array $items){
		return array_reverse($items);
	}

	/**
	 * @return \TYPO3\CMS\Frontend\ContentObject\ContentObjectRenderer
	 */
	protected function getContentObjectRenderer() {
		return GeneralUtility::makeInstance('TYPO3\\CMS\\Frontend\\ContentObject\\ContentObjectRenderer');
	}

}