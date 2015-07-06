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

use TYPO3\CMS\Core\Utility\GeneralUtility;
use Visol\EasyvoteSmartvote\Domain\Model\Election;
use Visol\EasyvoteSmartvote\Processor\QuestionProcessor;
use Visol\EasyvoteSmartvote\Service\TokenService;
use Visol\EasyvoteSmartvote\Service\UserService;

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

		$token = GeneralUtility::_GP('token');
		if ($this->isAuthenticatedUser($token)) {
			$questions = $this->getListForAuthenticatedUser($election, $token);
		} else {
			$questions = $this->getListForAnonymousUser($election);
		}

		$this->response->setHeader('Content-Type', 'application/json');
		return $questions;
	}

	/**
	 * @param Election $election
	 * @param string $token
	 * @return string
	 */
	public function getListForAuthenticatedUser(Election $election, $token) {
		$questions = $this->retrieveQuestionsFromUserPreferences($token);

		if (empty($questions)) {
			$questions = $this->questionRepository->findByElection($election);
			$questions = $this->getQuestionProcessor()->process($questions);

			if ($this->getUserService()->isAuthenticated()) {
				$this->getUserService()->set($token, $questions);
			}
		}

		return json_encode($questions);
	}

	/**
	 * @param Election $election
	 * @return string
	 */
	public function getListForAnonymousUser(Election $election) {

		$this->initializeCache();

		$cacheIdentifier = 'questions-' . $election->getUid();
		$questions = $this->cacheInstance->get($cacheIdentifier);

		if (empty($questions)) {
			$questions = $this->questionRepository->findByElection($election);
			$questions = $this->getQuestionProcessor()->process($questions);
			$questions = json_encode($questions);

			$tags = array();
			$lifetime = $this->getLifeTime();
			$this->cacheInstance->set($cacheIdentifier, $questions, $tags, $lifetime);
		}

		return $questions;
	}

	/**
	 * @return QuestionProcessor
	 */
	public function getQuestionProcessor() {
		return $this->objectManager->get(QuestionProcessor::class);
	}

	/**
	 * @param string $token
	 * @return bool
	 */
	protected function isAuthenticatedUser($token) {
		$hasQuestions = FALSE;
		if (!empty($token) && $this->getUserService()->isAuthenticated()) {
			$isAllowed = $this->getTokenService()->isAllowed($token);

			if ($isAllowed) {
				$hasQuestions = TRUE;
			}
		}
		return $hasQuestions;
	}

	/**
	 * @param string $token
	 * @return array
	 */
	protected function retrieveQuestionsFromUserPreferences($token) {
		return $this->getUserService()->get($token);
	}

	/**
	 * @return UserService
	 */
	protected function getUserService() {
		return $this->objectManager->get(UserService::class);
	}

	/**
	 * @return TokenService
	 */
	protected function getTokenService() {
		return $this->objectManager->get(TokenService::class);
	}

}