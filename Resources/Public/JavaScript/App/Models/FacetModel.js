/*jshint esnext:true */

/*
 * This file is part of the TYPO3 CMS project.
 *
 * See LICENSE.txt that was shipped with this package.
 */

export default class FacetModel extends Backbone.Model {

	/**
	 * @returns {{id: number, nationalParty: string, district: string, minAge: string, maxAge: string, incumbent: string, gender: string}}
	 */
	defaults() {
		return {
			id: 1, // fictive id but is mandatory in order to retrieve the model in the session.
			nationalParty: '',
			district: EasyvoteSmartvote.userDistrict,
			minAge: '18',
			maxAge: '90',
			incumbent: '',
			gender: ''
		};
	}

	/**
	 * Initialize object.
	 */
	initialize() {
		this.localStorage = new Backbone.LocalStorage('candidates-facet-' + EasyvoteSmartvote.token);
	}

	/**
	 * Return whether the object has a state
	 */
	hasState() {
		return Object.keys(this.getState()).length;
	}

	/**
	 * Get state of the object coming form the URL hash.
	 */
	getState() {

		if (!this.state) {
			this.state = {};

			var allowedArguments = ['nationalParty', 'district', 'minAge', 'maxAge', 'incumbent', 'gender'];
			var query = window.location.hash.split('&');
			for (let argument of query) {

				// sanitize arguments
				argument = argument.replace('#', '');
				var argumentParts = argument.split('=');
				if (argumentParts.length === 2 && allowedArguments.indexOf(argumentParts[0]) >= 0) {
					let name = argumentParts[0];
					let value = argumentParts[1];
					this.state[name] = value;
				}
			}
		}
		return this.state
	}

	/**
	 * Set default values form the URL hash.
	 */
	setState() {
		this.save(this.getState());
	}

}
