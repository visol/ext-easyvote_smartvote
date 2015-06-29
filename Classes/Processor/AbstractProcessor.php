<?php
namespace Visol\EasyvoteSmartvote\Processor;

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

/**
 * Abstract Processor
 */
abstract class AbstractProcessor {

	/**
	 * @param array $items
	 * @return array
	 */
	protected function convertKeysToCamelCase(array $items) {
		$convertedKeys = array_map(
			function ($item) {
				$convertedItem = array();
				foreach ($item as $key => $value) {
					$key = $this->underscoredToLowerCamelCase($key);
					$convertedItem[$key] = $value;
				}
				return $convertedItem;
			},
			$items
		);

		return $convertedKeys;
	}

	/**
	 * Returns a given string with underscores as lowerCamelCase.
	 * Example: Converts minimal_value to minimalValue
	 *
	 * @param string $string String to be converted to camel case
	 * @return string lowerCamelCasedWord
	 */
	public function underscoredToLowerCamelCase($string) {
		$upperCamelCase = str_replace(' ', '', ucwords(str_replace('_', ' ', $string)));
		$lowerCamelCase = lcfirst($upperCamelCase);
		return $lowerCamelCase;
	}
}