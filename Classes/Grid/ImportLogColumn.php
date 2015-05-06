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

use Fab\Vidi\Grid\GenericRendererComponent;

/**
 * Class for configuring a "Button Group" Grid Renderer.
 */
class ImportLogColumn extends GenericRendererComponent {

	/**
	 * Configure the "Button Group" Grid Renderer.
	 */
	public function __construct() {
		$configuration = array(
			'sortable' => FALSE,
			'width' => '300px',
		);
		parent::__construct(ImportLogColumnRenderer::class, $configuration);
	}
}
