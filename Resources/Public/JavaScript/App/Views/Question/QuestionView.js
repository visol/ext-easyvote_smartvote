/*jshint esnext:true */

/*
 * This file is part of the TYPO3 CMS project.
 *
 * See LICENSE.txt that was shipped with this package.
 */

export default class QuestionView extends Backbone.View {

	/**
	 * @param options
	 */
	constructor(options) {

		this.counter = options.counter;

		// *... is a list tag.*
		this.tagName = 'div';

		// *Cache the template function for a single item.*
		this.template = _.template($('#template-question').html());

		// *Define the DOM events specific to an item.*
		this.events = {
			'click .btn-answer': 'edit'
		};

		super(options);

		this.listenTo(this.model, 'change', this.render);
		this.listenTo(this.model, 'visible', this.changeVisible);
	}

	/**
	 * Render the question view
	 *
	 * @returns string
	 */
	render() {
		// Serialise model and add counter info on the top of it.
		let data = this.model.toJSON();
		data['counter'] = this.counter;

		this.$el.html(this.template(data));
		this.defineVisibility();
		return this.el;
	}

	/**
	 * Set visible true
	 */
	changeVisible() {
		this.model.save({visible: true});
		this.render();
	}

	/**
	 * Define visibility of the question.
	 */
	defineVisibility() {
		this.$el.toggleClass('hidden', !this.model.get('visible'));
	}

	/**
	 * @return void
	 */
	edit(e) {
		// retrieve the selected value and update the underlying model.
		let value = parseInt(e.target.value);
		this.model.save({answer: value}).done((question) => {
			//Backbone.trigger('question:changed', question);
		});

	}

}
