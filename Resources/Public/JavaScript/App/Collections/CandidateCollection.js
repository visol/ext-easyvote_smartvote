/*jshint esnext:true */
import CandidateModel from '../Models/CandidateModel'

/*
 * This file is part of the TYPO3 CMS project.
 *
 * See LICENSE.txt that was shipped with this package.
 */

export default class CandidateCollection extends Backbone.Collection {

	/**
	 * @param options
	 */
	constructor(options) {
		super(options);

		// Hold a reference to this collection's model.
		this.model = CandidateModel;

		// Save all of the candidate items under the `'candidates'` namespace.
		if (this._isAnonymous()) {
			this.localStorage = new Backbone.LocalStorage('candidates-' + EasyvoteSmartvote.token);
		}
	}

	/**
	 * @returns {*}
	 */
	fetchForAnonymousUser() {

		// Check whether localStorage contains record about this collection
		let records = this.localStorage.findAll();
		records = [];
		if(_.isEmpty(records)) {
			var self = this;
			// fetch from server once
			$.ajax({
				url: this.url()
			}).done(function(response) {
				$.each(response, function(i, item) {
					self.create(item);  // saves model to local storage
				});
			});
		} else {
			// call original fetch method
			return super.fetch();
		}
	}

	/**
	 * @returns {*}
	 */
	fetchForAuthenticatedUser() {
		return super.fetch();
	}

	/**
	 * Return the URL to be used.
	 *
	 * @returns {string}
	 */
	url() {
		let token = '';
		if (EasyvoteSmartvote.isUserAuthenticated) {
			token += '?token=' + EasyvoteSmartvote.token;
		}
		return '/routing/candidates/' + EasyvoteSmartvote.currentElection + token;
	}

	/**
	 * @return CandidateCollection
	 */
	static getInstance() {
		if (!this.instance) {
			this.instance = new CandidateCollection();
		}
		return this.instance;
	}

	/**
	 * Return the total number of candidates in this collection.
	 *
	 * @returns int
	 */
	count() {
		return this.length;
	}

	/**
	 * Return the number of visible candidates.
	 *
	 * @returns int
	 */
	countVisible() {
		return this.filter(candidate => candidate.get('visible')).length;
	}

	/**
	 * @return {bool}
	 * @private
	 */
	_isAnonymous() {
		return !EasyvoteSmartvote.isUserAuthenticated
	}

}