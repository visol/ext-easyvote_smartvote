/*jshint esnext:true */

/*
 * This file is part of the TYPO3 CMS project.
 *
 * See LICENSE.txt that was shipped with this package.
 */

export default class FacetModel extends Backbone.Model {

	/**
	 * @returns {{id: number, name: string, nationalParty: string, district: string, minAge: string, maxAge: string, incumbent: string, elected: string, deselected: string, gender: string, candidate: string}}
	 */
	defaults() {
		return {
			id: 1, // fictive id but is mandatory in order to retrieve the model in the session.
			name: '',
			nationalParty: '',
			persona: '',
			district: EasyvoteSmartvote.userDistrict,
			districtName: '', // store the district name to workaround Smartvote model: district do not have the same id for Nationalrat and Ständerat election.
			minAge: '18',
			maxAge: '90',
			incumbent: '',
			elected: '',
			deselected: '',
			gender: '',
			candidate: ''
		};
	}

	/**
	 * Initialize object.
	 */
	initialize() {
		this.localStorage = new Backbone.LocalStorage('candidates-facet-' + this.getToken());
	}

	/**
	 * Compute the token.
	 *
	 * @returns {string}
	 */
	getToken() {
		var token = EasyvoteSmartvote.token;
		if (EasyvoteSmartvote.relatedToken) {
			token = EasyvoteSmartvote.relatedToken;
		}
		return token;
	}

	/**
	 * Return whether the object has a state
	 */
	hasStateInUri() {
		return Object.keys(this.getStateFromUri()).length;
	}

	/**
	 * Get state of the object coming form the URL hash.
	 */
	getStateFromUri() {

		if (!this.state) {
			this.state = {};

			var allowedArguments = ['candidate', 'name', 'nationalParty', 'district', 'persona', 'minAge', 'maxAge', 'incumbent', 'elected', 'deselected', 'gender'];
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
	setStateFromUri() {
		this.save(this.getStateFromUri());
	}

}
