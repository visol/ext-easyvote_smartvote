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
		return 'routing/state/' + token;
	}

}
