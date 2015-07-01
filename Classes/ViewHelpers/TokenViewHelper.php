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

use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Fluid\Core\ViewHelper\AbstractViewHelper;
use Visol\EasyvoteSmartvote\Domain\Model\Election;
use Visol\EasyvoteSmartvote\Service\TokenService;

/**
 * View helper to return a storage key for the LocalStorage.
 */
class TokenViewHelper extends AbstractViewHelper {

	/**
	 * Return a storage key for the LocalStorage.
	 *
	 * @param bool $forRelatedElection
	 * @return string
	 * @throws \TYPO3\CMS\Fluid\Core\ViewHelper\Exception\InvalidVariableException
	 */
	public function render($forRelatedElection = FALSE) {
		/** @var Election $election */
		$election = $this->templateVariableContainer->get('currentElection');
		if ($forRelatedElection) {
			$token = ''; // default is empty
			$relatedElection = $election->getRelatedElection();
			if ($relatedElection) {
				$token = $this->getTokenService()->generate($relatedElection->getUid());
			}
		} else {
			$token = $this->getTokenService()->generate($election->getUid());
		}

		return $token;
	}

	/**
	 * @return TokenService
	 */
	protected function getTokenService(){
		return $this->objectManager->get(TokenService::class);
	}

}
