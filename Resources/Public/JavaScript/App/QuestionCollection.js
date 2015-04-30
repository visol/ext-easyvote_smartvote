/*jshint esnext:true */
import QuestionModel from './QuestionModel'

/*
 * This file is part of the TYPO3 CMS project.
 *
 * See LICENSE.txt that was shipped with this package.
 */

export default class QuestionCollection extends Backbone.Collection {

	/**
	 *
	 * @param options
	 */
	constructor(options) {
		super(options);

		// *Hold a reference to this collection's model.*
		this.model = QuestionModel;

		// *Save all of the question items under the `'questions'` namespace.*
		//this.localStorage = new Backbone.LocalStorage('smartvote-questions');
	}

	/**
	 * Fetch the data.
	 *
	 * @returns {*}
	 */
	fetch() {
		return super.fetch();
	}

	/**
	 * Return the URL being used.
	 *
	 * @returns {string}
	 */
	url() {
		return 'routing/questions/' + EasyvoteSmartvote.currentElection;
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


}