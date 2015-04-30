/*jshint esnext:true */

/*
 * This file is part of the TYPO3 CMS project.
 *
 * See LICENSE.txt that was shipped with this package.
 */

export default class SpiderChartView extends Backbone.View {

	/**
	 * Constructor
	 *
	 * @param options
	 */
	constructor(options) {

		// Define the wrapping tag
		this.tagName = 'div';

		// *Cache the template function for a single item.*
		this.template = _.template($('#template-progress').html());

		super(options);

		//this.listenTo(this.model, 'change', this.render);
		//this.listenTo(this.model, 'change:visible', this.render);
	}

	/**
	 * Render this view.
	 *
	 * @returns string
	 */
	render() {
		this.$el.html(this.template(this.model.toJSON()));
		this.defineVisibility();
		return this.el;
	}

}
