/*jshint esnext:true */
import PartyModel from '../Models/PartyModel'
import FilterEngine from '../Filter/FilterEngine'
import FacetIterator from '../Iterator/FacetIterator';

/*
 * This file is part of the TYPO3 CMS project.
 *
 * See LICENSE.txt that was shipped with this package.
 */

export default class PartyCollection extends Backbone.Collection {

	/**
	 * @param options
	 */
	constructor(options) {
		super(options);

		// Hold a reference to this collection's model.
		this.model = PartyModel;

		// Save all of the party items under the `'parties'` namespace.
		this.localStorage = new Backbone.LocalStorage('parties-' + EasyvoteSmartvote.token);
	}

	/**
	 * Comparator used to sort parties by "matching" criteria.
	 *
	 * @param party1
	 * @param party2
	 * @returns {number}
	 */
	comparator(party1, party2) {
		return party1.getMatching() > party2.getMatching() ? -1 : 1;
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
	getFilteredParties() {

		return this.filter(party => {

			var filterEngine = new FilterEngine();
			var facetIterator = FacetIterator.getIterator();
			var isOk = true;

			// Fetch first facet
			var facet = facetIterator.next().value;
			while (facet && isOk) {
				isOk = filterEngine.isOk(party, facet);
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
			//this.sort(); // not needed here since manually triggered in the view.
		});
	}

	/**
	 * Return the URL to be used.
	 *
	 * @returns {string}
	 */
	url() {
		// Compute the final election identifier.
		var electionIdentifier = EasyvoteSmartvote.currentElection;
		if (EasyvoteSmartvote.relatedElection > 0) {
			electionIdentifier = EasyvoteSmartvote.relatedElection;
		}

		return '/routing/parties/' + electionIdentifier + '?id=' + EasyvoteSmartvote.pageUid + '&L=' + EasyvoteSmartvote.sysLanguageUid;
	}

	/**
	 * @return PartyCollection
	 */
	static getInstance() {
		if (!this.instance) {
			this.instance = new PartyCollection();
		}
		return this.instance;
	}

}