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

		if (this.model.hasStateInUri()) {
			this.model.setStateFromUri();
		} else {
			this.model.fetch()
		}

		this.bindings = {
			'#name': 'name',
			'#party': 'party',
			'#district': 'district',
			'#minAge': 'minAge',
			'#maxAge': 'maxAge',
			'#incumbent': 'incumbent',
			'#elected': 'elected',
			'#deselected': 'deselected',
			'#gender': 'gender',
			'#candidate': 'candidate',
			'#persona': 'persona'
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
		let party = this.model.get('party') - 0;
		let persona = this.model.get('persona');
		let elected = this.model.get('elected');
		let deselected = this.model.get('deselected');
		return district > 0 || party > 0 || persona !== '' || elected > 0 || deselected > 0;
	}

	/**
	 * @returns void
	 */
	save() {
		var query = [];
		var data = {};
		for (let facet of FacetIterator.getIterator()) {
			if (facet.name === 'candidate') {
				// The candidate facet is only available as parameter because it is needed for sharing
				// As soon as a filter is changed, this facet needs to be unset
				data[facet.name] = '';
				query.push(facet.name + '=');
				continue;
			}
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

		// Save district name to solve issue for associated election.
		this.model.set('districtName', $('#district option:selected').text());
		this.model.set('partyName', $('#party option:selected').text());
		this.model.save();

		this.handleDistrictForAlternativeElection();
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

		this.handleDistrictForAlternativeElection('district');
		this.handleDistrictForAlternativeElection('party');

		// Hide by default until we can tell whether the box should be shown or not.
		$('#container-candidate-filter').closest('.csc-default').removeClass('hidden');
	}

	/**
	 * @return void
	 */
	handleDistrictForAlternativeElection(fieldName) {
		if (this.model.get(fieldName)) {

			if (this.isDistrictCoherentWithCurrentElection(fieldName)) {
				// Store districtName to later retrieve the district id in an alternative election context.
				this.model.set(fieldName + 'Name', $('#' + fieldName + ' option:selected').text());
				this.model.save();
			} else {
				var name = this.model.get(fieldName + 'Name');
				var value = $('#' + fieldName + ' option')
					.filter((index, element) => {
						return $(element).html() == name;
					})
					.val();

				// Reset the new district value for this election.
				if (value) {
					this.model.set(fieldName, value);
					this.model.save();
				}
			}
		}
	}

	/**
	 * @return boolean
	 */
	isDistrictCoherentWithCurrentElection(fieldName) {
		return this.model.get(fieldName) == $('#' + fieldName).val();
	}

}
