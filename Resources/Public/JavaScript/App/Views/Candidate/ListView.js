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

		// Contains a form to pre-select political parties
		this.beforeStartingTemplate = _.template($('#template-before-starting').html());

		// Contains the number of candidates and button to reset the filter.
		this.listTopTemplate = _.template($('#template-candidates-top').html());

		/** @var candidateCollection CandidateCollection*/
		this.candidateCollection = CandidateCollection.getInstance();
		this.questionCollection = QuestionCollection.getInstance();
		this.district = 0;
		this.party = 0;
		this.persona = 0;
		this.elected = 0;
		this.deselected = 0;
		this.numberOfRenderedItems = 0;
		this.isRendering = false;
		this.isSortedBy = null;

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
		this.questionCollection.load().done(() => {

			this.overlayWithQuestionState();
			this.render();

			// Update number of questions on the page.
			var numberOfQuestionsLongVersion = this.questionCollection.count();
			var numberOfQuestionsShortVersion = this.questionCollection.count(true);
			if (numberOfQuestionsLongVersion === numberOfQuestionsShortVersion) {
				$('#short-version-number-questions').html(numberOfQuestionsShortVersion);
				$('.btn-long-version').hide(); // hide button for long version.
			} else {
				$('#long-version-number-questions').html(numberOfQuestionsLongVersion);
				$('#short-version-number-questions').html(numberOfQuestionsShortVersion);
			}
		});

		// Call parent constructor.
		super();
	}

	/**
	 * Overlay possible questions with question state coming from the User Profile.
	 *
	 * @return void
	 */
	overlayWithQuestionState() {

		// Overlay possible questions with question state
		for (var questionState of EasyvoteSmartvote.questionState) {

			let question = this.questionCollection.get(questionState['id']);
			question.set('answer', questionState['answer']);
			question.set('visible', questionState['visible']);
		}
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
		for (var candidate of filteredCandidates) {
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

		// Render votable widget if available.
		if ($().votable) {
			var options = window.Votable || {};

			// Add custom handler.
			options.whenUserIsLoggedOff = function(e) {
				e.preventDefault();
				$('.login-link').trigger('click');
			};

			// Add custom handler.
			options.afterVoteChange = function(e, addOrRemove) {
				e.preventDefault();

				var numberOfVotes = 1; // initialize variable
				var $votesContainer = $(e.target).closest('.content-box').find('.votes-count');

				if ($votesContainer.find('.number-of-votes').length > 0) {
					let numberOfVotesValue = $votesContainer.find('.number-of-votes').html();
					numberOfVotes = parseInt(numberOfVotesValue);

					if (addOrRemove === 'add') {
						numberOfVotes++;
					} else {
						numberOfVotes--;
					}

					$votesContainer.find('.number-of-votes').html(numberOfVotes);
				}

				if (numberOfVotes > 1) {
					let content = '<strong class="number-of-votes">' + numberOfVotes + '</strong> ' + EasyvoteSmartvote.labelVotes;
					$votesContainer.html(content);
				} else if (numberOfVotes > 0) {
					let content = '<strong class="number-of-votes">' + numberOfVotes + '</strong> ' + EasyvoteSmartvote.labelVote;
					$votesContainer.html(content);
				} else {
					$votesContainer.html(''); // empty content as we don't have any votes to display
				}
			};
			$('.widget-votable').votable(options);
		}

		// Bind tooltips for candidate badges.
		Easyvote.bindToolTips();

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
			totalNumberOfCandidates: this.candidateCollection.size(),
			numberOfCandidates: this.candidateCollection.getFilteredCandidates().length,
			sorting: CandidateCollection.getInstance().getSorting(),
			direction: CandidateCollection.getInstance().getDirection()
		});

		$('#container-candidates-top').html(content);
		$('#wrapper-candidates').removeClass('hidden');
		$('#wrapper-filter').removeClass('hidden');

		if (!this.isScopeExecutive() || this.questionCollection.countAnsweredQuestions() !== 0) {
			$('#container-before-starting').addClass('hidden');
		}

		this.isRendering = false;
		$('#container-candidates-loading').hide();

		if (this.questionCollection.hasCompletedAnswers() === false) {
			$('#btn-sorting option[value="matching&descending"]').remove();
			$('#btn-sorting option[value="matching&ascending"]').remove();
		}
	}

	/**
	 * Render the view.
	 */
	render() {

		var displayElected = $('.evsv-displayElected').length > 0;
		var displayDeselected = $('.evsv-displayDeselected').length > 0;

		if ((this.facetView.hasMinimumFilter() || this.isScopeExecutive()) && !displayElected && !displayDeselected) {

			// Only fetch chunk of data if necessary
			if (this.district != this.facetView.model.get('district') ||
				this.party != this.facetView.model.get('party') ||
				this.elected != this.facetView.model.get('elected') ||
				this.deselected != this.facetView.model.get('deselected') ||
				this.persona != this.facetView.model.get('persona') ||
				this.isScopeExecutive()) { // We want to filter executive candidates in any case.

				this.district = this.facetView.model.get('district');
				this.party = this.facetView.model.get('party');
				this.persona = this.facetView.model.get('persona');
				this.elected = this.facetView.model.get('elected');
				this.deselected = this.facetView.model.get('deselected');

				let filter = {
					district: this.district,
					party: this.party,
					persona: this.persona,
					elected: this.elected,
					deselected: this.deselected
				};

				this.candidateCollection.fetch(filter).done(candidates => {
					$('#container-candidate-list').html(''); // empty list
					this.numberOfRenderedItems = 0;
					this.renderList();
				});

				if (this.questionCollection.countAnsweredQuestions() === 0) {

					// User must pick some option
					let content = this.beforeStartingTemplate({
						isLinkToQuestionnaire: !this.questionCollection.hasAnsweredQuestions(),
						isFormDefaultFilter: !this.facetView.hasMinimumFilter(),
						isLinkToAuthentication: !this.isAuthenticated()
					});

					$('#container-before-starting').html(content).removeClass('hidden');
				}
			} else {
				$('#container-candidate-list').html(''); // empty list
				this.numberOfRenderedItems = 0;
				this.renderList();
			}

		} else if (displayElected) {
			// preset filter for elected candidates
			this.district = this.facetView.model.get('district');
			this.party = this.facetView.model.get('party');
			this.persona = this.facetView.model.get('persona');
			this.elected = this.facetView.model.get('elected');
			this.deselected = this.facetView.model.get('deselected');

			$('#elected').val(1);

			let filter = {
				district: this.district,
				party: this.party,
				persona: this.persona,
				elected: 1,
				deselected: this.deselected
			};

			this.candidateCollection.fetch(filter).done(candidates => {
				$('#container-candidate-list').html(''); // empty list
				this.numberOfRenderedItems = 0;
				this.renderList();
			});

		}  else if (displayDeselected) {
			// preset filter for deselected candidates
			this.district = this.facetView.model.get('district');
			this.party = this.facetView.model.get('party');
			this.persona = this.facetView.model.get('persona');
			this.elected = this.facetView.model.get('elected');
			this.deselected = this.facetView.model.get('deselected');

			$('#deselected').val(1);

			let filter = {
				district: this.district,
				party: this.party,
				persona: this.persona,
				elected: this.elected,
				deselected: 1
			};

			this.candidateCollection.fetch(filter).done(candidates => {
				$('#container-candidate-list').html(''); // empty list
				this.numberOfRenderedItems = 0;
				this.renderList();
			});

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

			// Store sorting
			this.isSortedBy = sorting;

			// Reset list
			$('#container-candidate-list').html('');
			this.numberOfRenderedItems = 0;

			candidateCollection.sort(); // trigger rendering
		}
	}

	/**
	 * Tell whether the scope of the election is executive and we can further proceed.
	 */
	isScopeExecutive() {
		return EasyvoteSmartvote.currentElectionScope === 2;
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
		return view.render(this.isSortedBy);
	}

	/**
	 * @return {bool}
	 * @private
	 */
	isAuthenticated() {
		return EasyvoteSmartvote.isUserAuthenticated
	}

}
