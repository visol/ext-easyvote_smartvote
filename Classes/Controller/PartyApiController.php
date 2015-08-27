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

use Visol\EasyvoteSmartvote\Domain\Model\Election;
use Visol\EasyvoteSmartvote\Processor\PartyProcessor;

/**
 * Party Api Controller
 */
class PartyApiController extends AbstractBaseApiController {

	/**
	 * @var \Visol\Easyvote\Domain\Repository\PartyRepository
	 * @inject
	 */
	protected $partyRepository;

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

		$cacheIdentifier = 'parties-' . $election->getUid();
		// todo enable cache
		$parties = NULL;
		//$parties = $this->cacheInstance->get($cacheIdentifier);

		if (!$parties) {
			$parties = $this->partyRepository->findAllWithoutOthers();
			$parties = $this->getPartyProcessor()->process($parties);
			$parties = json_encode($parties);

			$tags = array();
			$lifetime = $this->getLifeTime();
			$this->cacheInstance->set($cacheIdentifier, $parties, $tags, $lifetime);
		}

		$this->response->setHeader('Content-Type', 'application/json');
		return $parties;
	}

	/**
	 * @return PartyProcessor
	 */
	public function getPartyProcessor() {
		return $this->objectManager->get(PartyProcessor::class);
	}

}