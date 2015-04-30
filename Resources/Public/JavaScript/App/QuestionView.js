/*jshint esnext:true */

/*
 * This file is part of the TYPO3 CMS project.
 *
 * See LICENSE.txt that was shipped with this package.
 */

//const View = Backbone.View;

export default class QuestionView extends Backbone.View {

	constructor(options) {

		// *... is a list tag.*
		this.tagName = 'div';

		// *Cache the template function for a single item.*
		this.template = _.template($('#template-question').html());

		//// *Define the DOM events specific to an item.*
		this.events = {
			'click .btn-answer': 'edit'
			//'dblclick label': 'edit',
			//'click .destroy': 'clear',
			//'keypress .edit': 'updateOnEnter',
			//'blur .edit': 'close'
		};

		super(options);

		this.listenTo(this.model, 'change', this.render);
		this.listenTo(this.model, 'change:visible', this.render);
		//this.listenTo(this.model, 'change:visible', this.render);
		//this.listenTo(this.model, 'destroy', this.remove);
		//this.listenTo(this.model, 'visible', this.defineVisibility);

	}

	/**
	 * Render the question view
	 *
	 * @returns string
	 */
	render() {
		this.$el.html(this.template(this.model.toJSON()));
		this.defineVisibility();
		return this.el;
	}

	/**
	 * Define visibility of the question.
	 */
	defineVisibility() {
		this.$el.toggleClass('hidden', !this.model.get('visible'));
	}

	// #### Property Getters and Setters
	//get isHidden() {
	//	var isCompleted = this.model.get('completed'); // const
	//	return (// hidden cases only
	//	(!isCompleted && TodoFilter === 'completed') ||
	//	(isCompleted && TodoFilter === 'active')
	//	);
	//}

	/**
	 * @return void
	 */
	edit(e) {
		// retrieve the selected value and update the underlying model.
		let value = parseInt(e.target.value);
		this.model.save({answer: value});
	}

	// *Close the `'editing'` mode, saving changes to the todo.*
	//close() {
	//	var title = this.input.val(); // const
	//
	//	if (title) {
	//		this.model.save({ title });
	//	} else {
	//		this.clear();
	//	}
	//
	//	this.$el.removeClass('editing');
	//}

	// *If you hit `enter`, we're through editing the item.*
	//updateOnEnter(e) {
	//	if (e.which === ENTER_KEY) {
	//		this.close();
	//	}
	//}

	// *Remove the item and destroy the model.*
	//clear() {
	//	this.model.destroy();
	//}
}
