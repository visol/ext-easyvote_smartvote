/*jshint esnext:true */
import CandidateCollection from '../Collections/CandidateCollection'
import CandidateView from './CandidateView'
import QuestionCollection from '../Collections/QuestionCollection'
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

		// Load first the Question collection.
		/** @var questionCollection QuestionCollection*/
		//QuestionCollection.getInstance().load();

		/** @var candidateCollection CandidateCollection*/
		let candidateCollection = CandidateCollection.getInstance();

		//this.listenTo(candidateCollection, 'add', this.addOne);
		//this.listenTo(candidateCollection, 'all', this.render);
		this.listenTo(candidateCollection, 'sort reset', this.render);

		candidateCollection.fetch();

		// Call parent constructor
		super();
	}

	/**
	 * Render template.
	 */
	render(candidates) {
		candidates.each(candidate => {
			this.addOne(candidate);
		});
	}

	/**
	 * @param argument
	 */
	changeAnswer(argument) {
		let candidate = argument.attributes;

		this.updateChart(candidate);

		let candidateCollection = CandidateCollection.getInstance();
		let nextIndex = (candidateCollection.length - 1) - candidate.index;
		let nextCandidate = candidateCollection.at(nextIndex);
		nextCandidate.trigger('visible');
	}

	/**
	 * Add a single candidate item to the list by creating a view for it, then
	 * appending its element to the `<div>`.
	 * @param model
	 */
	addOne(model) {
		let view = new CandidateView({model});
		let content = view.render();
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
