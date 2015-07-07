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


		//this.listenTo(Backbone, 'question:changed', this.showNextAnswer);
		this.listenTo(this.questionCollection, 'change:answer', this.showNextAnswer);
		this.listenTo(this.questionCollection, 'all', this.renderProgressBar);

		this.questionCollection.load().done(()=> {
			this.render();
		});

		super();
	}

	/**
	 * Render the main template.
	 */
	render() {
		var questions = this.questionCollection.getRapideQuestions();

		var counter = questions.length;

		// Render intermediate content in a temporary DOM.
		var container = document.createDocumentFragment();
		for (let question of questions) {
			let content = this.renderOne(question, counter);
			container.appendChild(content);
			counter--;
		}

		$('#container-question-list').html(container);
	}

	/**
	 * Render the main template.
	 */
	renderProgressBar() {
		let content = this.progressTemplate({
			progress: this.getProgress(),
			numberOfQuestionAnswered: this.questionCollection.countVisible(),
			totalNumberOfQuestions: this.questionCollection.count()
		});

		this.$progress.html(content);
	}

	/**
	 * @returns {number}
	 */
	getProgress() {

		let progress = 0; // default
		if (this.questionCollection.count() > 1) {
			progress = this.questionCollection.countVisible() / this.questionCollection.count() * 100;
		}
		return progress;
	}

	/**
	 * @param question
	 */
	showNextAnswer(question) {

		this.updateChart(question);

		let nextIndex = (this.questionCollection.length - 1) - question.get('index');
		let nextQuestion = this.questionCollection.at(nextIndex);
		nextQuestion.trigger('visible');
	}

	/**
	 * @param question
	 */
	updateChart(question) {

		if (typeof question.get('answer') === 'number') {
			SpiderChart.getInstance()
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

		let view = new QuestionView({model:model, counter:counter});
		return view.render();
	}

}
