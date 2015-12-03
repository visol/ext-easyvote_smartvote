/*jshint esnext:true */

/*
 * This file is part of the TYPO3 CMS project.
 *
 * See LICENSE.txt that was shipped with this package.
 */

/**
 * Class EnvironmentChecker
 */
export default
class EnvironmentChecker {

	/**
	 * Constructor
	 */
	constructor() {
		this.time = window.performance.now();
	}

	/**
	 * Detect whether the local storage is accessible
	 *
	 * @returns {boolean}
	 */
	isLocalStorageAvailable() {

		var isLocalStorageAvailable = true;

		var localStorage;
		try {
			localStorage = window.localStorage;
			localStorage.getItem;
		} catch (e) {
			isLocalStorageAvailable = false;
			alert('For technical reason the page will not be display correctly. Please make to have the LocalStorage enabled');
		}

		return isLocalStorageAvailable;
	}


	/**
	 * Detect whether the localStorage is full
	 *
	 * @returns {boolean}
	 */
	isLocalStorageReady() {

		var isLocalStorageReady = true;

		try {
			localStorage.setItem('storage-check', 'works!');
		} catch(e) {
			if (this.isQuotaExceeded(e)) {
				localStorage.clear();
			} else {
				isLocalStorageReady = false;
			}
		}

		return isLocalStorageReady;
	}

	/**
	 * @param e
	 * @returns {boolean}
	 */
	isQuotaExceeded(e) {
		var quotaExceeded = false;
		if (e) {
			if (e.code) {
				switch (e.code) {
					case 22:
						quotaExceeded = true;
						break;
					case 1014:
						// Firefox
						if (e.name === 'NS_ERROR_DOM_QUOTA_REACHED') {
							quotaExceeded = true;
						}
						break;
				}
			} else if (e.number === -2147024882) {
				// Internet Explorer 8
				quotaExceeded = true;
			}
		}
		return quotaExceeded;
	}

}