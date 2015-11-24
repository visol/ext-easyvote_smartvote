<?php
namespace Visol\EasyvoteSmartvote\Domain\Model;

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

use TYPO3\CMS\Extbase\DomainObject\AbstractEntity;

/**
 * ElectionList
 */
class ElectionList extends AbstractEntity
{

    /**
     * name
     *
     * @var string
     */
    protected $name = '';

    /**
     * numberOfCandidates
     *
     * @var integer
     */
    protected $numberOfCandidates = 0;

    /**
     * numberOfAnswers
     *
     * @var integer
     */
    protected $numberOfAnswers = 0;

    /**
     * internalIdentifier
     *
     * @var string
     */
    protected $internalIdentifier = '';

    /**
     * linkToList
     *
     * @var string
     */
    protected $linkToList = '';

    /**
     * listNumber
     *
     * @var string
     */
    protected $listNumber = '';

    /**
     * election
     *
     * @var \Visol\EasyvoteSmartvote\Domain\Model\Election
     */
    protected $election = NULL;

    /**
     * district
     *
     * @var \Visol\EasyvoteSmartvote\Domain\Model\District
     */
    protected $district = NULL;

    /**
     * Returns the name
     *
     * @return string $name
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Sets the name
     *
     * @param string $name
     * @return void
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * Returns the numberOfCandidates
     *
     * @return integer $numberOfCandidates
     */
    public function getNumberOfCandidates()
    {
        return $this->numberOfCandidates;
    }

    /**
     * Sets the numberOfCandidates
     *
     * @param integer $numberOfCandidates
     * @return void
     */
    public function setNumberOfCandidates($numberOfCandidates)
    {
        $this->numberOfCandidates = $numberOfCandidates;
    }

    /**
     * Returns the numberOfAnswers
     *
     * @return integer $numberOfAnswers
     */
    public function getNumberOfAnswers()
    {
        return $this->numberOfAnswers;
    }

    /**
     * Sets the numberOfAnswers
     *
     * @param integer $numberOfAnswers
     * @return void
     */
    public function setNumberOfAnswers($numberOfAnswers)
    {
        $this->numberOfAnswers = $numberOfAnswers;
    }

    /**
     * Returns the internalIdentifier
     *
     * @return string $internalIdentifier
     */
    public function getInternalIdentifier()
    {
        return $this->internalIdentifier;
    }

    /**
     * Sets the internalIdentifier
     *
     * @param string $internalIdentifier
     * @return void
     */
    public function setInternalIdentifier($internalIdentifier)
    {
        $this->internalIdentifier = $internalIdentifier;
    }

    /**
     * Returns the linkToList
     *
     * @return string $linkToList
     */
    public function getLinkToList()
    {
        return $this->linkToList;
    }

    /**
     * Sets the linkToList
     *
     * @param string $linkToList
     * @return void
     */
    public function setLinkToList($linkToList)
    {
        $this->linkToList = $linkToList;
    }

    /**
     * Returns the listNumber
     *
     * @return string $listNumber
     */
    public function getListNumber()
    {
        return $this->listNumber;
    }

    /**
     * Sets the listNumber
     *
     * @param string $listNumber
     * @return void
     */
    public function setListNumber($listNumber)
    {
        $this->listNumber = $listNumber;
    }

    /**
     * Returns the election
     *
     * @return \Visol\EasyvoteSmartvote\Domain\Model\Election $election
     */
    public function getElection()
    {
        return $this->election;
    }

    /**
     * Sets the election
     *
     * @param \Visol\EasyvoteSmartvote\Domain\Model\Election $election
     * @return void
     */
    public function setElection(\Visol\EasyvoteSmartvote\Domain\Model\Election $election)
    {
        $this->election = $election;
    }

    /**
     * Returns the district
     *
     * @return \Visol\EasyvoteSmartvote\Domain\Model\District $district
     */
    public function getDistrict()
    {
        return $this->district;
    }

    /**
     * Sets the district
     *
     * @param \Visol\EasyvoteSmartvote\Domain\Model\District $district
     * @return void
     */
    public function setDistrict(\Visol\EasyvoteSmartvote\Domain\Model\District $district)
    {
        $this->district = $district;
    }

}