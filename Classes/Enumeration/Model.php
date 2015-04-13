<?php
namespace Visol\EasyvoteSmartvote\Enumeration;

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

use TYPO3\CMS\Core\Type\Enumeration;

/**
 * Enumeration for model types.
 */
class Model extends Enumeration {

	const PARTY = 'party';
	const CANDIDATE = 'candidate';
	const DISTRICT = 'district';
	const QUESTION = 'question';
	const QUESTION_CATEGORY = 'question_category';
	const DENOMINATION = 'denomination';
	const CIVIL_STATE = 'civil_state';
	const EDUCATION = 'education';

}
