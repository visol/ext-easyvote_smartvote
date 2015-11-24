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
class StateApiController extends AbstractBaseApiController
{

    /**
     * @return string
     */
    public function saveAction()
    {

        $result = 'ko';

        $token = GeneralUtility::_GP('token');
        if (!empty($token) && $this->getUserService()->isAuthenticated()) {
            $isAllowed = $this->getTokenService()->isAllowed($token);

            if ($isAllowed) {

                // Retrieve the question to update.
                $requestBody = file_get_contents('php://input');
                $questions = json_decode($requestBody, TRUE);

                // Update the collection
                $this->getUserService()->setCache($token, $questions);
                $result = 'ok';
            }
        }
        $this->response->setHeader('Content-Type', 'application/json');
        return json_encode($result);
    }

    /**
     * @return UserService
     */
    protected function getUserService()
    {
        return $this->objectManager->get(UserService::class);
    }

    /**
     * @return TokenService
     */
    protected function getTokenService()
    {
        return $this->objectManager->get(TokenService::class);
    }

}