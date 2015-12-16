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
 * Party
 */
class Party extends AbstractEntity
{

    /**
     * @var string
     */
    protected $title = '';

    /**
     * @var string
     */
    protected $internalIdentifier = '';

    /**
     * @var string
     */
    protected $titleShort = '';

    /**
     * @var string
     */
    protected $logo = '';

    /**
     * @var integer
     */
    protected $numberOfCandidates = 0;

    /**
     * @var integer
     */
    protected $numberOfAnswers = 0;

    /**
     * @var string
     */
    protected $facebookProfile = '';

    /**
     * @var string
     */
    protected $website = '';

    /**
     * @var integer
     */
    protected $districts = 0;

    /**
     * @var integer
     */
    protected $electionLists = 0;

    /**
     * @var integer
     */
    protected $answers = 0;

    /**
     * @var string
     */
    protected $serializedDistricts = '';

    /**
     * @var string
     */
    protected $serializedElectionLists = '';

    /**
     * @var string
     */
    protected $serializedAnswers = '';

    /**
     * @var \Visol\EasyvoteSmartvote\Domain\Model\Election
     */
    protected $election = NULL;

    /**
     * @var \Visol\Easyvote\Domain\Model\Party
     */
    protected $nationalParty = NULL;

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param string $title
     * @return $this
     */
    public function setTitle($title)
    {
        $this->title = $title;
        return $this;
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
     * Returns the titleShort
     *
     * @return string $titleShort
     */
    public function getTitleShort()
    {
        return $this->titleShort;
    }

    /**
     * Sets the titleShort
     *
     * @param string $titleShort
     * @return void
     */
    public function setTitleShort($titleShort)
    {
        $this->titleShort = $titleShort;
    }

    /**
     * Returns the logo
     *
     * @return string $logo
     */
    public function getLogo()
    {
        return $this->logo;
    }

    /**
     * Sets the logo
     *
     * @param string $logo
     * @return void
     */
    public function setLogo($logo)
    {
        $this->logo = $logo;
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
     * Returns the facebookProfile
     *
     * @return string $facebookProfile
     */
    public function getFacebookProfile()
    {
        return $this->facebookProfile;
    }

    /**
     * Sets the facebookProfile
     *
     * @param string $facebookProfile
     * @return void
     */
    public function setFacebookProfile($facebookProfile)
    {
        $this->facebookProfile = $facebookProfile;
    }

    /**
     * Returns the website
     *
     * @return string $website
     */
    public function getWebsite()
    {
        return $this->website;
    }

    /**
     * Sets the website
     *
     * @param string $website
     * @return void
     */
    public function setWebsite($website)
    {
        $this->website = $website;
    }

    /**
     * Returns the districts
     *
     * @return integer $districts
     */
    public function getDistricts()
    {
        return $this->districts;
    }

    /**
     * Sets the districts
     *
     * @param integer $districts
     * @return void
     */
    public function setDistricts($districts)
    {
        $this->districts = $districts;
    }

    /**
     * Returns the electionLists
     *
     * @return integer $electionLists
     */
    public function getElectionLists()
    {
        return $this->electionLists;
    }

    /**
     * Sets the electionLists
     *
     * @param integer $electionLists
     * @return void
     */
    public function setElectionLists($electionLists)
    {
        $this->electionLists = $electionLists;
    }

    /**
     * Returns the answers
     *
     * @return integer $answers
     */
    public function getAnswers()
    {
        return $this->answers;
    }

    /**
     * Sets the answers
     *
     * @param integer $answers
     * @return void
     */
    public function setAnswers($answers)
    {
        $this->answers = $answers;
    }

    /**
     * Returns the serializedDistricts
     *
     * @return string $serializedDistricts
     */
    public function getSerializedDistricts()
    {
        return $this->serializedDistricts;
    }

    /**
     * Sets the serializedDistricts
     *
     * @param string $serializedDistricts
     * @return void
     */
    public function setSerializedDistricts($serializedDistricts)
    {
        $this->serializedDistricts = $serializedDistricts;
    }

    /**
     * Returns the serializedElectionLists
     *
     * @return string $serializedElectionLists
     */
    public function getSerializedElectionLists()
    {
        return $this->serializedElectionLists;
    }

    /**
     * Sets the serializedElectionLists
     *
     * @param string $serializedElectionLists
     * @return void
     */
    public function setSerializedElectionLists($serializedElectionLists)
    {
        $this->serializedElectionLists = $serializedElectionLists;
    }

    /**
     * Returns the serializedAnswers
     *
     * @return string $serializedAnswers
     */
    public function getSerializedAnswers()
    {
        return $this->serializedAnswers;
    }

    /**
     * Sets the serializedAnswers
     *
     * @param string $serializedAnswers
     * @return void
     */
    public function setSerializedAnswers($serializedAnswers)
    {
        $this->serializedAnswers = $serializedAnswers;
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
     * @return \Visol\Easyvote\Domain\Model\Party
     */
    public function getNationalParty()
    {
        return $this->nationalParty;
    }

    /**
     * @param \Visol\Easyvote\Domain\Model\Party $nationalParty
     */
    public function setNationalParty($nationalParty)
    {
        $this->nationalParty = $nationalParty;
    }

}