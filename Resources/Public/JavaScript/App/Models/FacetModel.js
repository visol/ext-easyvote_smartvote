/*jshint esnext:true */

/*
 * This file is part of the TYPO3 CMS project.
 *
 * See LICENSE.txt that was shipped with this package.
 */

export default class FacetModel extends Backbone.Model {

	/**
	 * Initialize object.
	 */
	initialize() {
		this.localStorage = new Backbone.LocalStorage('candidates-facet-' + EasyvoteSmartvote.token);
	}

	/**
	 * @returns {{id: number, nationalParty: string, district: string, minAge: string, maxAge: string, incumbent: string, gender: string}}
	 */
	defaults() {
		return {
			id: 1, // fictive id but is mandatory in order to retrieve the model in the session.
			nationalParty: '',
			district: '',
			minAge: '18',
			maxAge: '90',
			incumbent: '',
			gender: ''
		};
	}

}
