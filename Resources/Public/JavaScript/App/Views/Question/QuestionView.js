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

		// Adjust layout
		this.$el.toggleClass('hidden', !this.model.get('visible'));
		if (this.model.get('answer') !== null) {
			$('.content-box', this.$el).css({backgroundColor: '#DADADA', opacity: 0.7});
			$('h2, span, div', this.$el).css({color: '#333'});
		}

		return this.el;
	}

	/**
	 * @return void
	 */
	edit(e) {
		// retrieve the selected value and update the underlying model.
		let value = parseInt(e.target.value);
		this.model.set('answer', value);
	}

}
