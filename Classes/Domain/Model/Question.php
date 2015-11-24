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
 * Question
 */
class Question extends AbstractEntity
{

    /**
     * name
     *
     * @var string
     */
    protected $name = '';

    /**
     * internalIdentifier
     *
     * @var string
     */
    protected $internalIdentifier = '';

    /**
     * groupping
     *
     * @var int
     */
    protected $groupping = 0;

    /**
     * type
     *
     * @var string
     */
    protected $type = '';

    /**
     * rapide
     *
     * @var boolean
     */
    protected $rapide = FALSE;

    /**
     * education
     *
     * @var boolean
     */
    protected $education = FALSE;

    /**
     * @var int
     */
    protected $cleavage1 = 0;

    /**
     * @var int
     */
    protected $cleavage2 = 0;

    /**
     * @var int
     */
    protected $cleavage3 = 0;

    /**
     * @var int
     */
    protected $cleavage4 = '';

    /**
     * @var int
     */
    protected $cleavage5 = '';

    /**
     * @var int
     */
    protected $cleavage6 = '';

    /**
     * @var int
     */
    protected $cleavage7 = '';

    /**
     * @var int
     */
    protected $cleavage8 = '';

    /**
     * info
     *
     * @var string
     */
    protected $info = '';

    /**
     * pro
     *
     * @var string
     */
    protected $pro = '';

    /**
     * contra
     *
     * @var string
     */
    protected $contra = '';

    /**
     * election
     *
     * @var \Visol\EasyvoteSmartvote\Domain\Model\Election
     */
    protected $election = NULL;

    /**
     * category
     *
     * @var \Visol\EasyvoteSmartvote\Domain\Model\QuestionCategory
     */
    protected $category = NULL;

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
     * Returns the groupping
     *
     * @return int $groupping
     */
    public function getGroupping()
    {
        return $this->groupping;
    }

    /**
     * Sets the groupping
     *
     * @param int $groupping
     * @return void
     */
    public function setGroupping($groupping)
    {
        $this->groupping = $groupping;
    }

    /**
     * Returns the type
     *
     * @return string $type
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Sets the type
     *
     * @param string $type
     * @return void
     */
    public function setType($type)
    {
        $this->type = $type;
    }

    /**
     * Returns the rapide
     *
     * @return boolean $rapide
     */
    public function getRapide()
    {
        return $this->rapide;
    }

    /**
     * Sets the rapide
     *
     * @param boolean $rapide
     * @return void
     */
    public function setRapide($rapide)
    {
        $this->rapide = $rapide;
    }

    /**
     * Returns the boolean state of rapide
     *
     * @return boolean
     */
    public function isRapide()
    {
        return $this->rapide;
    }

    /**
     * Returns the education
     *
     * @return boolean $education
     */
    public function getEducation()
    {
        return $this->education;
    }

    /**
     * Sets the education
     *
     * @param boolean $education
     * @return void
     */
    public function setEducation($education)
    {
        $this->education = $education;
    }

    /**
     * Returns the boolean state of education
     *
     * @return boolean
     */
    public function isEducation()
    {
        return $this->education;
    }

    /**
     * @return int $cleavage1
     */
    public function getCleavage1()
    {
        return $this->cleavage1;
    }

    /**
     * @param int $cleavage1
     * @return void
     */
    public function setCleavage1($cleavage1)
    {
        $this->cleavage1 = $cleavage1;
    }

    /**
     * @return int $cleavage2
     */
    public function getCleavage2()
    {
        return $this->cleavage2;
    }

    /**
     * @param int $cleavage2
     * @return void
     */
    public function setCleavage2($cleavage2)
    {
        $this->cleavage2 = $cleavage2;
    }

    /**
     * @return int $cleavage3
     */
    public function getCleavage3()
    {
        return $this->cleavage3;
    }

    /**
     * @param int $cleavage3
     * @return void
     */
    public function setCleavage3($cleavage3)
    {
        $this->cleavage3 = $cleavage3;
    }

    /**
     * Returns the cleavage4
     *
     * @return int $cleavage4
     */
    public function getCleavage4()
    {
        return $this->cleavage4;
    }

    /**
     * Sets the cleavage4
     *
     * @param int $cleavage4
     * @return void
     */
    public function setCleavage4($cleavage4)
    {
        $this->cleavage4 = $cleavage4;
    }

    /**
     * @return int $cleavage5
     */
    public function getCleavage5()
    {
        return $this->cleavage5;
    }

    /**
     * @param int $cleavage5
     * @return void
     */
    public function setCleavage5($cleavage5)
    {
        $this->cleavage5 = $cleavage5;
    }

    /**
     * @return int $cleavage6
     */
    public function getCleavage6()
    {
        return $this->cleavage6;
    }

    /**
     * @param int $cleavage6
     * @return void
     */
    public function setCleavage6($cleavage6)
    {
        $this->cleavage6 = $cleavage6;
    }

    /**
     * @return int $cleavage7
     */
    public function getCleavage7()
    {
        return $this->cleavage7;
    }

    /**
     * @param int $cleavage7
     * @return void
     */
    public function setCleavage7($cleavage7)
    {
        $this->cleavage7 = $cleavage7;
    }

    /**
     * @return int $cleavage8
     */
    public function getCleavage8()
    {
        return $this->cleavage8;
    }

    /**
     * @param int $cleavage8
     * @return void
     */
    public function setCleavage8($cleavage8)
    {
        $this->cleavage8 = $cleavage8;
    }

    /**
     * Returns the info
     *
     * @return string $info
     */
    public function getInfo()
    {
        return $this->info;
    }

    /**
     * Sets the info
     *
     * @param string $info
     * @return void
     */
    public function setInfo($info)
    {
        $this->info = $info;
    }

    /**
     * Returns the pro
     *
     * @return string $pro
     */
    public function getPro()
    {
        return $this->pro;
    }

    /**
     * Sets the pro
     *
     * @param string $pro
     * @return void
     */
    public function setPro($pro)
    {
        $this->pro = $pro;
    }

    /**
     * Returns the contra
     *
     * @return string $contra
     */
    public function getContra()
    {
        return $this->contra;
    }

    /**
     * Sets the contra
     *
     * @param string $contra
     * @return void
     */
    public function setContra($contra)
    {
        $this->contra = $contra;
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
     * Returns the category
     *
     * @return \Visol\EasyvoteSmartvote\Domain\Model\QuestionCategory $category
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * Sets the category
     *
     * @param \Visol\EasyvoteSmartvote\Domain\Model\QuestionCategory $category
     * @return void
     */
    public function setCategory(\Visol\EasyvoteSmartvote\Domain\Model\QuestionCategory $category)
    {
        $this->category = $category;
    }

}