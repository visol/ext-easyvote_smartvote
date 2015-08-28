/*jshint esnext:true */
/*
 * This file is part of the TYPO3 CMS project.
 *
 * See LICENSE.txt that was shipped with this package.
 */

export default class PartyView extends Backbone.View {

	/**
	 * @param options
	 */
	constructor(options) {

		// *... is a list tag.*
		this.tagName = 'div';

		// *Cache the template function for a single item.*
		this.template = _.template($('#template-party').html());

		// *Define the DOM events specific to an item.*
		this.events = {
		};

		super(options);
	}

	/**
	 * Render the party view.
	 *
	 * @returns string
	 */
	render() {
		let content = this.template(this.model.toJSON());
		this.$el.html(content);
		return this.el;
	}

}
