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
use Visol\EasyvoteSmartvote\Service\UserService;

/**
 * View helper to return whether the User is authenticated.
 */
class IsUserAuthenticatedViewHelper extends AbstractViewHelper
{

    /**
     * Returns whether the User is authenticated.
     *
     * @return bool
     */
    public function render()
    {
        return $this->getUserService()->isAuthenticated();
    }

    /**
     * @return UserService
     */
    protected function getUserService()
    {
        return $this->objectManager->get(UserService::class);
    }

}
