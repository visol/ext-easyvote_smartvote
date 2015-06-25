/*jshint esnext:true */

/*
 * This file is part of the TYPO3 CMS project.
 *
 * See LICENSE.txt that was shipped with this package.
 */

export default class QuestionModel extends Backbone.Model {

	/**
	 * @returns {{name: string, answer: number, index: number, visible: boolean}}
	 */
	defaults() {

		this.counter = this.counter++ || 1;
		return {
			name: '',
			answer: 100,
			index: 0,
			cleavage1: 0,
			cleavage2: 0,
			cleavage3: 0,
			cleavage4: 0,
			cleavage5: 0,
			cleavage6: 0,
			cleavage7: 0,
			cleavage8: 0,
			visible: false
		};
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
		return '/routing/state/' + token;
	}

}
