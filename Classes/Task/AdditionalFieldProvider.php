<?php
namespace Visol\EasyvoteSmartvote\Task;

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

use TYPO3\CMS\Scheduler\AdditionalFieldProviderInterface;

/**
 * Additional fields provider class for "PurgeTask"
 */
class AdditionalFieldProvider implements AdditionalFieldProviderInterface
{
    /**
     * This method is used to define new fields for adding or editing a task
     * In this case, it adds an numberOfDays field
     *
     * @param array $taskInfo : reference to the array containing the info used in the add/edit form
     * @param object $task : when editing, reference to the current task object. Null when adding.
     * @param \TYPO3\CMS\Scheduler\Controller\SchedulerModuleController $parentObject : reference to the calling object (Scheduler's BE module)
     * @return array                    Array containg all the information pertaining to the additional fields
     *                                    The array is multidimensional, keyed to the task class name and each field's id
     *                                    For each field it provides an associative sub-array with the following:
     *                                        ['code']        => The HTML code for the field
     *                                        ['label']        => The label of the field (possibly localized)
     *                                        ['cshKey']        => The CSH key for the field
     *                                        ['cshLabel']    => The code of the CSH label
     */
    public function getAdditionalFields(array &$taskInfo, $task, \TYPO3\CMS\Scheduler\Controller\SchedulerModuleController $parentObject)
    {
        $additionalFields = [];

        // Initialize extra field value
        if (empty($taskInfo['numberOfDays'])) {
            if ($parentObject->CMD == 'add') {
                // In case of new task and if field is empty, set default numberOfDays address
                $taskInfo['numberOfDays'] = 90;
            } elseif ($parentObject->CMD == 'edit') {
                // In case of edit, and editing a test task, set to internal value if not data was submitted already
                $taskInfo['numberOfDays'] = $task->numberOfDays;
            } else {
                // Otherwise set an empty value, as it will not be used anyway
                $taskInfo['numberOfDays'] = '';
            }
        }

        // Write the code for the field
        $fieldID = 'task_numberOfDays';
        $fieldCode = '<input type="number" name="tx_scheduler[numberOfDays]" id="' . $fieldID . '" value="' . htmlspecialchars($taskInfo['numberOfDays']) . '" size="3" min="1" max="365" />';
        $additionalFields[$fieldID] = [
            'code' => $fieldCode,
            'label' => 'LLL:EXT:easyvote_smartvote/Resources/Private/Language/locallang_task.xlf:purge.field.numberOfDays',
        ];

        // Initialize field
		if (!isset($taskInfo['email'])) {
			$taskInfo['email'] = '';
			if ($parentObject->CMD === 'edit') {
				$taskInfo['email'] = $task->email;
			}
		}

        $fieldID = 'task_email';
        $fieldCode = '<input type="input" name="tx_scheduler[email]" id="' . $fieldID . '" value="' . htmlspecialchars($taskInfo['email']) . '"/>';
        $additionalFields[$fieldID] = [
            'code' => $fieldCode,
            'label' => 'LLL:EXT:easyvote_smartvote/Resources/Private/Language/locallang_task.xlf:purge.field.email',
        ];

        return $additionalFields;
    }

    /**
     * This method checks any additional data that is relevant to the specific task
     * If the task class is not relevant, the method is expected to return true
     *
     * @param    array $submittedData : reference to the array containing the data submitted by the user
     * @param    \TYPO3\CMS\Scheduler\Controller\SchedulerModuleController $parentObject : reference to the calling object (Scheduler's BE module)
     * @return    bool                    True if validation was ok (or selected class is not relevant), false otherwise
     */
    public function validateAdditionalFields(array &$submittedData, \TYPO3\CMS\Scheduler\Controller\SchedulerModuleController $parentObject)
    {
        return true;
    }

    /**
     * This method is used to save any additional input into the current task object
     * if the task class matches
     *
     * @param    array $submittedData : array containing the data submitted by the user
     * @param    \TYPO3\CMS\Scheduler\Task\AbstractTask $task : reference to the current task object
     */
    public function saveAdditionalFields(array $submittedData, \TYPO3\CMS\Scheduler\Task\AbstractTask $task)
    {
        $task->numberOfDays = $submittedData['numberOfDays'];
        $task->email = $submittedData['email'];
    }
}
