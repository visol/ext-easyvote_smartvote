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
		return {};
	}

	/**
	 * Return the URL to be used.
	 *
	 * @returns {string}
	 */
	//url() {
	//	let token = '';
	//	if (EasyvoteSmartvote.isUserAuthenticated) {
	//		token += '?token=' + EasyvoteSmartvote.token;
	//	}
	//	return '/routing/state/' + token;
	//}

}
