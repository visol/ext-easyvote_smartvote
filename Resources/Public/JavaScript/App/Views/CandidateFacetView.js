/*jshint esnext:true */
import CandidateCollection from '../Collections/CandidateCollection'
import FacetModel from '../Models/FacetModel';

/*
 * This file is part of the TYPO3 CMS project.
 *
 * See LICENSE.txt that was shipped with this package.
 */

export default class CandidateFacetView extends Backbone.View {

	/**
	 * Constructor
	 *
	 * @param options
	 */
	constructor(options) {

		// Instead of generating a new element, bind to the existing skeleton of
		// the App already present in the HTML.
		this.setElement($('#container-candidate-filter'), true);

		// *Cache the template function for a single item.*
		this.template = _.template($('#template-candidate-filter').html());

		// *Define the DOM events specific to an item.*
		this.events = {
			'change .form-control': 'filter'
		};

		this.model = new FacetModel();
		this.model.fetch(); // Restore values from the session

		this.bindings = {
			'#nationalParty': 'nationalParty',
			'#district': 'district',
			'#minAge': 'minAge',
			'#maxAge': 'maxAge',
			'#incumbent': 'incumbent',
			'#gender': 'gender'
		};

		// special binding since the reset button is outside the scope of this view.
		_.bindAll(this, 'reset');
		$(document).on('click', '#btn-reset-facets', this.reset);

		super(options);
	}

	/**
	 * @returns void
	 */
	filter() {

		var data = {};
		for (let facet of this.getFacets()) {
			data[facet.name] = facet.value;
		}
		this.model.save(data);

		Backbone.trigger('facet:changed');
	}

	/**
	 * @returns {boolean}
	 */
	reset() {
		this.model = new FacetModel();
		this.render();
		this.filter();
		return false;
	}

	/**
	 * @returns {Object}
	 */
	getFacets() {
		var facets = [];
		let $elements = $('#container-candidate-filter').find('.form-control');
		$elements.each((index, element)  => {
			let facet = {};
			facet.name = $(element).attr('name');
			facet.value = $(element).val();
			facets.push(facet);
		});

		return facets[Symbol.iterator]();
	}

	/**
	 * Render the candidate view.
	 *
	 * @returns void
	 */
	render() {
		let content = this.template();
		this.$el.html(content);
		this.stickit();
	}

}
