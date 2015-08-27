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

use TYPO3\CMS\Core\Resource\ProcessedFile;
use TYPO3\CMS\Core\Utility\GeneralUtility;

/**
 * Abstract Processor
 */
abstract class AbstractProcessor {

	/**
	 * @param array $items
	 * @return array
	 */
	protected function convertKeysToCamelCase(array $items) {
		$convertedKeys = array_map(
			function ($item) {
				$convertedItem = array();
				foreach ($item as $key => $value) {
					$key = $this->underscoredToLowerCamelCase($key);
					$convertedItem[$key] = $value;
				}
				return $convertedItem;
			},
			$items
		);

		return $convertedKeys;
	}

	/**
	 * Returns a given string with underscores as lowerCamelCase.
	 * Example: Converts minimal_value to minimalValue
	 *
	 * @param string $string String to be converted to camel case
	 * @return string lowerCamelCasedWord
	 */
	public function underscoredToLowerCamelCase($string) {
		$upperCamelCase = str_replace(' ', '', ucwords(str_replace('_', ' ', $string)));
		$lowerCamelCase = lcfirst($upperCamelCase);
		return $lowerCamelCase;
	}

	/**
	 * @param array $items
	 * @return array
	 */
	protected function convertUidToId(array $items) {
		$convertedItems = array();
		foreach ($items as $item) {
			$item['id'] = $item['uid'];
			unset($item['uid']);
			$convertedItems[] = $item;
		}
		return $convertedItems;
	}

	/**
	 * Some values are only fetched because they are needed for getting a localization overlay.
	 * They can be removed for frontend usage.
	 *
	 * @param array $items
	 * @return array
	 */
	protected function removeUnneededLocalizationValues(array $items) {
		$convertedItems = array();
		foreach ($items as $item) {
			unset($item['sys_language_uid']);
			unset($item['pid']);
			unset($item['_LOCALIZED_UID']);
			$convertedItems[] = $item;
		}
		return $convertedItems;
	}

	/**
	 * @param integer $objectUid
	 * @param $tableName
	 * @param $fieldName
	 * @param int $limit
	 * @param array $processConfiguration
	 * @return string|array
	 */
	protected function getImages($objectUid, $tableName, $fieldName, $limit = 1, $processConfiguration = array()) {
		$photos = $this->getFileRepository()->findByRelation($tableName, $fieldName, $objectUid);
		if (count($photos)) {
			$images = array();
			$i = 1;
			foreach ($photos as $photo) {
				if ($i > $limit) { break; }
				/** @var \TYPO3\CMS\Core\Resource\FileReference $photo */
				if (!empty($processConfiguration)) {
					$photoPublicUrl = '/' . $photo->getOriginalFile()->process(ProcessedFile::CONTEXT_IMAGECROPSCALEMASK, $processConfiguration)->getPublicUrl();
				} else {
					$photoPublicUrl = '/' . $photo->getOriginalFile()->getPublicUrl();
				}
				if (!empty($photoPublicUrl)) {
					if ($limit === 1) {
						return $photoPublicUrl;
					} else {
						$images[] = $photoPublicUrl;
					}
				} else {
					if ($limit === 1) {
						return NULL;
					}
				}
				$i++;
			}
			return $images;
		} else {
			return NULL;
		}
	}

	/**
	 * @return \TYPO3\CMS\Core\Resource\FileRepository
	 */
	protected function getFileRepository() {
		return GeneralUtility::makeInstance('TYPO3\\CMS\\Core\\Resource\\FileRepository');
	}

}