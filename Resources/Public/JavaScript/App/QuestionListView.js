/*jshint esnext:true */
import QuestionCollection from './QuestionCollection'
import QuestionView from './QuestionView'

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

		questionCollection.fetch();
		super();
	}

	/**
	 * Render the main template.
	 */
	render() {

		this.$progress.html(
			this.progressTemplate({
				progress: this.getProgress(),
				numberOfQuestionAnswered: QuestionCollection.getInstance().countVisible(),
				totalNumberOfQuestions: QuestionCollection.getInstance().count()
			})
		);
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
		let questionCollection = QuestionCollection.getInstance();
		let nextIndex = (questionCollection.length - 1) - question.index;
		let nextQuestion = questionCollection.at(nextIndex);
		nextQuestion.trigger('visible');
	}

	/**
	 * Add a single question item to the list by creating a view for it, then
	 * appending its element to the `<div>`.
	 * @param model
	 */
	addOne(model) {
		let view = new QuestionView({ model });
		$('#container-question-list').append(view.render());
	}

	// *Add all items in the **Todos** collection at once.*
	addAll() {
		this.$('#todo-list').html('');
		Todos.each(this.addOne, this);
	}

}
