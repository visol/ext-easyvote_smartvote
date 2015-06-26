/*jshint esnext:true */
import CandidateCollection from '../Collections/CandidateCollection'
import CandidateView from './CandidateView'

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
	 * @returns {number}
	 */
	//getProgress() {
	//
	//	let candidateCollection = CandidateCollection.getInstance();
	//
	//	let progress = 0; // default
	//	if (candidateCollection.count() > 1) {
	//		progress = candidateCollection.countVisible() / candidateCollection.count() * 100;
	//	}
	//	return progress;
	//}

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
		let content = new CandidateView({model}).render();
		$('#container-candidate-list').append(content);
	}

	/**
	 * @return {bool}
	 * @private
	 */
	_isAnonymous() {
		return !EasyvoteSmartvote.isUserAuthenticated
	}
}
