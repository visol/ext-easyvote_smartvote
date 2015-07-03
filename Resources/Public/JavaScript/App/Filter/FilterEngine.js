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

		var subjectYearOfBirth, age;
		var isOk = true;

		switch (facet.name) {

			case 'minAge':
				subjectYearOfBirth = candidate.get('yearOfBirth');
				age = facet.value;
				isOk = this.isYoungerOrEqual(subjectYearOfBirth, age);
				break;

			case 'maxAge':
				subjectYearOfBirth = candidate.get('yearOfBirth');
				age = facet.value;
				isOk = this.isOlderOrEqual(subjectYearOfBirth, age);
				break;
		}

		return isOk;

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