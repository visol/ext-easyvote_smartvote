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
use Visol\EasyvoteSmartvote\Domain\Model\Election;
use Visol\EasyvoteSmartvote\Processor\CandidateProcessor;

/**
 * Question Controller
 */
class CandidateApiController extends AbstractBaseApiController {

	/**
	 * @var \Visol\EasyvoteSmartvote\Domain\Repository\CandidateRepository
	 * @inject
	 */
	protected $candidateRepository;

	/**
	 * @var \TYPO3\CMS\Core\Cache\Frontend\AbstractFrontend
	 */
	protected $cacheInstance;

	/**
	 * @param Election $election
	 * @return string
	 */
	public function listAction(Election $election = NULL) {
		$this->initializeCache();

		$cacheIdentifier = 'candidates';
		$candidates = $this->cacheInstance->get($cacheIdentifier);

		if (!$candidates) {
			$candidates = $this->candidateRepository->findByElection($election);
			$candidates = $this->getCandidateProcessor()->process($candidates);
			$candidates = json_encode($candidates);

			$tags = array();
			$lifetime = $this->getLifeTime();
			$this->cacheInstance->set($cacheIdentifier, $candidates, $tags, $lifetime);
		}

		$this->response->setHeader('Content-Type', 'application/json');
		return $candidates;
	}

	/**
	 * @return CandidateProcessor
	 */
	public function getCandidateProcessor() {
		return $this->objectManager->get(CandidateProcessor::class);
	}

	/**
	 * Reset cache every 0, 30 minutes.
	 *
	 * @return int
	 */
	protected function getLifeTime() {
		return 86400;
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