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
 * PersonalElectionList
 */
class PersonalElectionList extends AbstractEntity
{

    /**
     * @var \Visol\Easyvote\Domain\Model\CommunityUser
     */
    protected $communityUser;

    /**
     * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Visol\EasyvoteSmartvote\Domain\Model\Candidate>
     */
    protected $candidates;

    /**
     * @var \Visol\EasyvoteSmartvote\Domain\Model\Election
     */
    protected $election;

    /**
     * @var \Visol\EasyvoteSmartvote\Domain\Model\ElectionList
     */
    protected $electionList;

}