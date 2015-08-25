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
class CandidateProcessor extends AbstractProcessor {

	/**
	 * @param $items
	 * @return array
	 */
	public function process(array $items) {
		$items = $this->deserializeSomeValues($items);
		$items = $this->processListPlaces($items);
		$items = $this->convertKeysToCamelCase($items);
		$items = $this->convertToInteger($items);
		$items = $this->enrichWithPhoto($items);
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
			$item['yearOfBirth'] = (int)$item['yearOfBirth'];
			$item['incumbent'] = (int)$item['incumbent'];
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
			$spiderChartValues = json_decode($item['serialized_spider_values'], TRUE);
			$item['spiderChart'] = $spiderChartValues;
			unset($item['serialized_spider_values']);

			// Adding answers
			$answers = json_decode($item['serialized_answers'], TRUE);
			$item['answers'] = $answers;
			unset($item['serialized_answers']);

			$itemsWithNewValues[$index] = $item;
		}

		return $itemsWithNewValues;
	}

	/**
	 * @param array $items
	 * @return array
	 */
	protected function processListPlaces(array $items) {
		$itemsWithNewValues = array();
		foreach ($items as $index => $item) {

			// Adding SpiderChartValues
			$listPlaces = json_decode($item['serialized_list_places'], TRUE);
			$formattedListPlaces = array();
			foreach ($listPlaces as $listPlace) {
				if (array_key_exists('number', $listPlace) && !empty($listPlace['number'])) {
					$formattedListPlaces[] = $listPlace['number'];
				} elseif (array_key_exists('position', $listPlace) && !empty($listPlace['position'])) {
					$formattedListPlaces[] = $listPlace['position'];
				}
			}

			$item['listPlaces'] = implode(' | ', $formattedListPlaces);
			unset($item['serialized_list_places']);
			$itemsWithNewValues[$index] = $item;
		}

		return $itemsWithNewValues;
	}

	/**
	 * @param array $items
	 * @return array
	 */
	protected function enrichWithPhoto(array $items) {
		$itemsWithPhoto = array();
		foreach ($items as $index => $item) {
			$photos = $this->getFileRepository()->findByRelation('tx_easyvotesmartvote_domain_model_candidate', 'photo', $item['uid']);
			if (count($photos)) {
				/** @var \TYPO3\CMS\Core\Resource\FileReference $photo */
				// We need the first file reference (there is only supposed to be one photo)
				$photo = $photos[0];
				$photoPublicUrl = '/' . $photo->getOriginalFile()->getPublicUrl();
				if (!empty($photoPublicUrl)) {
					$item['photo'] = $photoPublicUrl;
				}

			} else {
				$item['photo'] = NULL;
			}
			unset($item['photoCachedRemoteFilesize']);
			unset($item['serializedPhotos']);

			$itemsWithPhoto[$index] = $item;
		}
		return $itemsWithPhoto;
	}

	/**
	 * @return \TYPO3\CMS\Core\Resource\FileRepository
	 */
	protected function getFileRepository() {
		return GeneralUtility::makeInstance('TYPO3\\CMS\\Core\\Resource\\FileRepository');
	}

}