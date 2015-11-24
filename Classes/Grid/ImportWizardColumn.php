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
class ImportWizardColumn extends GenericRendererComponent
{

    /**
     * Configure the "Button Group" Grid Renderer.
     */
    public function __construct()
    {
        $configuration = array(
            'sortable' => FALSE,
            'canBeHidden' => FALSE,
            'label' => 'LLL:EXT:easyvote_smartvote/Resources/Private/Language/tx_easyvotesmartvote_domain_model_election.xlf:import',
            'width' => '70px',
        );
        parent::__construct(ImportWizardColumnRenderer::class, $configuration);
    }
}
