<?php
namespace Visol\EasyvoteSmartvote\VotableAspect;

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

use Visol\Votable\Domain\Model\Vote;

/**
 * Class FlushCandidateCacheSlot
 */
class FlushCandidateCacheSlot
{

    /**
     * @param Vote $vote
     * @param string $addOrRemove
     * @return array
     */
    public function flush(Vote $vote, $addOrRemove)
    {

        $tableName = 'tx_easyvotesmartvote_domain_model_candidate';
        if ($vote->getVotedObject()->getContentType() === $tableName) {

            $record = $this->getDatabaseConnection()->exec_SELECTgetSingleRow(
                '*',
                'tx_easyvotesmartvote_domain_model_candidate',
                'uid = ' . $vote->getVotedObject()->getIdentifier()
            );
            if (!empty($record['election'])) {

                // Manually remove cache files.
                // $this->cacheInstance->flush is not selective enough
                $path = 'typo3temp/Cache/Data/easyvote_smartvote/candidates-' . $record['election'] . '-*';
                $files = glob($path);
                if (is_array($files)) {
                    foreach ($files as $file) {
                        unlink($file);
                    }
                }
            }
        }

        return [$vote, $addOrRemove];
    }


    /**
     * Returns a pointer to the database.
     *
     * @return \TYPO3\CMS\Core\Database\DatabaseConnection
     */
    protected function getDatabaseConnection()
    {
        return $GLOBALS['TYPO3_DB'];
    }

}
