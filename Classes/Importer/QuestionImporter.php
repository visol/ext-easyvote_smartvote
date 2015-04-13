<?php
namespace Visol\EasyvoteSmartvote\Importer;

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
use TYPO3\CMS\Backend\Utility\BackendUtility;
use Visol\EasyvoteSmartvote\Domain\Model\Election;
use Visol\EasyvoteSmartvote\Enumeration\Language;
use Visol\EasyvoteSmartvote\Enumeration\Model;

/**
 * Import Questions from the SmartVote platform.
 */
class QuestionImporter extends AbstractImporter {

	/**
	 * @var
	 */
	protected $tableName = 'tx_easyvotesmartvote_domain_model_question';

	/**
	 * @var
	 */
	protected $internalIdentifier = 'ID_question';

	/**
	 * @var
	 */
	protected $mappingFields = array(
		'question' => 'question',
		'category' => 'category',
		'group' => 'groupping',
		'type' => 'Standard-4',
		'rapide' => 'rapide',
		'edu' => 'education',
		'cleavage_1' => 'cleavage1',
		'cleavage_2' => 'cleavage2',
		'cleavage_3' => 'cleavage3',
		'cleavage_4' => 'cleavage4',
		'cleavage_5' => 'cleavage5',
		'cleavage_6' => 'cleavage6',
		'cleavage_7' => 'cleavage7',
		'cleavage_8' => 'cleavage8',
		'info' => 'info',
		'pro' => 'pro',
		'contra' => 'contra'
	);

	/**
	 * Import the
	 *
	 * @return int
	 */
	public function import() {
		return parent::import(Model::CANDIDATE);
	}

}
