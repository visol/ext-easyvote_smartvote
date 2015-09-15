/*jshint esnext:true */
import CandidateCollection from '../../Collections/CandidateCollection'
import FacetModel from '../../Models/FacetModel';
import FacetIterator from '../../Iterator/FacetIterator';

/*
 * This file is part of the TYPO3 CMS project.
 *
 * See LICENSE.txt that was shipped with this package.
 */

export default class FacetView extends Backbone.View {

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
			'change .form-control-select': 'save'
		};

		// We want a delay on the input field, so we bind the action via jQuery instead of the backbone mechanism.
		_.bindAll(this, 'save');
		$(document).on('keydown', '.form-control-input', _.debounce(this.save, 500));

		this.model = new FacetModel();

		if (this.model.hasState()) {
			this.model.setState();
		} else {
			this.model.fetch()
		}

		this.bindings = {
			'#name': 'name',
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
	 * @returns {boolean}
	 */
	hasMinimumFilter() {
		let district = this.model.get('district') - 0;
		let nationalParty = this.model.get('nationalParty') - 0;
		return district > 0 || nationalParty > 0;
	}

	/**
	 * @returns void
	 */
	save() {

		var query = [];
		var data = {};
		for (let facet of FacetIterator.getIterator()) {
			data[facet.name] = facet.value;
			query.push(facet.name + '=' + facet.value)
		}

		// Only save if a query was found. Could be the DOM is not yet initialized.
		if (query.length > 0) {

			// Set state of the filter in the URL.
			window.location.hash = query.join('&');

			this.model.save(data);
			Backbone.trigger('facet:changed');
		}
	}

	/**
	 * @returns {boolean}
	 */
	reset() {
		this.model = new FacetModel();
		this.render();
		this.save();
		return false;
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

		// Hide by default until we can tell whether the box should be shown or not.
		$('#container-candidate-filter').closest('.csc-default').removeClass('hidden');
	}

}
