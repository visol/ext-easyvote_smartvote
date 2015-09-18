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
		} else if (facet.name === 'name') {
			value = candidate.get('firstName') + ' ' + candidate.get('lastName') + ' ' + candidate.get('firstName');
			filterValue = facet.value;
			isOk = this.isLike(value, filterValue);
		} else if (facet.name === 'persona') {
			value = candidate.get('persona');
			filterValue = facet.value;
			isOk = this.isLike(value, filterValue);
		}  else if (facet.name === 'candidate') {
			value = candidate.get('id');
			filterValue = facet.value;
			isOk = this.isEqual(value, filterValue);
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
	 * @param objectValue
	 * @param facetValue
	 * @returns {boolean}
	 */
	isLike(objectValue, facetValue) {
		if (objectValue.toLowerCase().indexOf(facetValue.toLowerCase()) >= 0) {
			return true;
		} else {
			return false;
		}
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