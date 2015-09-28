/*jshint esnext:true */
import SpiderChartPlotter from '../../Chart/SpiderChartPlotter'
import SpiderChart from '../../Chart/SpiderChart'
import QuestionCollection from '../../Collections/QuestionCollection'

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

		let serie = [
			//                                                         cleavage# - position in chart
			{value: values[0].value * 0.01}, // Offene Aussenpolitik           1 - 1
			{value: values[7].value * 0.01}, // Liberale Gesellschaft          8 - 2
			{value: values[6].value * 0.01}, // Ausgebauter Sozialstaat        7 - 3
			{value: values[5].value * 0.01}, // Ausgebauter Umweltschutz       6 - 4
			{value: values[4].value * 0.01}, // Restriktive Migrationspolitik  5 - 5
			{value: values[3].value * 0.01}, // Law & Order                    4 - 6
			{value: values[2].value * 0.01}, // Restriktive Finanzpolitik      3 - 7
			{value: values[1].value * 0.01}  // Liberale Wirtschaftspolitik    2 - 8
		];


		// Compute serie of the User.
		var userSerie = this.getUserSerie();

		// Only if userSerie has relevant values, register the serie to be displayed on the chart.
		var userSeries = [];
		if (this.hasValidPoints(userSerie)) {
			userSeries = [userSerie];
		}

		SpiderChartPlotter.plot(
			'#chart-candidate-' + candidateId,
			[serie],
			{
				w: 240,
				h: 240,
				levels: 5,
				maxValue: 1
			},
			userSeries
		);
	}

	/**
	 * @returns {Array}
	 */
	getUserSerie() {

		var userSerie = [];
		var isShortVersion = true;

		// Get a possible value from the localStorage.
		if (localStorage.getItem('questionnaireVersionLength')) {
			if (localStorage.getItem('questionnaireVersionLength') === 'long') {
				isShortVersion = false;
			}
		}

		QuestionCollection.getInstance().forEach(question => {
			if (typeof question.get('answer') === 'number') {
				userSerie = SpiderChart.getInstance(isShortVersion)
					.addToCleavage1(question.id, question.get('answer'), question.get('cleavage1'))
					.addToCleavage2(question.id, question.get('answer'), question.get('cleavage2'))
					.addToCleavage3(question.id, question.get('answer'), question.get('cleavage3'))
					.addToCleavage4(question.id, question.get('answer'), question.get('cleavage4'))
					.addToCleavage5(question.id, question.get('answer'), question.get('cleavage5'))
					.addToCleavage6(question.id, question.get('answer'), question.get('cleavage6'))
					.addToCleavage7(question.id, question.get('answer'), question.get('cleavage7'))
					.addToCleavage8(question.id, question.get('answer'), question.get('cleavage8'))
					.getSerie();
			}
		});

		return userSerie;
	}

	/**
	 * Tell whether the serie has points to be displayed on the chart.
	 *
	 * @param {Array} serie
	 * @returns {boolean}
	 */
	hasValidPoints(serie) {
		var hasValidPoints = false;
		for (var point of serie) {
			if (serie.value > 0) {
				hasValidPoints = true;
				break;
			}
		}

		return true;
	}

	/**
	 * Compute the token.
	 *
	 * @returns {string}
	 */
	getToken() {
		var token = EasyvoteSmartvote.token;
		if (EasyvoteSmartvote.relatedToken) {
			token = EasyvoteSmartvote.relatedToken;
		}
		return token;
	}

}
