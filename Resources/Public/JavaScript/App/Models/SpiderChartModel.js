/*jshint esnext:true */

/*
 * This file is part of the TYPO3 CMS project.
 *
 * See LICENSE.txt that was shipped with this package.
 */

export default class SpiderChartModel extends Backbone.Model {

	/**
	 * Define some default attributes for this model.
	 *
	 * @returns {{progress: number}}
	 */
	defaults() {

		return {
			progress: 0
		};
	}
}
