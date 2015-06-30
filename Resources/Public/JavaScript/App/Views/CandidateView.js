/*jshint esnext:true */

/*
 * This file is part of the TYPO3 CMS project.
 *
 * See LICENSE.txt that was shipped with this package.
 */

export default class CandidateView extends Backbone.View {

	/**
	 * @param options
	 */
	constructor(options) {

		// *... is a list tag.*
		this.tagName = 'div';

		// *Cache the template function for a single item.*
		this.template = _.template($('#template-candidate').html());

		super(options);
		//this.listenTo(this.model, 'change', this.render);
		//this.listenTo(this.model, 'visible', this.changeVisible);
	}

	/**
	 * Render the candidate view.
	 *
	 * @returns string
	 */
	render() {
		let content = this.template(this.model.toJSON());
		this.$el.html(content);
		return this.el;
	}

	/**
	 * Set visible true
	 */
	changeVisible() {
		this.model.save({visible: true});
		this.render();
	}

}
