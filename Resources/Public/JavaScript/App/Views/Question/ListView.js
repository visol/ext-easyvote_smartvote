/*jshint esnext:true */
import QuestionCollection from '../../Collections/QuestionCollection'
import CandidateCollection from '../../Collections/CandidateCollection'
import QuestionView from './QuestionView'
import SpiderChart from '../../Chart/SpiderChart'

/*
 * This file is part of the TYPO3 CMS project.
 *
 * See LICENSE.txt that was shipped with this package.
 */

export default class ListView extends Backbone.View {

	constructor() {

		// Instead of generating a new element, bind to the existing skeleton of
		// the App already present in the HTML.
		this.setElement($('#container-questions'), true);

		// Progress bar template.
		this.progressTemplate = _.template($('#template-progress').html());
		this.$progress = this.$('#container-progress');

		this.questionCollection = QuestionCollection.getInstance();

		// Store the flag whether it is a short or long version of the questionnaire.
		this.isShortVersion = this.isShortQuestionnaire();
		this.updateButtonStatusShortAndLongVersion();

		// Special binding since the reset button is outside the scope of this view.
		_.bindAll(this, 'showShortVersion');
		_.bindAll(this, 'showLongVersion');
		$(document).on('click', '#btn-short-version', this.showShortVersion);
		$(document).on('click', '#btn-long-version', this.showLongVersion);


		// Render after loading the data-set.
		this.questionCollection.load().done(() => {

			// Count number of answers from localStorage
			var numberOfAnswersFromLocalStorage = this.questionCollection.countAnsweredQuestions();

			// Count number of answers from profile
			var numberOfAnswersFromProfile = this.questionCollection.countAnsweredQuestionsFromProfile();

			// Save profile if more answers in localStorage
			if (numberOfAnswersFromLocalStorage > numberOfAnswersFromProfile) {
				if (EasyvoteSmartvote.isUserAuthenticated) {
					this.persistQuestionState();
				}
			} else {
				this.overlayWithQuestionState();
			}

			this.render();

			// Finally add listener ... and not before because it will be triggered by method this.overlayWithQuestionState()
			this.listenTo(this.questionCollection, 'change:answer', this.afterAnswerChanged);
		});

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
	 * Adjust widget
	 */
	updateButtonStatusShortAndLongVersion() {
		// short version button could might be hidden... force it to be shown it in any case.
		$('#btn-short-version').show();

		if (this.isShortVersion) {
			$('#btn-short-version').addClass('disabled');
			$('#btn-long-version').removeClass('disabled');
		} else {
			$('#btn-short-version').removeClass('disabled');
			$('#btn-long-version').addClass('disabled');
		}
	}

	/**
	 * Render the main template.
	 */
	showShortVersion(e) {

		// Toggle property.
		this.isShortVersion = true;

		// Toggle property.
		this.updateButtonStatusShortAndLongVersion();
		//this.linkToDirectoriesIfAllQuestionsAnswered();

		// Update the view.
		this.render();
	}

	/**
	 * Render the main template.
	 */
	showLongVersion(e) {

		// Toggle property.
		this.isShortVersion = false;
		this.updateButtonStatusShortAndLongVersion();
		this.linkToDirectoriesIfAllQuestionsAnswered();

		// Update the view.
		this.render();
	}

	/**
	 * Render the main template.
	 */
	render() {

		// Update the progressbar view first which is the quickest in term of DOM.
		this.renderProgressBar();

		// Filter the questions.
		var questions = this.questionCollection.getFilteredQuestions(this.isShortVersion);
		var counter = questions.length;

		// Render intermediate content in a temporary DOM.
		var container = document.createDocumentFragment();
		for (let question of questions) {
			let content = this.renderOne(question, counter);
			container.appendChild(content);
			counter--;
		}

		$('#container-question-list').html(container);
		this.linkToDirectoriesIfAllQuestionsAnswered();
	}

	/**
	 * Render the main template.
	 */
	renderProgressBar() {
		let content = this.progressTemplate({
			progress: this.getProgress(),
			numberOfQuestionAnswered: this.questionCollection.countVisible(this.isShortVersion),
			totalNumberOfQuestions: this.questionCollection.count(this.isShortVersion)
		});

		this.$progress.html(content);
	}

	/**
	 * Display the links to the candidate directory if needed
	 */
	linkToDirectoriesIfAllQuestionsAnswered() {

		let numberOfQuestionAnswered = this.questionCollection.countVisible(this.isShortVersion);
		let totalNumberOfQuestions = this.questionCollection.count(this.isShortVersion);
		if (totalNumberOfQuestions === 0) {
			// As long as no question is answered, totalNumberOfQuestions equals 0
			// In this case we can make an early return
			return;
		}
		if (numberOfQuestionAnswered === totalNumberOfQuestions) {
			// The short version is taken completely, display directory links and hide short version link
			$('#container-congratulations').show();
			$('#btn-short-version').hide();
			if (!this.isShortVersion) {
				$('#btn-long-version').hide();
			}
		} else {
			$('#container-congratulations').hide();
		}
	}

	/**
	 * @returns {number}
	 */
	getProgress() {

		let progress = 0; // default
		if (this.questionCollection.count() > 1) {
			progress = this.questionCollection.countVisible(this.isShortVersion) / this.questionCollection.count(this.isShortVersion) * 100;
		}
		return progress;
	}

	/**
	 * @returns {bool}
	 */
	isShortQuestionnaire() {

		var value = 'short';
		// sanitize arguments
		var allowedArguments = ['version'];
		var query = window.location.hash.split('&');
		for (let argument of query) {

			// sanitize arguments
			argument = argument.replace('#', '');
			var argumentParts = argument.split('=');
			if (argumentParts.length === 2 && argumentParts[0] == 'version') {
				value = argumentParts[1];
			}
		}
		return value === 'short';
	}

	/**
	 * @param question
	 */
	afterAnswerChanged(question) {

		// Find next question and update its visible flag.
		let nextIndex = (this.questionCollection.length - 1) - question.get('index');
		let nextQuestion = this.questionCollection.at(nextIndex);
		nextQuestion.set('visible', true);

		// Update GUI.
		this.updateChart(question);
		this.renderProgressBar();
		this.linkToDirectoriesIfAllQuestionsAnswered();

		// Persist new status to the storage.
		question.save().done((question) => {
			nextQuestion.save();
			if (EasyvoteSmartvote.isUserAuthenticated) {
				this.persistQuestionState();
			}

		});
	}

	/**
	 * Persist state after 1 second if there is no interaction.
	 *
	 * @return void
	 */
	persistQuestionState() {

		window.clearTimeout(window.timeout);
		window.timeout = window.setTimeout(
			function() {

				// Only persist state if FE User Exists.

				var url = '/routing/state/?token=' + EasyvoteSmartvote.token;

				// Initialize payLoad which contains useful data to persist.
				var payLoad = [];
				QuestionCollection.getInstance().each(question => {
					let data = {};
					data['id'] = question.get('id');
					data['answer'] = question.get('answer');
					data['visible'] = question.get('visible');

					payLoad.push(data);
				});

				// Send by ajax the answer state.
				$.ajax({
					url: url,
					method: 'post',
					data: JSON.stringify(payLoad)
				});
			},
			1000
		);

	}

	/**
	 * @param question
	 */
	updateChart(question) {

		if (typeof question.get('answer') === 'number') {
			SpiderChart.getInstance(this.isShortVersion)
				.addToCleavage1(question.id, question.get('answer'), question.get('cleavage1'))
				.addToCleavage2(question.id, question.get('answer'), question.get('cleavage2'))
				.addToCleavage3(question.id, question.get('answer'), question.get('cleavage3'))
				.addToCleavage4(question.id, question.get('answer'), question.get('cleavage4'))
				.addToCleavage5(question.id, question.get('answer'), question.get('cleavage5'))
				.addToCleavage6(question.id, question.get('answer'), question.get('cleavage6'))
				.addToCleavage7(question.id, question.get('answer'), question.get('cleavage7'))
				.addToCleavage8(question.id, question.get('answer'), question.get('cleavage8'))
				.draw();
		}
	}

	/**
	 * Render HTML of a single question.
	 *
	 * @param model
	 * @param counter
	 */
	renderOne(model, counter) {
		this.updateChart(model);

		let view = new QuestionView({model: model, counter: counter});
		return view.render();
	}

}
