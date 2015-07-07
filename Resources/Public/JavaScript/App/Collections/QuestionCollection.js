/*jshint esnext:true */
import QuestionModel from '../Models/QuestionModel'

/*
 * This file is part of the TYPO3 CMS project.
 *
 * See LICENSE.txt that was shipped with this package.
 */

export default class QuestionCollection extends Backbone.Collection {

	/**
	 * @param options
	 */
	constructor(options) {
		super(options);

		// Hold a reference to this collection's model.
		this.model = QuestionModel;
	}

	/**
	 * Anonymous User uses the localStorage as a first storage.
	 *
	 * @returns {*}
	 */
	fetchForAnonymousUser() {

		// Save all of the question items under the `'questions'` namespace for anonymous user.
		this.localStorage = new Backbone.LocalStorage('questions-' + this.getToken());

		// Check whether localStorage contains record about this collection
		let records = this.localStorage.findAll();
		if (_.isEmpty(records)) {
			return Backbone.ajaxSync('read', this).done(models => {
				for (let model of models) {
					this.create(model, {sort: false});
				}
			});
		} else {
			// call original fetch method
			return super.fetch();
		}
	}

	/**
	 * @return bool
	 */
	hasCompletedAnswers() {
		var hasAnswers = false;
		this.each(question => {
			let answer = question.get('answer');
			if (Number.isInteger(answer)) {
				hasAnswers = true;
			}
		});

		return hasAnswers;
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
	 * Return the URL to be used.
	 *
	 * @returns {string}
	 */
	url() {
		var token = '';
		if (EasyvoteSmartvote.isUserAuthenticated) {
			token += '&token=' + this.getToken();
		}

		// Compute the final election identifier.
		var electionIdentifier = EasyvoteSmartvote.currentElection;
		if (EasyvoteSmartvote.relatedElection > 0) {
			electionIdentifier = EasyvoteSmartvote.relatedElection;
		}

		return '/routing/questions/' + electionIdentifier + '?id=' + EasyvoteSmartvote.pageUid + '&L=' + EasyvoteSmartvote.sysLanguageUid + token;
	}

	/**
	 * @return array
	 */
	getRapideQuestions() {
		return this.filter(question => question.get('rapide'));
	}

	/**
	 * @return QuestionCollection
	 */
	static getInstance() {
		if (!this.instance) {
			this.instance = new QuestionCollection();
		}
		return this.instance;
	}

	/**
	 * @returns {*}
	 */
	load() {
		if (this._isAnonymous()) {
			return this.fetchForAnonymousUser();
		} else {
			return super.fetch();
		}
	}

	/**
	 * Return the total number of questions for this collection.
	 *
	 * @returns int
	 */
	count() {
		return this.getRapideQuestions().length;
	}

	/**
	 * Return the number of visible questions.
	 *
	 * @returns int
	 */
	countVisible() {
		return this.filter(question => question.get('visible') && question.get('rapide')).length;
	}

	/**
	 * @return {bool}
	 * @private
	 */
	_isAnonymous() {
		return !EasyvoteSmartvote.isUserAuthenticated
	}

}