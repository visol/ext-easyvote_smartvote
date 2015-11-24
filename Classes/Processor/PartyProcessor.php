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
use TYPO3\CMS\Extbase\Persistence\QueryResultInterface;

/**
 * Processor Interface
 */
class PartyProcessor extends AbstractProcessor
{

    /**
     * @param $parties QueryResultInterface
     * @return array
     */
    public function process(QueryResultInterface $parties)
    {
        $items = array();
        $i = 0;
        foreach ($parties as $party) {
            /** @var $party \Visol\Easyvote\Domain\Model\Party */
            $items[$i]['id'] = $party->getUid();
            $items[$i]['title'] = $party->getTitle();
            $items[$i]['easyvoteSupporter'] = $party->isEasyvoteSupporter();

            if (!is_null($party->getImage())) {
                if ($party->getLocalizedUid() > 0) {
                    // We are in a localized model, so we must pass the localized UID because the FileRepository works this way
                    $items[$i]['imageUri'] = $this->getImages($party->getLocalizedUid(), 'tx_easyvote_domain_model_party', 'image', 1, array('width' => '250', 'height' => '250c'));
                } else {
                    $items[$i]['imageUri'] = $this->getImages($party->getUid(), 'tx_easyvote_domain_model_party', 'image', 1, array('width' => '250', 'height' => '250c'));
                }
            } else {
                $items[$i]['imageUri'] = NULL;
            }
            $items[$i]['ch2055'] = $this->parseRteContent($party->getCh2055());
            $items[$i]['numberOfCandidates'] = $party->getCandidates()->count();
            if (!empty($party->getVideoUrl())) {
                $items[$i]['videoUrl'] = $this->getMediaWizardProvider()->rewriteUrl($party->getVideoUrl());
            } else {
                $items[$i]['videoUrl'] = NULL;
            }
            $items[$i]['website'] = $party->getWebsite();
            $items[$i]['facebookProfile'] = $party->getFacebookProfile();
            $items[$i]['linkToTwitter'] = $party->getLinkToTwitter();
            $items[$i]['email'] = $party->getEmail();

            $items[$i]['candidatesImages'] = $this->getRandomCandidatesImages($party->getCandidates()->toArray(), 20);

            $calculations = $this->processCandidatesCalculations($party->getCandidates());
            $items[$i]['candidatesBelowAge35'] = $calculations['candidatesBelowAge35'];
            $items[$i]['averageAge'] = $calculations['averageAge'];
            $items[$i]['sexDistributionFemale'] = $calculations['sexDistributionFemale'];
            $items[$i]['sexDistributionMale'] = $calculations['sexDistributionMale'];

            $items[$i]['incumbentPoliticiansContent'] = $this->parseRteContent($party->getIncumbentPoliticiansContent());
            if ($party->getIncumbentPoliticiansImages()->count()) {
                $items[$i]['incumbentPoliticiansImages'] = $this->getImages($party->getUid(), 'tx_easyvote_domain_model_party', 'incumbent_politicians_images', 20, array('width' => '120', 'height' => '120c'));
            } else {
                $items[$i]['incumbentPoliticiansImages'] = NULL;
            }

            $items[$i]['positionRetirementProvision'] = $party->getPositionRetirementProvision();
            $items[$i]['positionEuropeanUnion'] = $party->getPositionEuropeanUnion();
            $items[$i]['positionMigration'] = $party->getPositionMigration();
            $items[$i]['positionEnergy'] = $party->getPositionEnergy();

            $i++;
        }
        return $items;
    }

    /**
     * Process some calculations about the candidates
     *
     * @param $candidates
     * @return array
     */
    protected function processCandidatesCalculations($candidates)
    {
        $currentYear = (int)date('Y');
        $ageSum = 0;
        $sexFemaleCount = 0;
        $counter = 0;
        $candidatesWithAge = 0;
        $calculations = array(
            'candidatesBelowAge35' => 0,
            'averageAge' => 0,
            'sexDistributionFemale' => 0,
            'sexDistributionMale' => 0
        );
        if (!count($candidates)) {
            /* Early return if there are no candidates */
            return $calculations;
        }
        foreach ($candidates as $candidate) {
            /** @var $candidate \Visol\EasyvoteSmartvote\Domain\Model\Candidate */
            $counter++;
            if (!empty($candidate->getYearOfBirth())) {
                $candidatesWithAge++;
                $candidateAge = $currentYear - (int)$candidate->getYearOfBirth();
                if ($candidateAge < 35) {
                    $calculations['candidatesBelowAge35']++;
                }
                $ageSum = $ageSum + $candidateAge;
            }
            if ($candidate->getGender() === 'f') {
                $sexFemaleCount++;
            }

        }
        $calculations['averageAge'] = round($ageSum / $candidatesWithAge, 1);
        $calculations['sexDistributionFemale'] = (float)round(($sexFemaleCount / $counter) * 100, 1);
        $calculations['sexDistributionMale'] = 100 - $calculations['sexDistributionFemale'];
        return $calculations;
    }

    /**
     * Returns a number of random image URIs from the candidates of a party
     *
     * @param $candidatesArray
     * @param $numberOfImages
     * @return array|null
     */
    protected function getRandomCandidatesImages($candidatesArray, $numberOfImages)
    {
        if (count($candidatesArray)) {
            $candidateImages = array();
            $candidatesKeys = array_rand($candidatesArray, count($candidatesArray));
            $imagesCounter = 0;
            foreach ($candidatesKeys as $index) {
                if ($imagesCounter === $numberOfImages) {
                    // Break as soon as we have enough images
                    break;
                }
                $candidateUid = $candidatesArray[$index]->getUid();
                $candidateImage = $this->getImages($candidateUid, 'tx_easyvotesmartvote_domain_model_candidate', 'photo', 1, array('width' => '120', 'height' => '120c'));
                if (!empty($candidateImage)) {
                    $candidateImages[] = $candidateImage;
                    $imagesCounter++;
                }
            }
            return $candidateImages;
        } else {
            return NULL;
        }
    }

    /**
     * Parse RTE content
     *
     * @param $content
     * @return string
     */
    protected function parseRteContent($content)
    {
        return $this->getContentObjectRenderer()->parseFunc($content, array(), '< lib.parseFunc_RTE');
    }

    /**
     * @return \Visol\Easyvote\Service\MediaWizardProvider
     */
    protected function getMediaWizardProvider()
    {
        return GeneralUtility::makeInstance('Visol\\Easyvote\\Service\\MediaWizardProvider');
    }

    /**
     * @return \TYPO3\CMS\Frontend\ContentObject\ContentObjectRenderer
     */
    protected function getContentObjectRenderer()
    {
        return GeneralUtility::makeInstance('TYPO3\\CMS\\Frontend\\ContentObject\\ContentObjectRenderer');
    }

}