/*jshint esnext:true */
import SpiderChartPlotter from '../../Chart/SpiderChartPlotter'

/*
 * This file is part of the TYPO3 CMS project.
 *
 * See LICENSE.txt that was shipped with this package.
 */

export default class CandidateView extends Backbone.View {

	/**
	 * @param options
	 */
	constructor(options) {

		// *... is a list tag.*
		this.tagName = 'div';

		// *Cache the template function for a single item.*
		this.template = _.template($('#template-candidate').html());

		// *Define the DOM events specific to an item.*
		this.events = {
			'click .toggle': 'renderChart'
		};

		super(options);
	}

	/**
	 * Render the candidate view.
	 *
	 * @returns string
	 */
	renderChart() {

		// Lazy rendering of the Chart.
		if (!$('#chart-candidate-' + this.model.id).has('svg').length) {
			var values = this.model.get('spiderChart');
			if (values.length > 0) {
				this.drawChart(this.model.id, values);
			}
		}
	}

	/**
	 * Render the candidate view.
	 *
	 * @returns string
	 */
	render() {
		let content = this.template(this.model.toJSON());
		this.$el.html(content);
		return this.el;
	}

	/**
	 * @param {int} candidateId
	 * @param {array} values
	 * @return {bool}
	 * @private
	 */
	drawChart(candidateId, values) {

		let data = [
			//                                                         cleavage# - position in chart
			{value: values[0].value * 0.01}, // Offene Aussenpolitik           1 - 1
			{value: values[7].value * 0.01}, // Liberale Gesellschaft          8 - 2
			{value: values[6].value * 0.01}, // Ausgebauter Sozialstaat        7 - 3
			{value: values[5].value * 0.01}, // Ausgebauter Umweltschutz       6 - 4
			{value: values[4].value * 0.01}, // Restrictive Migrationspolitik  5 - 5
			{value: values[3].value * 0.01}, // Law & Order                    4 - 6
			{value: values[2].value * 0.01}, // Restrictive Finanzpolitik      3 - 7
			{value: values[1].value * 0.01}  // Liberale Wirtschaftspolitik    2 - 8
		];

		SpiderChartPlotter.plot(
			'#chart-candidate-' + candidateId,
			[data],
			{
				w: 240,
				h: 240,
				levels: 5,
				maxValue: 1
			}
		);
	}
}
