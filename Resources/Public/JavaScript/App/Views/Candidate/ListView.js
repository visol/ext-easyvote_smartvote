/*jshint esnext:true */
import CandidateCollection from '../../Collections/CandidateCollection'
import CandidateView from './CandidateView'
import QuestionCollection from '../../Collections/QuestionCollection'

/*
 * This file is part of the TYPO3 CMS project.
 *
 * See LICENSE.txt that was shipped with this package.
 */

export default class ListView extends Backbone.View {

	/**
	 * Constructor
	 *
	 * @param options
	 */
	constructor(options) {

		this.facetView = options.facet;

		// Instead of generating a new element, bind to the existing skeleton of
		// the App already present in the HTML.
		this.setElement($('#container-candidates'), true);

		// Contains the "number of candidates" and button to reset the filter.
		this.beforeStartingTemplate = _.template($('#template-before-starting').html());

		// Contains the "number of candidates" and button to reset the filter.
		this.listTopTemplate = _.template($('#template-candidates-top').html());

		/** @var candidateCollection CandidateCollection*/
		var candidateCollection = CandidateCollection.getInstance();
		this.questionCollection = QuestionCollection.getInstance();

		// Important: define listener before fetching data.
		this.listenTo(candidateCollection, 'sort', this.render);
		this.listenTo(Backbone, 'facet:changed', this.render, this);

		_.bindAll(this, 'changeFacetView');
		_.bindAll(this, 'sortAndRender');
		$(document).on('click', '#btn-show-login', this.showLoginBox);
		$(document).on('change', '#container-before-starting .form-control', this.changeFacetView);
		$(document).on('change', '#btn-sorting', this.sortAndRender);

		// Load first the Question collection.
		/** @var questionCollection QuestionCollection */
		this.questionCollection.load().done(() => {

			candidateCollection.fetch(); // will trigger the rendering.

			// Fetch candidates.
			//candidateCollection.fetch().done(() => {
				//candidateCollection.sort(); // will trigger the rendering.
			//});
		});

		// Call parent constructor.
		super();
	}

	/**
	 * Render the view.
	 */
	render() {

		if (this.questionCollection.hasAnsweredQuestions() && this.facetView.hasMinimumFilter()) {

			var filteredCandidates = CandidateCollection.getInstance().getFilteredCandidates();

			// Render intermediate content in a temporary DOM.
			var container = document.createDocumentFragment();
			for (let candidate of filteredCandidates) {
				let content = this.renderOne(candidate);
				container.appendChild(content);
			}

			// Finally update the DOM.
			$('#container-candidate-list').html(container);

			// Add lazy loading to images.
			$("img.lazy", $('#container-candidate-list')).lazyload();

			// Update top list content.
			let content = this.listTopTemplate({
				numberOfItems: filteredCandidates.length,
				sorting: CandidateCollection.getInstance().getSorting(),
				direction: CandidateCollection.getInstance().getDirection()
			});
			$('#container-candidates-top').html(content);
			$('#wrapper-candidates').removeClass('hidden');
			$('#wrapper-filter').removeClass('hidden');
			$('#container-before-starting').addClass('hidden');
		} else {

			// User must pick some option
			let content = this.beforeStartingTemplate({
				isLinkToQuestionnaire: !this.questionCollection.hasAnsweredQuestions(),
				isFormDefaultFilter: !this.facetView.hasMinimumFilter(),
				isLinkToAuthentication: !this.isAuthenticated()
			});

			$('#wrapper-candidates').addClass('hidden');
			$('#wrapper-filter').addClass('hidden');
			$('#container-before-starting').html(content).removeClass('hidden');
		}
	}

	/**
	 * update facet view.
	 */
	sortAndRender(e) {
		var candidateCollection = CandidateCollection.getInstance();

		var parameters = $(e.target).val().split('&');
		if (parameters.length == 2) {

			let sorting = parameters[0];
			let direction = parameters[1];
			candidateCollection.setSorting(sorting);
			candidateCollection.setDirection(direction);
			candidateCollection.sort(); // trigger rendering
		}
	}


	/**
	 * update facet view.
	 */
	changeFacetView(e) {
		let name = $(e.target).attr('name');
		let value = $(e.target).val();
		this.facetView.model.set(name, value);
		this.facetView.save();
	}

	/**
	 * Display the login box
	 */
	showLoginBox() {
		$('.login-link').trigger('click');
		return false; // prevent default behaviour.
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
	isAuthenticated() {
		return EasyvoteSmartvote.isUserAuthenticated
	}

}
