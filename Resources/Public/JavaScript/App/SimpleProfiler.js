/*jshint esnext:true */

/*
 * This file is part of the TYPO3 CMS project.
 *
 * See LICENSE.txt that was shipped with this package.
 */

/**
 * Usage:
 * import SpiderChartPlotter from '../../SimpleProfiler'
 *
 * SimpleProfiler.getInstance().track('Start something');
 * SimpleProfiler.getInstance().track('Stop something');
 */
export default
class SimpleProfiler {

	/**
	 * Constructor
	 */
	constructor() {
		this.time = window.performance.now();
	}

	/**
	 *
	 * @param {string} message
	 * @param {bool} resetTimer
	 */
	track(message = '', resetTimer = false) {

		if (resetTimer) {
			this.time = window.performance.now();
		}

		let spentTime = window.performance.now() - this.time;
		if (message) {
			spentTime = Math.round(spentTime);
			console.log(spentTime + "ms", message);
		}
	}

	/**
	 * @return CandidateCollection
	 */
	static getInstance() {
		if (!this.instance) {
			this.instance = new SimpleProfiler();

		}
		return this.instance;
	}
}