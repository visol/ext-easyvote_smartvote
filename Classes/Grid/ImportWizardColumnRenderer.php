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
use TYPO3\CMS\Backend\Utility\BackendUtility;
use TYPO3\CMS\Backend\Utility\IconUtility;
use Visol\EasyvoteSmartvote\Module\ModuleParameter;

/**
 * Class for configuring a "Button Group" Grid Renderer.
 */
class ImportWizardColumnRenderer extends GridRendererAbstract
{

    /**
     * @return string
     */
    public function render()
    {

        $out = sprintf(
            '<div style="text-align: center"><a href="%s" class="btn-import-voting">%s</a></div>',
            $this->getImportUri(),
            IconUtility::getSpriteIcon('extensions-easyvote-smartvote-export')
        );

        return $out;
    }


    /**
     * @return string
     */
    protected function getImportUri()
    {
        $urlParameters = array(
            ModuleParameter::PREFIX => array(
                'controller' => 'Election',
                'action' => 'import',
                'election' => $this->getObject()->getUid(),
            ),
        );
        return BackendUtility::getModuleUrl(ModuleParameter::MODULE_SIGNATURE, $urlParameters);
    }

}
