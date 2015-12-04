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

use DirectoryIterator;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Scheduler\Task\AbstractTask;

/**
 * Class for purging cache files.
 */
class PurgeTask extends AbstractTask
{
    /**
     * @var int
     */
    public $numberOfDays;

    /**
     * @var string
     */
    public $email;

    /**
     * Function executed from the Scheduler.
     * Sends an email
     *
     * @return bool
     */
    public function execute()
    {
        if (!(int) $this->numberOfDays > 0) {
            return false;
        }

        $numberOfDeleteFiles = 0;
        $now = new \DateTime();
        $directory = $this->getCacheDirectory();
        if (file_exists($directory)) {

            foreach (new DirectoryIterator($directory) as $fileInfo) {
                if ($fileInfo->isDot()) {
                    continue;
                }

                $filePath = $fileInfo->getRealPath();
                $modified = new \DateTime("@" . $fileInfo->getMTime());
                $age = (int) $now->diff($modified)->format('%a');

                if ($age >= $this->numberOfDays) {
                    $numberOfDeleteFiles++;
                    unlink($filePath);
                }
            }
        }

        // Only sent if files where deleted.
        if ($numberOfDeleteFiles > 0) {
            $this->sendNotification($numberOfDeleteFiles);
        }

        return true;
    }

    /**
     * Send email to notify what files where deleted (or not)
     *
     * @param int $numberOfDeleteFiles
     * @return bool
     */
    private function sendNotification($numberOfDeleteFiles)
    {
        /** @var $message \TYPO3\CMS\Core\Mail\MailMessage */
        $message = GeneralUtility::makeInstance('TYPO3\CMS\Core\Mail\MailMessage');

        $message->setTo($this->email);
        $message->setFrom('no_reply@easyvote.ch');
        $message->setSubject('Easyvote: flushed user data');
        $content = "
Hi admin,
<br />
<br />
For your information, I just cleaned ${numberOfDeleteFiles} file(s) of cache data older than $this->numberOfDays days related to smartvote.
<br />
<br />
This is an automatic message.
<br />
<br />
- easyvote.ch
        ";
        $message->setBody($content, 'text/html');
        $message->send();
        return $message->isSent();
    }

    /**
     * @return array
     */
    protected function getConfiguration()
    {
        return unserialize($GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf']['easyvote_smartvote']);
    }

    /**
     * @return string
     */
    private function getCacheDirectory()
    {
        $configuration = $this->getConfiguration();
        $directory = $configuration['cache_directory'];

        return PATH_site . $directory;
    }

}
