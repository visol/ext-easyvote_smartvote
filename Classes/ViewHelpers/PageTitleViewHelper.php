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
use TYPO3\CMS\Frontend\Page\PageRepository;
use Visol\EasyvoteSmartvote\Domain\Model\Election;
use Visol\EasyvoteSmartvote\Service\TokenService;

/**
 * View helper to return the page title.
 */
class PageTitleViewHelper extends AbstractViewHelper
{

    /**
     * Return a page title.
     *
     * @param int $uid
     * @return string
     */
    public function render($uid)
    {
        $page = $this->getFrontendObject()->sys_page->getPage($uid);
        return $page['title'];
    }

    /**
     * @return TokenService
     */
    protected function getTokenService()
    {
        return $this->objectManager->get(TokenService::class);
    }

    /**
     * Returns an instance of the Frontend object.
     *
     * @return \TYPO3\CMS\Frontend\Controller\TypoScriptFrontendController
     */
    protected function getFrontendObject()
    {
        return $GLOBALS['TSFE'];
    }
}
