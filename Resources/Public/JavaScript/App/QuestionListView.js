/*jshint esnext:true */
import QuestionCollection from './QuestionCollection'
import QuestionView from './QuestionView'

/*
 * This file is part of the TYPO3 CMS project.
 *
 * See LICENSE.txt that was shipped with this package.
 */

//const View = Backbone.View;

export default class QuestionListView extends Backbone.View {

	constructor() {

		// *Instead of generating a new element, bind to the existing skeleton of
		// the App already present in the HTML.*
		this.setElement($('#container-questions'), true);

		this.progressTemplate = _.template($('#template-progress').html());

		// *Delegate events for creating new items and clearing completed ones.*
		//this.events = {
		//	'keypress #new-todo': 'createOnEnter',
		//	'click #clear-completed': 'clearCompleted',
		//	'click #toggle-all': 'toggleAllComplete'
		//};

		//// *At initialization, we bind to the relevant events on the `Todos`
		//// collection, when items are added or changed. Kick things off by
		//// loading any preexisting todos that might be saved in localStorage.*
		//this.allCheckbox = this.$('#toggle-all')[0];
		//this.$input = this.$('#new-todo');
		this.$progress = this.$('#container-progress');
		//this.$main = this.$('#main');

		/** @var questionCollection QuestionCollection*/
		let questionCollection = QuestionCollection.getInstance();

		this.listenTo(questionCollection, 'add', this.addOne);
		//this.listenTo(Todos, 'reset', this.addAll);
		//this.listenTo(Todos, 'filter', this.filterAll);
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
				progress: this.getProgress()
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
		let questionCollection = QuestionCollection.getInstance();
		// @todo refactor
		let question = argument.attributes;
		let nextIndex = (questionCollection.length - 1) - question.index;
		let nextQuestion = questionCollection.at(nextIndex);
		nextQuestion.set('visible', true);
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

	progress() {
		return '3';
	}
	//filterOne(todo) {
	//	todo.trigger('visible');
	//}
	//
	//filterAll() {
	//	Todos.each(this.filterOne, this);
	//}
	//
	//// *Generate the attributes for a new Todo item.*
	//newAttributes() {
	//	return {
	//		title: this.$input.val().trim(),
	//		order: Todos.nextOrder(),
	//		completed: false
	//	};
	//}
	//
	//// *If you hit `enter` in the main input field, create a new **Todo** model,
	//// persisting it to localStorage.*
	//createOnEnter(e) {
	//	if (e.which !== ENTER_KEY || !this.$input.val().trim()) {
	//		return;
	//	}
	//
	//	Todos.create(this.newAttributes());
	//	this.$input.val('');
	//}
	//
	//// *Clear all completed todo items and destroy their models.*
	//clearCompleted() {
	//	_.invoke(Todos.completed(), 'destroy');
	//	return false;
	//}
	//
	//toggleAllComplete() {
	//	var completed = this.allCheckbox.checked; // const
	//	Todos.each(todo => todo.save({ completed }));
	//}
}
