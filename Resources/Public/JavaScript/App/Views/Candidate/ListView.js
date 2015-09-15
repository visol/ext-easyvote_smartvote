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
		this.candidateCollection = CandidateCollection.getInstance();
		this.questionCollection = QuestionCollection.getInstance();
		this.district = 0;
		this.nationalParty = 0;
		this.numberOfRenderedItems = 0;
		this.isRendering = false;

		// Important: define listener before fetching data.
		this.listenTo(this.candidateCollection, 'sort', this.renderList);
		this.listenTo(Backbone, 'facet:changed', this.render, this);

		_.bindAll(this, 'changeFacetView');
		_.bindAll(this, 'sortAndRender');
		_.bindAll(this, 'renderAsYouScroll');
		$(document).on('click', '#btn-show-login', this.showLoginBox);
		$(document).on('click', '#link-show-registration', this.showRegistrationBox);
		$(document).on('change', '#container-before-starting .form-control', this.changeFacetView);
		$(document).on('change', '#btn-sorting', this.sortAndRender);
		$(window).on('scroll', '', this.renderAsYouScroll);

		// Load first the Question collection.
		/** @var questionCollection QuestionCollection */
		this.questionCollection.load().done(() => this.render());

		// Call parent constructor.
		super();
	}

	/**
	 * Properly render the list.
	 */
	renderAsYouScroll() {

		var footerSize = 500;
		if (!this.isRendering
			&& this.numberOfRenderedItems < this.candidateCollection.size()
			&& $(window).scrollTop() >= $(document).height() - $(window).height() - footerSize) {

			$('#container-candidates-loading').show();

			// display loading message while rendering
			this.renderList();
		}
	}

	/**
	 * Return the parts of data to be rendered.
	 */
	getCandidatesWithBoundary(offsetLeft, numberOfItemsByBatch) {
		let candidates = this.candidateCollection.getFilteredCandidates();

		var offsetRight = offsetLeft + numberOfItemsByBatch;
		return candidates.slice(offsetLeft, offsetRight);
	}

	/**
	 * Properly render the list.
	 */
	renderList() {
		this.isRendering = true;
		var numberOfItemsByBatch = 10;

		var filteredCandidates = this.getCandidatesWithBoundary(this.numberOfRenderedItems, numberOfItemsByBatch);

		// Render intermediate content in a temporary DOM.
		var container = document.createDocumentFragment();
		var box = container.appendChild(document.createElement('div'));
		box.className = 'batch-' + this.numberOfRenderedItems;
		for (let candidate of filteredCandidates) {
			let content = this.renderOne(candidate);
			box.appendChild(content);

			// handle counters
			this.numberOfRenderedItems++;
			numberOfItemsByBatch--;

			if (numberOfItemsByBatch <= 0) {
				break;
			}
		}

		// Finally update the DOM.
		var $containerCandidateList = $('#container-candidate-list');
		$containerCandidateList.append(container);

		// Add lazy loading to images.
		$("img.lazy", $('.batch-' + this.numberOfRenderedItems)).lazyload();

		// Bind fancybox
		$('body').on('click', '.fancybox', function(event) {
			event.preventDefault();
			$.fancybox({
				'href': this.href,
				'title': this.title
			});
		});

		// Update top list content.
		let content = this.listTopTemplate({
			numberOfItems: this.candidateCollection.size(),
			sorting: CandidateCollection.getInstance().getSorting(),
			direction: CandidateCollection.getInstance().getDirection()
		});
		$('#container-candidates-top').html(content);
		$('#wrapper-candidates').removeClass('hidden');
		$('#wrapper-filter').removeClass('hidden');
		$('#container-before-starting').addClass('hidden');

		this.isRendering = false;
		$('#container-candidates-loading').hide();
	}

	/**
	 * Render the view.
	 */
	render() {

		if (this.facetView.hasMinimumFilter()) {

			// Only fetch chunk of data if necessary
			if (this.district != this.facetView.model.get('district') ||
				this.nationalParty != this.facetView.model.get('nationalParty')) {

				this.district = this.facetView.model.get('district');
				this.nationalParty = this.facetView.model.get('nationalParty');

				let filter = {
					district: this.district,
					nationalParty: this.nationalParty
				};

				this.candidateCollection.fetch(filter).done(candidates => {
					$('#container-candidate-list').html(''); // empty list
					this.numberOfRenderedItems = 0;
					this.renderList();
				});
			} else {
				this.renderList();
			}

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

			// Reset list
			$('#container-candidate-list').html('');
			this.numberOfRenderedItems = 0;

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
	 * Display the registraton box
	 */
	showRegistrationBox() {
		$('.register-link').trigger('click');
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
