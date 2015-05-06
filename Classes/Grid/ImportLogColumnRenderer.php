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

use Fab\Vidi\Grid\GridRendererAbstract;
use TYPO3\CMS\Backend\Utility\IconUtility;

/**
 * Class for configuring a "Button Group" Grid Renderer.
 */
class ImportLogColumnRenderer extends GridRendererAbstract {

	/**
	 * @return string
	 */
	public function render() {
		return sprintf(
			'<pre style="font-size: 90%%">%s</pre>',
			$this->object[$this->fieldName]
		);
	}

}
