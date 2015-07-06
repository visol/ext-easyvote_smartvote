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

	/**
	 * Constructor
	 *
	 * @param options
	 */
	constructor(options) {

		// Instead of generating a new element, bind to the existing skeleton of
		// the App already present in the HTML.
		this.setElement($('#container-candidates'), true);

		// Contains the "number of candidates" and button to reset the filter.
		this.listTopTemplate = _.template($('#template-candidates-top').html());

		/** @var candidateCollection CandidateCollection*/
		var candidateCollection = CandidateCollection.getInstance();

		// Load first the Question collection.
		/** @var questionCollection QuestionCollection*/
		QuestionCollection.getInstance().load().done(() => {

			// Fetch data
			candidateCollection.fetch().done(() => {
				console.log('candidateCollection');
			});
			
		});

		// Important: define listener before fetching data.
		this.listenTo(candidateCollection, 'sort reset', this.render);
		this.listenTo(Backbone, 'facet:changed', this.render, this);


		// Call parent constructor.
		super();
	}

	/**
	 * Render the view.
	 */
	render() {

		let filteredCandidates = CandidateCollection.getInstance().getFilteredCandidates();

		// Render intermediate content in a temporary DOM.
		let container = document.createDocumentFragment();
		for (let candidate of filteredCandidates) {
			let content = this.renderOne(candidate);
			container.appendChild(content);
		}

		// Finally update the DOM.
		$('#container-candidate-list').empty().append(container);

		// Add lazy loading to images.
		$("img.lazy", $('#container-candidate-list')).lazyload();

		// Update top list content
		let content = this.listTopTemplate({
			numberOfItems: filteredCandidates.length
		});
		$('#container-candidates-top').html(content);
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
	renderOne(model) {
		let view = new CandidateView({model});
		return view.render();
	}

	/**
	 * @return {bool}
	 * @private
	 */
	_isAnonymous() {
		return !EasyvoteSmartvote.isUserAuthenticated
	}

}
