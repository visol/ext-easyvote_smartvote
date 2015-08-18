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
class PartyProcessor extends AbstractProcessor {

	/**
	 * @param $items
	 * @return array
	 */
	public function process(array $items) {
		$items = $this->convertKeysToCamelCase($items);
		$items = $this->enrichWithPhoto($items);
		$items = $this->convertToInteger($items);
		$items = $this->convertUidToId($items);
		return $items;
	}

	/**
	 * @param array $items
	 * @return array
	 */
	protected function enrichWithPhoto(array $items) {
		$itemsWithPhoto = array();
		foreach ($items as $index => $item) {
			$photos = $this->getFileRepository()->findByRelation('tx_easyvote_domain_model_party', 'image', $item['uid']);
			if (count($photos)) {
				/** @var \TYPO3\CMS\Core\Resource\FileReference $photo */
				// We need the first file reference (there is only supposed to be one photo)
				$photo = $photos[0];
				$photoPublicUrl = '/' . $photo->getOriginalFile()->getPublicUrl();
				if (!empty($photoPublicUrl)) {
					$item['image'] = $photoPublicUrl;
				}

			} else {
				$item['image'] = NULL;
			}

			$itemsWithPhoto[$index] = $item;
		}
		return $itemsWithPhoto;
	}

	/**
	 * @param array $items
	 * @return array
	 */
	protected function convertToInteger(array $items) {
		$convertedItems = array();
		foreach ($items as $item) {
			$item['uid'] = (int)$item['uid'];
			$convertedItems[] = $item;
		}
		return $convertedItems;
	}

	/**
	 * @return \TYPO3\CMS\Core\Resource\FileRepository
	 */
	protected function getFileRepository() {
		return GeneralUtility::makeInstance('TYPO3\\CMS\\Core\\Resource\\FileRepository');
	}

}