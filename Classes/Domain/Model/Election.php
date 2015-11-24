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
 * Election
 */
class Election extends AbstractEntity
{

    /**
     * @var string
     * @validate NotEmpty
     */
    protected $title = '';

    /**
     * @var string
     */
    protected $shortTitle = '';

    /**
     * @var int
     */
    protected $electionDate = 0;

    /**
     * @var string
     * @validate NotEmpty
     */
    protected $smartVoteIdentifier = '';

    /**
     * @var string
     */
    protected $importLog = 'wer';

    /**
     * @var int
     */
    protected $totalCleavage1 = 0;

    /**
     * @var int
     */
    protected $totalCleavage2 = 0;

    /**
     * @var int
     */
    protected $totalCleavage3 = 0;

    /**
     * @var int
     */
    protected $totalCleavage4 = '';

    /**
     * @var int
     */
    protected $totalCleavage5 = '';

    /**
     * @var int
     */
    protected $totalCleavage6 = '';

    /**
     * @var int
     */
    protected $totalCleavage7 = '';

    /**
     * @var int
     */
    protected $totalCleavage8 = '';

    /**
     * @var int
     */
    protected $totalCleavageShort1 = 0;

    /**
     * @var int
     */
    protected $totalCleavageShort2 = 0;

    /**
     * @var int
     */
    protected $totalCleavageShort3 = 0;

    /**
     * @var int
     */
    protected $totalCleavageShort4 = '';

    /**
     * @var int
     */
    protected $totalCleavageShort5 = '';

    /**
     * @var int
     */
    protected $totalCleavageShort6 = '';

    /**
     * @var int
     */
    protected $totalCleavageShort7 = '';

    /**
     * @var int
     */
    protected $totalCleavageShort8 = '';

    /**
     * @var \Visol\EasyvoteSmartvote\Domain\Model\Election
     */
    protected $relatedElection;

    /**
     * @return string $smartVoteIdentifier
     */
    public function getSmartVoteIdentifier()
    {
        return $this->smartVoteIdentifier;
    }

    /**
     * @param string $smartVoteIdentifier
     * @return void
     */
    public function setSmartVoteIdentifier($smartVoteIdentifier)
    {
        $this->smartVoteIdentifier = $smartVoteIdentifier;
    }

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
     * @return string
     */
    public function getShortTitle()
    {
        return $this->shortTitle;
    }

    /**
     * @param string $shortTitle
     * @return $this
     */
    public function setShortTitle($shortTitle)
    {
        $this->shortTitle = $shortTitle;
        return $this;
    }

    /**
     * @return int
     */
    public function getElectionDate()
    {
        return $this->electionDate;
    }

    /**
     * @param int $electionDate
     * @return $this
     */
    public function setElectionDate($electionDate)
    {
        $this->electionDate = $electionDate;
        return $this;
    }

    /**
     * @return string
     */
    public function getImportLog()
    {
        return $this->importLog;
    }

    /**
     * @param string $importLog
     * @return $this
     */
    public function setImportLog($importLog)
    {
        $this->importLog = $importLog;
        return $this;
    }

    /**
     * @return int
     */
    public function getTotalCleavage1()
    {
        return $this->totalCleavage1;
    }

    /**
     * @param int $totalCleavage1
     * @return $this
     */
    public function setTotalCleavage1($totalCleavage1)
    {
        $this->totalCleavage1 = $totalCleavage1;
        return $this;
    }

    /**
     * @return int
     */
    public function getTotalCleavage2()
    {
        return $this->totalCleavage2;
    }

    /**
     * @param int $totalCleavage2
     * @return $this
     */
    public function setTotalCleavage2($totalCleavage2)
    {
        $this->totalCleavage2 = $totalCleavage2;
        return $this;
    }

    /**
     * @return int
     */
    public function getTotalCleavage3()
    {
        return $this->totalCleavage3;
    }

    /**
     * @param int $totalCleavage3
     * @return $this
     */
    public function setTotalCleavage3($totalCleavage3)
    {
        $this->totalCleavage3 = $totalCleavage3;
        return $this;
    }

    /**
     * @return int
     */
    public function getTotalCleavage4()
    {
        return $this->totalCleavage4;
    }

    /**
     * @param int $totalCleavage4
     * @return $this
     */
    public function setTotalCleavage4($totalCleavage4)
    {
        $this->totalCleavage4 = $totalCleavage4;
        return $this;
    }

    /**
     * @return int
     */
    public function getTotalCleavage5()
    {
        return $this->totalCleavage5;
    }

