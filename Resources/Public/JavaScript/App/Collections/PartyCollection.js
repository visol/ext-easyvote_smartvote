/*jshint esnext:true */
import PartyModel from '../Models/PartyModel'

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
				this.create(model);
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