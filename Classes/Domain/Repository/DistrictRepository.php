<?php
namespace Visol\EasyvoteSmartvote\Domain\Repository;

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

use TYPO3\CMS\Extbase\Persistence\Repository;
use Visol\EasyvoteSmartvote\Domain\Model\Election;

/**
 * The repository for Districts
 */
class DistrictRepository extends Repository {

	/**
	 * Find a district for a given election that applies to a city
	 * The city is resolved to it's canton
	 *
	 * @param Election $election
	 * @param $cityUid
	 * @return null
	 */
	public function findOneByElectionAndCityUid(Election $election, $cityUid) {
		$userCanton = $this->getDatabaseConnection()->exec_SELECTgetSingleRow(
			'tx_easyvote_domain_model_kanton.uid',
			'tx_easyvote_domain_model_kanton join tx_easyvote_domain_model_city on tx_easyvote_domain_model_kanton.uid = tx_easyvote_domain_model_city.kanton',
			'tx_easyvote_domain_model_city.uid=' . $cityUid . ' AND tx_easyvote_domain_model_city.sys_language_uid IN (0,-1) AND NOT tx_easyvote_domain_model_city.deleted AND NOT tx_easyvote_domain_model_city.hidden'
		);
		if (is_array($userCanton)) {
			$userDistrict = $this->getDatabaseConnection()->exec_SELECTgetSingleRow(
				'uid',
				'tx_easyvotesmartvote_domain_model_district',
				'canton = ' . (int)$userCanton['uid'] . ' AND election = ' . $election->getUid() . ' AND NOT deleted AND NOT hidden'
			);
			if (is_array($userDistrict)) {
				return $userDistrict['uid'];
			}
		}
		return NULL;
	}

	/**
	 * Returns a pointer to the database.
	 *
	 * @return \TYPO3\CMS\Core\Database\DatabaseConnection
	 */
	protected function getDatabaseConnection() {
		return $GLOBALS['TYPO3_DB'];
	}

	/**
	 * Returns an instance of the page repository.
	 *
	 * @return \TYPO3\CMS\Frontend\Page\PageRepository
	 */
	protected function getPageRepository() {
		return $GLOBALS['TSFE']->sys_page;
	}

}