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

/**
 * View helper to return the Election out of the settings
 */
class CurrentElectionViewHelper extends AbstractViewHelper {

	/**
	 * Return the first election identifier.
	 *
	 * @return int
	 */
	public function render() {
		$settings = $this->templateVariableContainer->get('settings');
		$elections = GeneralUtility::trimExplode(',', $settings['elections'], TRUE);
		return (int)array_shift($elections);
	}
}
