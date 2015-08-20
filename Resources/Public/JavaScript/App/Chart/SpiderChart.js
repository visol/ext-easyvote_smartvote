/*jshint esnext:true */
import SpiderChartPlotter from './SpiderChartPlotter'

/*
 * This file is part of the TYPO3 CMS project.
 *
 * See LICENSE.txt that was shipped with this package.
 */

export default class SpiderChart {

	/**
	 * Constructor
	 */
	constructor() {
		this.cleavage1 = [];
		this.cleavage2 = [];
		this.cleavage3 = [];
		this.cleavage4 = [];
		this.cleavage5 = [];
		this.cleavage6 = [];
		this.cleavage7 = [];
		this.cleavage8 = [];

		this.totalCleavage1 = EasyvoteSmartvote.totalCleavage1;
		this.totalCleavage2 = EasyvoteSmartvote.totalCleavage2;
		this.totalCleavage3 = EasyvoteSmartvote.totalCleavage3;
		this.totalCleavage4 = EasyvoteSmartvote.totalCleavage4;
		this.totalCleavage5 = EasyvoteSmartvote.totalCleavage5;
		this.totalCleavage6 = EasyvoteSmartvote.totalCleavage6;
		this.totalCleavage7 = EasyvoteSmartvote.totalCleavage7;
		this.totalCleavage8 = EasyvoteSmartvote.totalCleavage8;

		// Start the local storage
		this.localStorage = new Backbone.LocalStorage('spider-chart-' + EasyvoteSmartvote.token);
	}

	/**
	 * @param {int} polarity
	 * @param {int} questionId
	 * @param {int} value
	 * @return Chart
	 */
	addToCleavage1(questionId, value, polarity) {
		value = this.resolveValue(value, polarity);
		this.cleavage1[questionId] = value;
		return this;
	}

	/**
	 * @param {int} polarity
	 * @param {int} questionId
	 * @param {int} value
	 * @return Chart
	 */
	addToCleavage2(questionId, value, polarity) {
		value = this.resolveValue(value, polarity);
		this.cleavage2[questionId] = value;
		return this;
	}

	/**
	 * @param {int} polarity
	 * @param {int} questionId
	 * @param {int} value
	 * @return Chart
	 */
	addToCleavage3(questionId, value, polarity) {
		value = this.resolveValue(value, polarity);
		this.cleavage3[questionId] = value;
		return this;
	}

	/**
	 * @param {int} polarity
	 * @param {int} questionId
	 * @param {int} value
	 * @return Chart
	 */
	addToCleavage4(questionId, value, polarity) {
		value = this.resolveValue(value, polarity);
		this.cleavage4[questionId] = value;
		return this;
	}

	/**
	 * @param {int} polarity
	 * @param {int} questionId
	 * @param {int} value
	 * @return Chart
	 */
	addToCleavage5(questionId, value, polarity) {
		value = this.resolveValue(value, polarity);
		this.cleavage5[questionId] = value;
		return this;
	}

	/**
	 * @param {int} polarity
	 * @param {int} questionId
	 * @param {int} value
	 * @return Chart
	 */
	addToCleavage6(questionId, value, polarity) {
		value = this.resolveValue(value, polarity);
		this.cleavage6[questionId] = value;
		return this;
	}

	/**
	 * @param {int} polarity
	 * @param {int} questionId
	 * @param {int} value
	 * @return Chart
	 */
	addToCleavage7(questionId, value, polarity) {
		value = this.resolveValue(value, polarity);
		this.cleavage7[questionId] = value;
		return this;
	}

	/**
	 * @param {int} polarity
	 * @param {int} questionId
	 * @param {int} value
	 * @return Chart
	 */
	addToCleavage8(questionId, value, polarity) {
		value = this.resolveValue(value, polarity);
		this.cleavage8[questionId] = value;
		return this;
	}

	/**
	 * @param {int} polarity
	 * @param {int} value
	 * @return int
	 */
	resolveValue(value, polarity) {
		if (value === -1) {
			value = 0;
		} else {

			value = value * polarity;
			if (polarity < 0) {
				value = 100 + value;
			}
		}

		return value;
	}

	/**
	 * Loop around the cleavage 1 and increment value to be returned.
	 *
	 * @return int
	 */
	computeValueForCleavage1() {
		var value = 0;
		this.cleavage1.map(v => value = value + v);
		return value;
	}

	/**
	 * @return int
	 */
	computeValueForCleavage2() {
		var value = 0;
		this.cleavage2.map(v => value = value + v);
		return value;
	}

	/**
	 * @return int
	 */
	computeValueForCleavage3() {
		var value = 0;
		this.cleavage3.map(v => value = value + v);
		return value;
	}

	/**
	 * @return int
	 */
	computeValueForCleavage4() {
		var value = 0;
		this.cleavage4.map(v => value = value + v);
		return value;
	}

	/**
	 * @return int
	 */
	computeValueForCleavage5() {
		var value = 0;
		this.cleavage5.map(v => value = value + v);
		return value;
	}

	/**
	 * @return int
	 */
	computeValueForCleavage6() {
		var value = 0;
		this.cleavage6.map(v => value = value + v);
		return value;
	}

	/**
	 * @return int
	 */
	computeValueForCleavage7() {
		var value = 0;
		this.cleavage7.map(v => value = value + v);
		return value;
	}

	/**
	 * @return int
	 */
	computeValueForCleavage8() {
		var value = 0;
		this.cleavage8.map(v => value = value + v);
		return value;
	}

	/**
	 * Draw the Spider Chart.
	 */
	draw() {
		let data = [
			//                                                                                                             cleavage* - position in circle
			{value: this.computeValueForCleavage1() / (EasyvoteSmartvote.totalCleavage1 * 100)}, // Offene Aussenpolitik           1 - 1
			{value: this.computeValueForCleavage8() / (EasyvoteSmartvote.totalCleavage8 * 100)}, // Liberale Gesellschaft          8 - 2
			{value: this.computeValueForCleavage7() / (EasyvoteSmartvote.totalCleavage7 * 100)}, // Ausgebauter Sozialstaat        7 - 3
			{value: this.computeValueForCleavage6() / (EasyvoteSmartvote.totalCleavage6 * 100)}, // Ausgebauter Umweltschutz       6 - 4
			{value: this.computeValueForCleavage5() / (EasyvoteSmartvote.totalCleavage5 * 100)}, // Restrictive Migrationspolitik  5 - 5
			{value: this.computeValueForCleavage4() / (EasyvoteSmartvote.totalCleavage4 * 100)}, // Law & Order                    4 - 6
			{value: this.computeValueForCleavage3() / (EasyvoteSmartvote.totalCleavage3 * 100)}, // Restrictive Finanzpolitik      3 - 7
			{value: this.computeValueForCleavage2() / (EasyvoteSmartvote.totalCleavage2 * 100)}  // Liberale Wirtschaftspolitik    2 - 8
		];

		// Save the data to be used in the view candidate.
		this.localStorage.localStorage().setItem('data', JSON.stringify(data));

		SpiderChartPlotter.plot(
			"#chart",
			[data],
			{
				w: 240,
				h: 240,
				levels: 5,
				maxValue: 1,
				color: '#E5005E'
			}
		);
	}

	/**
	 * @return Chart
	 */
	static getInstance() {
		if (!this.instance) {
			this.instance = new SpiderChart();
		}
		return this.instance;
	}

}