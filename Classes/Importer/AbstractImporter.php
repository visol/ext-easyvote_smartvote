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

use TYPO3\CMS\Core\Utility\GeneralUtility;
use Visol\EasyvoteSmartvote\Enumeration\Model;

/**
 * Import Parties from Smart Vote
 */
abstract class AbstractImporter implements ImporterInterface {

	/**
	 * @var string
	 */
	protected $baseUrl = 'http://smartvote.ch/api/1.0';

	/**
	 * @var string
	 */
	protected $key = 'be9bbde6c7ee3adf6ab93803da1de736';

	/**
	 * @var array
	 */
	protected $models = array(
		Model::PARTY => 'parties.json',
		Model::DISTRICT => 'candidates.json',
		Model::DISTRICT => 'parties.json',
	);

	/**
	 * @param string $smartVoteIdentifier
	 * @param string $modelType
	 * @param string $locale
	 * @return string
	 */
	protected function getUrl($smartVoteIdentifier, $modelType, $locale) {

		$segments[] = $smartVoteIdentifier;
		$segments[] = $this->models[$modelType];

		$arguments[] = 'lang=' . $locale;
		$arguments[] = 'key=' . $this->key;

		$url = sprintf(
			'%s/%s?%s',
			$this->baseUrl,
			implode('/', $segments),
			implode('&', $arguments)
		);

		return $url;
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
	 * @return \TYPO3\CMS\Core\Log\Logger
	 */
	protected function getLogger(){

		/** @var $loggerManager \TYPO3\CMS\Core\Log\LogManager */
		$loggerManager = GeneralUtility::makeInstance('TYPO3\CMS\Core\Log\LogManager');

		/** @var $logger \TYPO3\CMS\Core\Log\Logger */
		return $loggerManager->getLogger(get_class($this));
	}

}
