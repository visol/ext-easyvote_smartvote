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

/**
 * Question Controller
 */
class QuestionApiController extends AbstractBaseApiController {

	/**
	 * @var \Visol\EasyvoteSmartvote\Domain\Repository\QuestionRepository
	 * @inject
	 */
	protected $questionRepository;

	/**
	 * @param Election $election
	 * @return string
	 */
	public function listAction(Election $election = NULL) {
		$this->initializeCache();

		$cacheIdentifier = 'questions';
		$questions = $this->cacheInstance->get($cacheIdentifier);

		if (!$questions) {

			$questions = $this->questionRepository->findByElection($election);
//			$questions = array(
//				'questions' => array(
//					array('uid' => 1, 'name' => 'asdf', 'position' => 1),
//					array('uid' => 2, 'name' => 'qwer', 'position' => 2),
//				)
//			);
//			$questions = array(
//				array('uid' => 1, 'name' => 'asdf', 'position' => 1),
//				array('uid' => 2, 'name' => 'qwer', 'position' => 2),
//			);
//			$locations = $this->locationRepository->findAllForMaps();
//			$questions = $this->getLocationEncoder()->encode($locations);

//			$tags = array();
//			$lifetime = $this->getLifeTime();
//			$this->cacheInstance->set($cacheIdentifier, $questions, $tags, $lifetime);
		}

		$this->response->setHeader('Content-Type', 'application/json');
		return json_encode($questions);
	}

}