    /**
     * @param int $totalCleavage5
     * @return $this
     */
    public function setTotalCleavage5($totalCleavage5)
    {
        $this->totalCleavage5 = $totalCleavage5;
        return $this;
    }

    /**
     * @return int
     */
    public function getTotalCleavage6()
    {
        return $this->totalCleavage6;
    }

    /**
     * @param int $totalCleavage6
     * @return $this
     */
    public function setTotalCleavage6($totalCleavage6)
    {
        $this->totalCleavage6 = $totalCleavage6;
        return $this;
    }

    /**
     * @return int
     */
    public function getTotalCleavage7()
    {
        return $this->totalCleavage7;
    }

    /**
     * @param int $totalCleavage7
     * @return $this
     */
    public function setTotalCleavage7($totalCleavage7)
    {
        $this->totalCleavage7 = $totalCleavage7;
        return $this;
    }

    /**
     * @return int
     */
    public function getTotalCleavage8()
    {
        return $this->totalCleavage8;
    }

    /**
     * @param int $totalCleavage8
     * @return $this
     */
    public function setTotalCleavage8($totalCleavage8)
    {
        $this->totalCleavage8 = $totalCleavage8;
        return $this;
    }

    /**
     * @return Election
     */
    public function getRelatedElection()
    {
        return $this->relatedElection;
    }

    /**
     * @param Election $relatedElection
     * @return $this
     */
    public function setRelatedElection($relatedElection)
    {
        $this->relatedElection = $relatedElection;
        return $this;
    }

    /**
     * @return int
     */
    public function getTotalCleavageShort1()
    {
        return $this->totalCleavageShort1;
    }

    /**
     * @param int $totalCleavageShort1
     * @return $this
     */
    public function setTotalCleavageShort1($totalCleavageShort1)
    {
        $this->totalCleavageShort1 = $totalCleavageShort1;
        return $this;
    }

    /**
     * @return int
     */
    public function getTotalCleavageShort2()
    {
        return $this->totalCleavageShort2;
    }

    /**
     * @param int $totalCleavageShort2
     * @return $this
     */
    public function setTotalCleavageShort2($totalCleavageShort2)
    {
        $this->totalCleavageShort2 = $totalCleavageShort2;
        return $this;
    }

    /**
     * @return int
     */
    public function getTotalCleavageShort3()
    {
        return $this->totalCleavageShort3;
    }

    /**
     * @param int $totalCleavageShort3
     * @return $this
     */
    public function setTotalCleavageShort3($totalCleavageShort3)
    {
        $this->totalCleavageShort3 = $totalCleavageShort3;
        return $this;
    }

    /**
     * @return int
     */
    public function getTotalCleavageShort4()
    {
        return $this->totalCleavageShort4;
    }

    /**
     * @param int $totalCleavageShort4
     * @return $this
     */
    public function setTotalCleavageShort4($totalCleavageShort4)
    {
        $this->totalCleavageShort4 = $totalCleavageShort4;
        return $this;
    }

    /**
     * @return int
     */
    public function getTotalCleavageShort5()
    {
        return $this->totalCleavageShort5;
    }

    /**
     * @param int $totalCleavageShort5
     * @return $this
     */
    public function setTotalCleavageShort5($totalCleavageShort5)
    {
        $this->totalCleavageShort5 = $totalCleavageShort5;
        return $this;
    }

    /**
     * @return int
     */
    public function getTotalCleavageShort6()
    {
        return $this->totalCleavageShort6;
    }

    /**
     * @param int $totalCleavageShort6
     * @return $this
     */
    public function setTotalCleavageShort6($totalCleavageShort6)
    {
        $this->totalCleavageShort6 = $totalCleavageShort6;
        return $this;
    }

    /**
     * @return int
     */
    public function getTotalCleavageShort7()
    {
        return $this->totalCleavageShort7;
    }

    /**
     * @param int $totalCleavageShort7
     * @return $this
     */
    public function setTotalCleavageShort7($totalCleavageShort7)
    {
        $this->totalCleavageShort7 = $totalCleavageShort7;
        return $this;
    }

    /**
     * @return int
     */
    public function getTotalCleavageShort8()
    {
        return $this->totalCleavageShort8;
    }

    /**
     * @param int $totalCleavageShort8
     * @return $this
     */
    public function setTotalCleavageShort8($totalCleavageShort8)
    {
        $this->totalCleavageShort8 = $totalCleavageShort8;
        return $this;
    }

}