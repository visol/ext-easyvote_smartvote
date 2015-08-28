/*jshint esnext:true */
import QuestionCollection from '../Collections/QuestionCollection'

/*
 * This file is part of the TYPO3 CMS project.
 *
 * See LICENSE.txt that was shipped with this package.
 */

export default class PartyModel extends Backbone.Model {

	/**
	 * @returns {{matching: number}}
	 */
	defaults() {
		return {
			matching: null
		};
	}

}
