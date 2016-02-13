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

use Visol\Votable\Hook\RankCacheHookInterface;


/**
 * Class RankCacheWhereClause
 */
class RankCacheWhereClauseHook implements RankCacheHookInterface
{

    /**
     * @param string $possibleWhereClause
     * @param \Visol\Votable\Domain\Model\Vote $vote
     * @return string
     */
    public function getPossibleWhereClause($possibleWhereClause, $vote)
    {
        $record = $this->getDatabaseConnection()->exec_SELECTgetSingleRow(
            '*',
            $vote->getVotedObject()->getContentType(),
            'uid = ' . $vote->getVotedObject()->getIdentifier()
        );

        if (!empty($record['election'])) {
            $possibleWhereClause = 'election = ' . $record['election'];
        }

        return $possibleWhereClause;
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
