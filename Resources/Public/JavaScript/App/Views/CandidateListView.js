/*jshint esnext:true */
import CandidateCollection from '../Collections/CandidateCollection'
import CandidateView from './CandidateView'
import SpiderChartPlotter from '../Chart/SpiderChartPlotter'

/*
 * This file is part of the TYPO3 CMS project.
 *
 * See LICENSE.txt that was shipped with this package.
 */

export default class CandidateListView extends Backbone.View {

	constructor() {

		// Instead of generating a new element, bind to the existing skeleton of
		// the App already present in the HTML.
		this.setElement($('#container-candidates'), true);

		/** @var candidateCollection CandidateCollection*/
		let candidateCollection = CandidateCollection.getInstance();

		this.listenTo(candidateCollection, 'add', this.addOne);
		this.listenTo(candidateCollection, 'all', this.render);

		if (this._isAnonymous()) {
			candidateCollection.fetchForAnonymousUser();
		} else {
			candidateCollection.fetchForAuthenticatedUser();
		}
		super();
	}

	/**
	 * Render the main template.
	 */
	render() {

		//this.$progress.html(
		//	this.progressTemplate({
		//		progress: this.getProgress(),
		//		numberOfCandidateAnswered: CandidateCollection.getInstance().countVisible(),
		//		totalNumberOfCandidates: CandidateCollection.getInstance().count()
		//	})
		//);
	}

	/**
	 * @param argument
	 */
	//changeAnswer(argument) {
	//	let question = argument.attributes;
	//
	//	this.updateChart(question);
	//
	//	let candidateCollection = CandidateCollection.getInstance();
	//	let nextIndex = (candidateCollection.length - 1) - question.index;
	//	let nextCandidate = candidateCollection.at(nextIndex);
	//	nextCandidate.trigger('visible');
	//}

	/**
	 * Add a single question item to the list by creating a view for it, then
	 * appending its element to the `<div>`.
	 * @param model
	 */
	addOne(model) {
		let view = new CandidateView({model});
		let content = view.render();
		$('#container-candidate-list').append(content);

		let values = model.attributes.spiderChart;
		if (values.length > 0) {
			this.drawChart(model.attributes.uid, values);
		}
	}

	/**
	 * @param {int} candidateId
	 * @param {array} values
	 * @return {bool}
	 * @private
	 */
	drawChart(candidateId, values) {

		let data = [
			//                                                                                     cleavage* - position in circle
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

	/**
	 * @return {bool}
	 * @private
	 */
	_isAnonymous() {
		return !EasyvoteSmartvote.isUserAuthenticated
	}
}