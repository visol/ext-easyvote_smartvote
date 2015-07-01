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
		this.localStorage = new Backbone.LocalStorage('candidates-' + EasyvoteSmartvote.token);
	}

	/**
	 * Comparator used to sort candidates by "matching" criteria.
	 *
	 * @param candidate1
	 * @param candidate2
	 * @returns {number}
	 */
	comparator(candidate1, candidate2) {
		return candidate1.getMatching() > candidate2.getMatching() ? -1 : 1;
	}

	/**
	 * @returns {*}
	 */
	fetch() {

		// Check whether localStorage contains record about this collection otherwise fetch it by ajax.
		let records = this.localStorage.findAll();
		if (_.isEmpty(records)) {
			return this.remoteFetch();
		} else {
			// call original fetch method.
			return super.fetch();
		}
	}

	/**
	 *
	 * @returns {*}
	 */
	remoteFetch() {
		return Backbone.ajaxSync('read', this).done(models => {
			for (let model of models) {
				//let candidate = new CandidateModel(model);
				this.create(model, {sort: false});
			}
			// Trigger final sort => will trigger the view to render.
			this.sort();
		});
	}

	/**
	 * Return the URL to be used.
	 *
	 * @returns {string}
	 */
	url() {
		return '/routing/candidates/' + EasyvoteSmartvote.currentElection;
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

}