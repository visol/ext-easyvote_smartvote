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
use Visol\EasyvoteSmartvote\Processor\QuestionProcessor;
use Visol\EasyvoteSmartvote\Service\TokenService;
use Visol\EasyvoteSmartvote\Service\UserService;

/**
 * Question Controller
 */
class QuestionApiController extends AbstractBaseApiController
{

    /**
     * @var \Visol\EasyvoteSmartvote\Domain\Repository\QuestionRepository
     * @inject
     */
    protected $questionRepository;

    /**
     * @param Election $election
     * @return string
     */
    public function listAction(Election $election = NULL)
    {

        $this->initializeCache();

        $cacheIdentifier = 'questions-' . $election->getUid() . '-lang-' . (int)$GLOBALS['TSFE']->sys_language_uid;
        $questions = $this->cacheInstance->get($cacheIdentifier);

        if (empty($questions)) {
            $questions = $this->questionRepository->findByElection($election);
            $questions = $this->getQuestionProcessor()->process($questions);
            $questions = json_encode($questions);

            $tags = array();
            $lifetime = $this->getLifeTime();
            $this->cacheInstance->set($cacheIdentifier, $questions, $tags, $lifetime);
        }

        $this->response->setHeader('Content-Type', 'application/json');
        return $questions;
    }

    /**
     * @return QuestionProcessor
     */
    public function getQuestionProcessor()
    {
        return $this->objectManager->get(QuestionProcessor::class);
    }

}