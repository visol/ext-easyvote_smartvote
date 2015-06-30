/*jshint esnext:true */
import QuestionCollection from '../Collections/QuestionCollection'
import QuestionView from './QuestionView'
import SpiderChart from '../Chart/SpiderChart'

/*
 * This file is part of the TYPO3 CMS project.
 *
 * See LICENSE.txt that was shipped with this package.
 */

export default class QuestionListView extends Backbone.View {

	constructor() {

		// Instead of generating a new element, bind to the existing skeleton of
		// the App already present in the HTML.
		this.setElement($('#container-questions'), true);

		this.progressTemplate = _.template($('#template-progress').html());

		this.$progress = this.$('#container-progress');

		/** @var questionCollection QuestionCollection*/
		let questionCollection = QuestionCollection.getInstance();

		this.listenTo(questionCollection, 'add', this.addOne);
		this.listenTo(questionCollection, 'change:answer', this.changeAnswer);
		this.listenTo(questionCollection, 'all', this.render);

		questionCollection.load();

		super();
	}

	/**
	 * Render the main template.
	 */
	render() {
		let content = this.progressTemplate({
			progress: this.getProgress(),
			numberOfQuestionAnswered: QuestionCollection.getInstance().countVisible(),
			totalNumberOfQuestions: QuestionCollection.getInstance().count()
		});

		this.$progress.html(content);
	}

	/**
	 * @returns {number}
	 */
	getProgress() {

		let questionCollection = QuestionCollection.getInstance();

		let progress = 0; // default
		if (questionCollection.count() > 1) {
			progress = questionCollection.countVisible() / questionCollection.count() * 100;
		}
		return progress;
	}

	/**
	 * @param argument
	 */
	changeAnswer(argument) {
		let question = argument.attributes;

		this.updateChart(question);

		let questionCollection = QuestionCollection.getInstance();
		let nextIndex = (questionCollection.length - 1) - question.index;
		let nextQuestion = questionCollection.at(nextIndex);
		nextQuestion.trigger('visible');
	}

	/**
	 * @param question
	 */
	updateChart(question) {

		if (typeof question.answer === 'number') {
			SpiderChart.getInstance()
				.addToCleavage1(question.id, question.answer, question.cleavage1)
				.addToCleavage2(question.id, question.answer, question.cleavage2)
				.addToCleavage3(question.id, question.answer, question.cleavage3)
				.addToCleavage4(question.id, question.answer, question.cleavage4)
				.addToCleavage5(question.id, question.answer, question.cleavage5)
				.addToCleavage6(question.id, question.answer, question.cleavage6)
				.addToCleavage7(question.id, question.answer, question.cleavage7)
				.addToCleavage8(question.id, question.answer, question.cleavage8)
				.draw();
		}
	}

	/**
	 * Add a single question item to the list by creating a view for it, then
	 * appending its element to the `<div>`.
	 * @param model
	 */
	addOne(model) {
		let question = model.attributes;
		this.updateChart(question);
		let view = new QuestionView({model});
		$('#container-question-list').append(view.render());
	}

	/**
	 * @return {bool}
	 * @private
	 */
	_isAnonymous() {
		return !EasyvoteSmartvote.isUserAuthenticated
	}

}
