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
 * Import Parties from the Smart Vote platform.
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
	 * @var Election
	 */
	protected $election;

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
	 * @param Election $election
	 */
	public function __construct(Election $election){
		$this->election = $election;
	}

	/**
	 * Import the
	 *
	 * @return int
	 */
	public function import() {

		// @todo Handle if the platform is down
		$items = $this->getItemsFromDatasource();

		$counter = 0;
		foreach ($items as $item) {
			if (!$this->itemExists($item)) {
				$this->createItem($item);
			}

			$this->updateItem($item);
			$counter++;
		}

		return $counter;
	}

	/**
	 * @return array
	 */
	protected function getItemsFromDatasource() {
		$url = $this->getUrl($this->election->getSmartVoteIdentifier(), Model::PARTY, Language::GERMAN);

		$items = array();
		try {
			$data = file_get_contents($url);
			$items = json_decode($data, TRUE);
		} catch(\Exception $e) {
			$this->getLogger()->alert('I could not load Smart Vote data given the URL', $url);

		}
		return $items;
	}

	/**
	 * @param array $item
	 * @return bool
	 */
	protected function itemExists(array $item) {

		$clause = sprintf('internal_identifier = "%s"', $item[$this->internalIdentifier]);
		$clause .= BackendUtility::deleteClause($this->tableName);

		$record = $this->getDatabaseConnection()->exec_SELECTgetSingleRow('uid', $this->tableName, $clause);
		return !empty($record);
	}

	/**
	 * @param array $item
	 * @return bool
	 */
	protected function createItem(array $item) {
		$values['internal_identifier'] = $item[$this->internalIdentifier];
		$values['crdate'] = time();
		$this->getDatabaseConnection()->exec_INSERTquery($this->tableName, $values);
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
		$this->getDatabaseConnection()->exec_UPDATEquery($this->tableName, $clause, $values);
	}


}
