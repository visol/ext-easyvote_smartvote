<?php
namespace Visol\EasyvoteSmartvote\ViewHelpers;

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

use TYPO3\CMS\Fluid\Core\ViewHelper\AbstractViewHelper;
use Visol\EasyvoteSmartvote\Domain\Model\Election;
use Visol\EasyvoteSmartvote\Service\TokenService;
use Visol\EasyvoteSmartvote\Service\UserService;

/**
 * View helper to return whether the User is authenticated.
 */
class QuestionStateViewHelper extends AbstractViewHelper {

	/**
	 * Returns whether the User is authenticated.
	 *
	 * @return string
	 */
	public function render() {

		// default value.
		$questions = [];

		if ($this->getUserService()->isAuthenticated()) {

			/** @var Election $election */
			$election = $this->templateVariableContainer->get('currentElection');
			$token = $this->getTokenService()->generate($election->getUid());
			$questions = $this->getUserService()->getCache($token);

			if (empty($questions)) {

				$relatedElection = $election->getRelatedElection();
				if ($relatedElection) {
					$token = $this->getTokenService()->generate($relatedElection->getUid());
					$questions = $this->getUserService()->getCache($token);
				}
			}
		}

		return json_encode($questions);
	}

	/**
	 * @return UserService
	 */
	protected function getUserService(){
		return $this->objectManager->get(UserService::class);
	}

	/**
	 * @return TokenService
	 */
	protected function getTokenService(){
		return $this->objectManager->get(TokenService::class);
	}

}
