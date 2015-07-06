<?php
namespace Visol\EasyvoteSmartvote\Controller;

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

use TYPO3\CMS\Core\Cache\Cache;
use TYPO3\CMS\Core\Cache\Exception\NoSuchCacheException;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;
use TYPO3\CMS\Extbase\Mvc\RequestInterface;
use TYPO3\CMS\Extbase\Mvc\ResponseInterface;

/**
 * Base API Controller
 */
abstract class AbstractBaseApiController extends ActionController {

	/**
	 * @var string
	 */
	protected $defaultViewObjectName = 'TYPO3\CMS\Extbase\Mvc\View\JsonView';

	/**
	 * @var \TYPO3\CMS\Core\Cache\Frontend\AbstractFrontend
	 */
	protected $cacheInstance;

	/**
	 * @param RequestInterface $request
	 * @param ResponseInterface $response
	 * @throws \Exception
	 */
	public function processRequest(RequestInterface $request, ResponseInterface $response) {
		try {
			parent::processRequest($request, $response);
		} catch (\Exception $exception) {
		}
	}

	/**
	 * Reset cache every 0, 30 minutes.
	 *
	 * @return int
	 */
	protected function getLifeTime() {
		// 30 days 86400 * 30
		return 8640030;
	}

	/**
	 * Initialize cache instance to be ready to use
	 *
	 * @return void
	 */
	protected function initializeCache() {
		Cache::initializeCachingFramework();
		try {
			$this->cacheInstance = $this->getCacheManager()->getCache('easyvote_smartvote');
		} catch (NoSuchCacheException $e) {
			$this->cacheInstance = $this->getCacheFactory()->create(
				'easyvote_smartvote',
				$GLOBALS['TYPO3_CONF_VARS']['SYS']['caching']['cacheConfigurations']['easyvote_smartvote']['frontend'],
				$GLOBALS['TYPO3_CONF_VARS']['SYS']['caching']['cacheConfigurations']['easyvote_smartvote']['backend'],
				$GLOBALS['TYPO3_CONF_VARS']['SYS']['caching']['cacheConfigurations']['easyvote_smartvote']['options']
			);
		}
	}

	/**
	 * Return the Cache Manager
	 *
	 * @return \TYPO3\CMS\Core\Cache\CacheManager
	 */
	protected function getCacheManager() {
		return GeneralUtility::makeInstance('TYPO3\\CMS\\Core\\Cache\\CacheManager');
	}

	/**
	 * Return the Cache Factory
	 *
	 * @return \TYPO3\CMS\Core\Cache\CacheFactory
	 */
	protected function getCacheFactory() {
		return $GLOBALS['typo3CacheFactory'];
	}

}