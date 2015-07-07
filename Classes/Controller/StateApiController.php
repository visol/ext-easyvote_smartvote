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
use Visol\EasyvoteSmartvote\Service\TokenService;
use Visol\EasyvoteSmartvote\Service\UserService;

/**
 * State Controller
 */
class StateApiController extends AbstractBaseApiController {

	/**
	 * @return string
	 */
	public function saveAction() {

		$question = array();

		$token = GeneralUtility::_GP('token');
		if (!empty($token) && $this->getUserService()->isAuthenticated()) {
			$isAllowed = $this->getTokenService()->isAllowed($token);

			if ($isAllowed) {

				// Fetch collection of question from User preferences.
				$questions = $this->getUserService()->getCache($token);

				// Retrieve the question to update.
				$requestBody = file_get_contents('php://input');
				$question = json_decode($requestBody, TRUE);

				// Update the collection
				$updatedQuestions = $this->updateCollection($question, $questions);
				$this->getUserService()->setCache($token, $updatedQuestions);
			}
		}
		$this->response->setHeader('Content-Type', 'application/json');
		return json_encode($question);
	}

	/**
	 * @param array $updatedItem
	 * @param array $items
	 * @return array
	 */
	protected function updateCollection(array $updatedItem, array $items) {
		$updatedItems = array();
		foreach ($items as $index => $question) {

			// Check whether that the question coming from the request.
			if ((int)$question['id'] === (int)$updatedItem['id']) {
				$question = $updatedItem;
			}
			$updatedItems[$index] = $question;
		}

		return $updatedItems;
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