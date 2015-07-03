/*jshint esnext:true */

/*
 * This file is part of the TYPO3 CMS project.
 *
 * See LICENSE.txt that was shipped with this package.
 */

export default class FilterEngine {

	/**
	 * @param candidate
	 * @param facet
	 * @returns {boolean}
	 */
	isOk(candidate, facet) {

		var value, filterValue;
		var isOk = true;

		if (!facet.value) {
			isOk = true;
		} else if (facet.name === 'minAge') {
			value = candidate.get('yearOfBirth');
			filterValue = facet.value;
			isOk = this.isYoungerOrEqual(value, filterValue);
		} else if (facet.name === 'maxAge') {
			value = candidate.get('yearOfBirth');
			filterValue = facet.value;
			isOk = this.isOlderOrEqual(value, filterValue);
		} else {
			value = candidate.get(facet.name);
			isOk = this.isEqual(value, facet.value);
		}

		return isOk;
	}

	/**
	 * @param {int} objectValue
	 * @param {int} facetValue
	 * @returns {boolean}
	 */
	isEqual(objectValue, facetValue) {
		return objectValue == facetValue;
	}

	/**
	 * @param {int} subjectYearOfBirth
	 * @param {int} age
	 * @returns {boolean}
	 */
	isYoungerOrEqual(subjectYearOfBirth, age) {
		let currentYear = new Date().getFullYear();
		return subjectYearOfBirth <= currentYear - age;
	}

	/**
	 * @param {int} subjectYearOfBirth
	 * @param {int} age
	 * @returns {boolean}
	 */
	isOlderOrEqual(subjectYearOfBirth, age) {
		let currentYear = new Date().getFullYear();
		return subjectYearOfBirth >= currentYear - age;
	}

}