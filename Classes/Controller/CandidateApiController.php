<?php
namespace Visol\EasyvoteSmartvote\Controller;

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
use Visol\EasyvoteSmartvote\Domain\Model\Election;
use Visol\EasyvoteSmartvote\Processor\CandidateProcessor;

/**
 * Question Controller
 */
class CandidateApiController extends AbstractBaseApiController
{

    /**
     * @var \Visol\EasyvoteSmartvote\Domain\Repository\CandidateRepository
     * @inject
     */
    protected $candidateRepository;

    /**
     * @var \TYPO3\CMS\Core\Cache\Frontend\AbstractFrontend
     */
    protected $cacheInstance;

    /**
     * @param Election $election
     * @return string
     */
    public function listAction(Election $election = NULL)
    {
        $this->initializeCache();


        $district = (int)GeneralUtility::_GP('district');
        $nationalParty = (int)GeneralUtility::_GP('nationalParty');
        $persona = GeneralUtility::_GP('persona') !== '' ? GeneralUtility::_GP('persona') : 0;
        $elected = (int)GeneralUtility::_GP('elected');
        $deselected = (int)GeneralUtility::_GP('deselected');

        $cacheIdentifier = sprintf('candidates-%s-%s-%s-%s-%s-%s-lang-%s', $election->getUid(), $district, $nationalParty, $persona, $elected, $deselected, (int)$GLOBALS['TSFE']->sys_language_uid);
        $candidates = $this->cacheInstance->get($cacheIdentifier);

        if (!$candidates) {
            $candidates = $this->candidateRepository->findByElection($election, $district, $nationalParty, $persona, $elected, $deselected);

            $candidates = $this->getCandidateProcessor()->process($candidates);
            $candidates = json_encode($candidates);

            $tags = array();
            $lifetime = $this->getLifeTime();
            $this->cacheInstance->set($cacheIdentifier, $candidates, $tags, $lifetime);
        }

        $this->response->setHeader('Content-Type', 'application/json');
        return $candidates;
    }

    /**
     * @return CandidateProcessor
     */
    public function getCandidateProcessor()
    {
        return $this->objectManager->get(CandidateProcessor::class);
    }

}