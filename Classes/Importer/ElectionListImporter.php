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
 * Import Lists from the SmartVote platform.
 */
class ElectionListImporter extends AbstractImporter {

	/**
	 * @var
	 */
	protected $tableName = 'tx_easyvotesmartvote_domain_model_electionlist';

	/**
	 * @var
	 */
	protected $internalIdentifier = 'ID_list';

	/**
	 * @var Election
	 */
	protected $election;

	/**
	 * @var array
	 */
	protected $relations = array(
		'ID_district' => array(
			'localField' => 'district',
			'foreignTable' => 'tx_easyvotesmartvote_domain_model_district',
		),
	);

	/**
	 * @var
	 */
	protected $mappingFields = array(
		'list' => 'name',
		#'ID_district' => 10200000000, -> handled via $this->relations
		'list_number' => 'list_number',
		'LINK_list' => 'link_to_list',
		'n_candidates' => 'number_of_candidates',
		'n_answers' => 'number_of_answers',
	);

	/**
	 * Import the
	 *
	 * @return int
	 */
	public function import() {
		return parent::import(Model::ELECTION_LIST);
	}

}
