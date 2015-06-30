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
 * Import Civil States from the SmartVote platform.
 */
class CivilStateImporter extends AbstractImporter {

	/**
	 * @var
	 */
	protected $tableName = 'tx_easyvotesmartvote_domain_model_civilstate';

	/**
	 * @var
	 */
	protected $internalIdentifier = 'id';

	/**
	 * @var Election
	 */
	protected $election;

	/**
	 * @var
	 */
	protected $mappingFields = array(
		'name' => 'name',
	);

	/**
	 * @return array
	 */
	public function import() {
		return parent::import(Model::CIVIL_STATE);
	}

}
