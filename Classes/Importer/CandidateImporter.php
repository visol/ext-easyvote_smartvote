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
 * Import Candidates from the SmartVote platform.
 */
class CandidateImporter extends AbstractImporter {

	/**
	 * @var
	 */
	protected $tableName = 'tx_easyvotesmartvote_domain_model_candidate';

	/**
	 * @var
	 */
	protected $internalIdentifier = 'ID_Candidate';

	/**
	 * @var Election
	 */
	protected $election;

	/**
	 * @var
	 */
	protected $mappingFields = array(
	'firstname' => 'first_name',
	'lastname' => 'last_name',
	'gender' => 'gender',
	'year_of_birth' => 'year_of_birth',
	'city' => 'city',
	'language' => 'language',
	//'ID_district' => 10200000000,
	'district' => 'district_name',
	#'ID_party' => 10200000028,
	'party_short' => 'party_short',
	#'ID_list' => null,
	#'list' => null,
	#'listPlaces' => [ ],
	'incumbent' => 'incumbent',
	'elected' => 'elected',
	#'ID_civil_status' => null,
	'civil_status' => 'civil_status_name',
	#'ID_denomination' => null,
	'denomination' => 'denomination_name',
	#'ID_education' => 13,
	'education' => 'education_name',
	#'ID_employment' => 2,
	'employment' => 'employment_name',
	'occupation' => 'occupation',
	'n_children' => 'number_of_children',
	'hobbies' => 'hobbies',
	'fav_books' => 'favorite_books',
	'fav_music' => 'favorite_music',
	'fav_movies' => 'favorite_movies',
	'LINK_smartspider' => 'link_to_smart_spider',
	'LINK_portrait' => 'link_to_portrait',
	#'photos' => [ ],
	'LINK_facebook' => 'link_to_facebook',
	'LINK_twitter' => 'link_to_twitter',
	'LINK_politnetz' => 'link_to_politnetz',
	'LINK_youtube' => 'link_to_youtube',
	'LINK_vimeo' => 'link_to_vimeo',
	'e-mail_public' => 'email',
	#'termsInOffice' => [
	'whyMe' => 'why_me',
	'slogan' => 'slogan',
	#'politicalTopics' => [
	'personalWebsite' => 'personal_website',
	#'vestedInterests' => [ ],
	#'links' => [ ],
	#'answers'
	#'spiderValues'
	#'latitude'
	#'longitudes'
	);

	/**
	 * Import the
	 *
	 * @return int
	 */
	public function import() {
		return parent::import(Model::CANDIDATE);
	}

	/**
	 * @param array $item
	 * @return bool
	 */
	protected function updateItem(array $item) {

		$values = array();
		foreach ($this->mappingFields as $key => $field) {
			if (isset($item[$key]) && is_scalar($item[$key])) {
				$values[$this->mappingFields[$key]] = $item[$key];
			}
		}

		// Automatic values
		$values['election'] = $this->election->getUid();
		$values['tstamp'] = time();

		$clause = sprintf('internal_identifier = "%s"', $item[$this->internalIdentifier]);
		$clause .= BackendUtility::deleteClause($this->tableName);
		$result = $this->getDatabaseConnection()->exec_UPDATEquery($this->tableName, $clause, $values);
		if (!$result) {
			$query = $this->getDatabaseConnection()->UPDATEquery($this->tableName, $clause, $values);

			$message = 'SQL query failed when importing data from SmartVote';
			print $message . chr(10) . chr(10);
			$this->getLogger()->warning($message, array($query));
			die($query);
		}
	}

}
