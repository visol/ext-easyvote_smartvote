<?php
namespace Visol\EasyvoteSmartvote\Grid;

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

use TYPO3\CMS\Vidi\Grid\GridRendererAbstract;

/**
 * Class for configuring a "Button Group" Grid Renderer.
 */
class ImportWizardColumnRenderer extends GridRendererAbstract {

	/**
	 * @return string
	 */
	public function render() {

		// @todo display icon

		return '<a href="#"><i class="icon-pencil"></i></a>';

		return '123';

//		$components = $this->getModuleLoader()->getGridButtonsComponents();
//
//		$result = '';
//		foreach ($components as $component) {
//
//			/** @var  $view */
//			$view = GeneralUtility::makeInstance($component);
//			$result .= $view->render($this->getObject());
//		}
//
//		return $result;
	}

}
