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
	 * @var array
	 */
	protected $relations = array(
		'ID_district' => array(
			'localField' => 'district',
			'foreignTable' => 'tx_easyvotesmartvote_domain_model_district',
		),
		'ID_party' => array(
			'localField' => 'party',
			'foreignTable' => 'tx_easyvotesmartvote_domain_model_party',
		),
		'ID_list' => array(
			'localField' => 'election_list',
			'foreignTable' => 'tx_easyvotesmartvote_domain_model_electionlist',
		),
		'ID_civil_status' => array(
			'localField' => 'civil_state',
			'foreignTable' => 'tx_easyvotesmartvote_domain_model_civilstate',
		),
		'ID_denomination' => array(
			'localField' => 'denomination',
			'foreignTable' => 'tx_easyvotesmartvote_domain_model_denomination',
		),
		'ID_education' => array(
			'localField' => 'education',
			'foreignTable' => 'tx_easyvotesmartvote_domain_model_education',
		),
	);

	/**
	 * @var array
	 */
	protected $serializedFields = array(
		'photos' => 'serialized_photos',
		'links' => 'serialized_links',
		'answers' => 'serialized_answers',
		'spiderValues' => 'serialized_spider_values',
		'mapValues' => 'serialized_coordinate',
	);

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
	#'ID_district' => 10200000000, -> handled via $this->relations
	'district' => 'district_name',
	#'ID_party' => 10200000028, -> handled via $this->relations
	'party_short' => 'party_short',
	#'ID_list' => null, -> handled via $this->relations
	'list' => 'election_list_name',
	#'listPlaces' => [ ],
	'incumbent' => 'incumbent',
	'elected' => 'elected',
	#'ID_civil_status' => null, -> handled via $this->relations
	'civil_status' => 'civil_state_name',
	#'ID_denomination' => null, -> handled via $this->relations
	'denomination' => 'denomination_name',
	#'ID_education' => 13, -> handled via $this->relations
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
	#'photos' => [ ], -> serialized
	'LINK_facebook' => 'link_to_facebook',
	'LINK_twitter' => 'link_to_twitter',
	'LINK_politnetz' => 'link_to_politnetz',
	'LINK_youtube' => 'link_to_youtube',
	'LINK_vimeo' => 'link_to_vimeo',
	'e-mail_public' => 'email',
	#'termsInOffice' =>  -> skipped
	'whyMe' => 'why_me',
	'slogan' => 'slogan',
	#'politicalTopics' => [
	'personalWebsite' => 'personal_website',
	#'vestedInterests' => [ ], -> skipped
	#'links' => [ ], -> serialized
	#'answers' -> serialized
	#'spiderValues' -> serialized
	#'coordinate' -> serialized
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