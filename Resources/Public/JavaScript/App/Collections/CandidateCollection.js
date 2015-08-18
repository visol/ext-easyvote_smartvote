/*jshint esnext:true */
import CandidateModel from '../Models/CandidateModel'
import FacetView from '../Views/Candidate/FacetView'
import FilterEngine from '../Filter/FilterEngine'
import FacetIterator from '../Iterator/FacetIterator';

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
	 * @returns {*}
	 */
	getFilteredCandidates() {

		return this.filter(candidate => {

			var filterEngine = new FilterEngine();
			var facetIterator = FacetIterator.getIterator();
			var isOk = true;

			// Fetch first facet
			var facet = facetIterator.next().value;
			while (facet && isOk) {
				isOk = filterEngine.isOk(candidate, facet);
				facet = facetIterator.next().value;
			}

			return isOk;
		});
	}

	/**
	 *
	 * @returns {*}
	 */
	remoteFetch() {
		return Backbone.ajaxSync('read', this).done(models => {
			for (let model of models) {
				this.create(model, {sort: false});
			}
			// Trigger final sort => will trigger the view to render.
			this.sort(); // not needed here since manually triggered in the view.
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