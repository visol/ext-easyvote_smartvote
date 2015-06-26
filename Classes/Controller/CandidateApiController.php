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

use Visol\EasyvoteSmartvote\Domain\Model\Election;
use Visol\EasyvoteSmartvote\Processor\CandidateProcessor;
use Visol\EasyvoteSmartvote\Service\TokenService;
use Visol\EasyvoteSmartvote\Service\UserService;

/**
 * Question Controller
 */
class CandidateApiController extends AbstractBaseApiController {

	/**
	 * @var \Visol\EasyvoteSmartvote\Domain\Repository\CandidateRepository
	 * @inject
	 */
	protected $candidateRepository;

	/**
	 * @param Election $election
	 * @return string
	 */
	public function listAction(Election $election = NULL) {

		$candidates = $this->candidateRepository->findByElection($election);
		$candidates = $this->getCandidateProcessor()->process($candidates);

		$this->response->setHeader('Content-Type', 'application/json');
		return json_encode($candidates);
	}

	/**
	 * @return CandidateProcessor
	 */
	public function getCandidateProcessor() {
		return $this->objectManager->get(CandidateProcessor::class);
	}

}