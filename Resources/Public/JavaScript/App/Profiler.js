/*jshint esnext:true */

/*
 * This file is part of the TYPO3 CMS project.
 *
 * See LICENSE.txt that was shipped with this package.
 */

export default
class Profiler {

	constructor() {
		this.time = window.performance.now();
	}

	/**
	 *
	 * @param message
	 */
	track(message = '') {
		if (message) {
			console.log(message);
		}

		let spentTime = window.performance.now() - this.time
		console.log(spentTime);
	}

	/**
	 * @return CandidateCollection
	 */
	static getInstance() {
		if (!this.instance) {
			this.instance = new Profiler();

		}
		return this.instance;
	}
}