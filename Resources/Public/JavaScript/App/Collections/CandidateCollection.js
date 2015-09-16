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

		// Set default orderings.
		this.sorting = 'matching';
		this.direction = 'descending';

		// Save all of the candidate items under the `'candidates'` namespace.
		// @todo re-enable me after solving the performance issue. Data can be very large over 10Mb.
		//this.localStorage = new Backbone.LocalStorage('candidates-' + EasyvoteSmartvote.token);
	}

	/**
	 * Comparator used to sort candidates by "matching" criteria.
	 *
	 * @param candidate1
	 * @param candidate2
	 * @returns {number}
	 */
	comparator(candidate1, candidate2) {

		var comparison;

		if (this.sorting === 'name' && this.direction === 'ascending') {
			if (candidate1.get('lastName') === candidate2.get('lastName')) {
				comparison = candidate1.get('firstName') > candidate2.get('firstName') ? 1 : -1;
			} else {
				comparison = candidate1.get('lastName') > candidate2.get('lastName') ? 1 : -1;
			}
		} else if (this.sorting === 'name' && this.direction === 'descending') {
			if (candidate1.get('lastName') === candidate2.get('lastName')) {
				comparison = candidate1.get('firstName') < candidate2.get('firstName') ? 1 : -1;
			} else {
				comparison = candidate1.get('lastName') < candidate2.get('lastName') ? 1 : -1;
			}
		} else if (this.sorting === 'matching' && this.direction === 'ascending') {
			comparison = candidate1.getMatching() > candidate2.getMatching() ? 1 : -1;
		} else {
			comparison = candidate1.getMatching() < candidate2.getMatching() ? 1 : -1; // default choice
		}

		return comparison;

	}

	/**
	 * @returns {*}
	 */
	fetch(filter) {

		return super.fetch({ data: filter });

		// @todo re-enable me after solving the performance issue. Data can be very large over 10Mb.
		// Check whether localStorage contains record about this collection otherwise fetch it by ajax.
		//let records = this.localStorage.findAll();
		//if (_.isEmpty(records)) {
		//	return this.remoteFetch();
		//} else {
		//	// call original fetch method.
		//	return super.fetch();
		//}
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
		return '/routing/candidates/' + EasyvoteSmartvote.currentElection +  '?id=' + EasyvoteSmartvote.pageUid + '&L=' + EasyvoteSmartvote.sysLanguageUid;
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
	 * @returns {string}
	 */
	getSorting() {
		return this.sorting;
	}

	/**
	 * @param {String} sort
	 * @return void
	 */
	setSorting(sort) {
		this.sorting = sort;
	}

	/**
	 * @returns {string}
	 */
	getDirection() {
		return this.direction;
	}

	/**
	 * @param {String} direction
	 * @return void
	 */
	setDirection(direction) {
		this.direction = direction;
	}

}