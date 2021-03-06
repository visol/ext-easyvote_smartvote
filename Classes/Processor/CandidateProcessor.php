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
use TYPO3\CMS\Extbase\Utility\LocalizationUtility;

/**
 * Processor Interface
 */
class CandidateProcessor extends AbstractProcessor
{

    /**
     * @param $items
     * @return array
     */
    public function process(array $items)
    {
        $items = $this->deserializeSomeValues($items);
        $items = $this->processListPlaces($items);
        $items = $this->convertKeysToCamelCase($items);
        $items = $this->convertToInteger($items);
        $items = $this->enrichWithPhoto($items);
        $items = $this->resolvePersona($items);
        $items = $this->unsetUnneededValues($items);
        $items = $this->convertUidToId($items);
        return $items;
    }

    /**
     * @param array $items
     * @return array
     */
    protected function convertToInteger(array $items)
    {
        $convertedItems = array();
        foreach ($items as $item) {
            $item['uid'] = (int)$item['uid'];
            $item['yearOfBirth'] = (int)$item['yearOfBirth'];
            $item['incumbent'] = (int)$item['incumbent'];
            $item['elected'] = (int)$item['elected'];
            $item['deselected'] = (int)$item['deselected'];
            $convertedItems[] = $item;
        }
        return $convertedItems;
    }

    /**
     * @param array $items
     * @return array
     */
    protected function deserializeSomeValues(array $items)
    {
        $itemsWithNewValues = array();
        foreach ($items as $index => $item) {

            // Adding SpiderChartValues
            $spiderChartValues = json_decode($item['serialized_spider_values'], TRUE);
            $item['spiderChart'] = $spiderChartValues;
            unset($item['serialized_spider_values']);

            // Adding answers
            $answers = json_decode($item['serialized_answers_processed'], TRUE);
            $item['answers'] = $answers;
            unset($item['serialized_answers_processed']);

            $itemsWithNewValues[$index] = $item;
        }

        return $itemsWithNewValues;
    }

    /**
     * @param array $items
     * @return array
     */
    protected function processListPlaces(array $items)
    {
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
    protected function enrichWithPhoto(array $items)
    {
        $itemsWithPhoto = array();
        foreach ($items as $index => $item) {
            $item['photo'] = $this->getImages($item['uid'], 'tx_easyvotesmartvote_domain_model_candidate', 'photo', 1);
            unset($item['photoCachedRemoteFilesize']);
            unset($item['serializedPhotos']);
            $itemsWithPhoto[$index] = $item;
        }
        return $itemsWithPhoto;
    }

    /**
     * @param array $items
     * @return array
     */
    protected function resolvePersona(array $items)
    {
        $processedItems = array();
        foreach ($items as $index => $item) {
            if (!empty($item['persona'])) {
                $labelKey = 'candidate.persona.' . strtolower($item['persona']) . '.' . $item['gender'];
                $item['personaName'] = LocalizationUtility::translate($labelKey, 'easyvote_smartvote');
            }
            $processedItems[$index] = $item;
        }
        return $processedItems;
    }

    /**
     * @param array $items
     * @return array
     */
    protected function unsetUnneededValues(array $items)
    {
        $processedItems = array();
        foreach ($items as $index => $item) {
            // only fetched for language overlay
            if ($this->isNationalScope) {
                $item['party'] = $item['nationalParty'];
            } else {
                $item['party'] = $item['partyParent'];
            }
            unset($item['partyParent']);
            unset($item['nationalParty']);
            unset($item['education']);
            $processedItems[$index] = $item;
        }
        return $processedItems;
    }

    /**
     * @return \TYPO3\CMS\Core\Resource\FileRepository
     */
    protected function getFileRepository()
    {
        return GeneralUtility::makeInstance('TYPO3\\CMS\\Core\\Resource\\FileRepository');
    }

}