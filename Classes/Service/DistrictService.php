<?php
namespace Visol\EasyvoteSmartvote\Service;

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

use TYPO3\CMS\Core\SingletonInterface;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Object\ObjectManager;
use Visol\EasyvoteSmartvote\Domain\Model\Election;
use Visol\EasyvoteSmartvote\Domain\Repository\DistrictRepository;
use Visol\EasyvoteSmartvote\Service\UserService;

/**
 * Service related to Districts.
 */
class DistrictService implements SingletonInterface
{

    /**
     * @param Election $election
     * @return null
     */
    public function getUserDistrictForCurrentElection(Election $election)
    {
        if (!$this->getUserService()->isAuthenticated()) {
            return NULL;
        }
        $userData = $this->getUserService()->getUserData();
        if (array_key_exists('city_selection', $userData) && !empty($userData['city_selection'])) {
            return $this->getDistrictRepository()->findOneByElectionAndCityUid($election, $userData['city_selection']);
        } else {
            return NULL;
        }
    }

    /**
     * @return UserService
     */
    protected function getUserService()
    {
        return GeneralUtility::makeInstance(UserService::class);
    }

    /**
     * @return DistrictRepository
     */
    protected function getDistrictRepository()
    {
        return $this->getObjectManager()->get(DistrictRepository::class);
    }

    /**
     * @return \TYPO3\CMS\Extbase\Object\ObjectManager
     */
    protected function getObjectManager()
    {
        return GeneralUtility::makeInstance(ObjectManager::class);
    }

}
