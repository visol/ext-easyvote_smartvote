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

/**
 * Service for retrieving a token.
 */
class TokenService implements SingletonInterface {

	/**
	 * Return a storage token.
	 *
	 * @param int $currentElectionUid
	 * @return int
	 */
	public function generate($currentElectionUid) {


		$token = sprintf(
			'ext-easyvote-smart-%s-%s%s',
			$currentElectionUid,
			$this->getElectionCacheTimeStamp($currentElectionUid),
			$this->getUserService()->isAuthenticated() ?
				'-' . $this->getUserService()->getUserData()['uid'] :
				''
		);

		// Offend the token.
		$token = md5($token);

		// Bind the token to the user and persist that in the User preferences.
		if ($this->getUserService()->isAuthenticated() && !$this->containsData($token)) {
			$this->getUserService()->set($token, array());
		}
		return $token;
	}

	/**
	 * Tell whether the token is allowed for this User.
	 *
	 * @param string $token
	 * @return true
	 */
	public function isAllowed($token) {
		return (bool)$this->getUserService()->get($token);
	}

	/**
	 * Tell whether the token contains data in the User preference.
	 *
	 * @param string $token
	 * @return true
	 */
	public function containsData($token) {
		$data = $this->getUserService()->get($token);
		return is_array($data);
	}

	/**
	 * @param int $currentElectionUid
	 * @return int
	 */
	protected function getElectionCacheTimeStamp($currentElectionUid){
		$cachePath = PATH_site . 'typo3temp/Cache/Data/easyvote_smartvote';

		// Make direction if it does not exist.
		if (!is_dir($cachePath)) {
			mkdir($cachePath, 0777, TRUE);
		}
		$cacheFileAndPath = $cachePath . '/election-' . $currentElectionUid;
		if (!is_file($cacheFileAndPath)) {
			touch($cacheFileAndPath);
		}

		return filemtime($cacheFileAndPath);
	}

	/**
	 * @return UserService
	 */
	protected function getUserService(){
		return GeneralUtility::makeInstance(UserService::class);
	}

}
