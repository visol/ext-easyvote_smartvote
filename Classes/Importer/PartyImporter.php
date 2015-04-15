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
use Visol\EasyvoteSmartvote\Enumeration\Model;

/**
 * Import Parties from the SmartVote platform.
 */
class PartyImporter extends AbstractImporter {

	/**
	 * @var
	 */
	protected $tableName = 'tx_easyvotesmartvote_domain_model_party';

	/**
	 * @var
	 */
	protected $internalIdentifier = 'ID_party';

	/**
	 * @var
	 */
	protected $mappingFields = array(
		'party' => 'name',
		'party_short' => 'name_short',
		'logo' => 'logo',
		'n_candidates' => 'number_of_candidates',
		'n_answers' => 'number_of_answers',
		'facebookProfile' => 'facebook_profile',
		'website' => 'website',
		#'parents' => 'parents',
		#'constituencies' => 'districts',
		#'lists' => 'lists',
		#'answers' => 'answers',
	);

	/**
	 * @return int
	 */
	public function import() {
		return parent::import(Model::PARTY);
	}

}
