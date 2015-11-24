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

/**
 * Service related to the User.
 */
class UserService implements SingletonInterface
{

    /**
     * @return bool
     */
    public function isAuthenticated()
    {
        return !empty($this->getFrontendUser()->user);
    }

    /**
     * Returns an instance of the current Frontend User.
     *
     * @return \TYPO3\CMS\Frontend\Authentication\FrontendUserAuthentication
     */
    protected function getFrontendUser()
    {
        return $GLOBALS['TSFE']->fe_user;
    }

    /**
     * @return array
     */
    public function getUserData()
    {
        $userData = $this->getFrontendUser()->user;
        return $this->isAuthenticated() ? $userData : array();
    }

    /**
     * Persist data at for the authenticated user.
     *
     * @param string $token
     * @param array $data
     * @return void
     */
    public function setCache($token, $data)
    {
        $cacheFileAndPath = $this->getUserCacheFileAndPath($token);
        file_put_contents($cacheFileAndPath, json_encode($data));
    }

    /**
     * Tell whether the cache exists for a User.
     *
     * @param string $token
     * @return mixed
     */
    public function hasCache($token)
    {
        return is_file($this->getUserCacheFileAndPath($token));
    }

    /**
     * Get cache data for the authenticated User.
     *
     * @param string $token
     * @return mixed
     */
    public function getCache($token)
    {
        $rawContent = file_get_contents($this->getUserCacheFileAndPath($token));
        return json_decode($rawContent, TRUE);
    }

    /**
     * Initialize the cache.
     *
     * @param string $token
     * @return void
     */
    public function initializeCache($token)
    {
        $cacheFileAndPath = $this->getUserCacheFileAndPath($token);
        if (!is_file($cacheFileAndPath)) {
            file_put_contents($cacheFileAndPath, json_encode(array()));
        }
    }

    /**
     * @param string $token
     * @return string
     */
    protected function getUserCacheFileAndPath($token)
    {
        $cachePath = PATH_site . 'uploads/tx_easyvotesmartvote';

        // Make sure directory exists otherwise create it.
        if (!is_dir($cachePath)) {
            mkdir($cachePath, 0777, TRUE);
        }

        $cacheFileAndPath = $cachePath . '/user-' . $this->getUserData()['uid'] . '-' . $token;
        return $cacheFileAndPath;
    }

}
