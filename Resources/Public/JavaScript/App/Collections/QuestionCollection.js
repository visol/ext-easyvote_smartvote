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

		// Save all of the question items under the `'questions'` namespace.
		if (this._isAnonymous()) {

			// Compute the token.
			let token = EasyvoteSmartvote.token;
			if (EasyvoteSmartvote.relatedToken) {
				token = EasyvoteSmartvote.relatedToken;
			}
			this.localStorage = new Backbone.LocalStorage('questions-' + token);
		}
	}

	/**
	 * @returns {*}
	 */
	fetchForAnonymousUser() {

		// Check whether localStorage contains record about this collection
		let records = this.localStorage.findAll();
		if (_.isEmpty(records)) {
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
	 * @return bool
	 */
	hasCompletedAnswers() {
		let hasAnswers = false;
		this.each(question => {
			let answer = question.get('answer');
			if (Number.isInteger(answer)) {
				hasAnswers = true;
			}
		});

		return hasAnswers;
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
			token += '&token=' + EasyvoteSmartvote.token;
		}

		// Compute the final election identifier.
		let electionIdentifier = EasyvoteSmartvote.currentElection;
		if (EasyvoteSmartvote.relatedElection > 0) {
			electionIdentifier = EasyvoteSmartvote.relatedElection;
		}

		return '/routing/questions/' + electionIdentifier + '?id=' + EasyvoteSmartvote.pageUid + '&L=' + EasyvoteSmartvote.sysLanguageUid + token;
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
	 * @return QuestionCollection
	 */
	load() {
		if (this._isAnonymous()) {
			this.fetchForAnonymousUser();
		} else {
			this.fetchForAuthenticatedUser();
		}
		return this;
	}


	/**
	 * Return the total number of questions in this collection.
	 *
	 * @returns int
	 */
	count() {
		return this.length;
	}

	/**
	 * Return the number of visible questions.
	 *
	 * @returns int
	 */
	countVisible() {
		return this.filter(question => question.get('visible')).length;
	}

	/**
	 * @return {bool}
	 * @private
	 */
	_isAnonymous() {
		return !EasyvoteSmartvote.isUserAuthenticated
	}

}