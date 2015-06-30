/*jshint esnext:true */
import QuestionCollection from '../Collections/QuestionCollection'

var foo = 0;
/*
 * This file is part of the TYPO3 CMS project.
 *
 * See LICENSE.txt that was shipped with this package.
 */

export default class CandidateModel extends Backbone.Model {

	/**
	 * @returns {{matching: number}}
	 */
	defaults() {
		return {
			matching: 0
		};
	}

	matching() {

		//let questionCollection = QuestionCollection.getInstance();
		//console.log(questionCollection.size());

		//let answers = this.get('answers');
		//if (answers.length === questionCollection.length) {
		//
		//	if (foo === 0) {
		//
		//		for (let answer of answers) {
		//			console.log(answer);
		//		}
		//		//console.log(questionCollection);
		//		foo = 1;
		//	}
		//
		//	//answers.each(question => {
		//	//	console.log(answers);
		//	//});
		//	//questionCollection.each(question => {
		//	//	console.log(question.get('id'));
		//	//})
		//}

		this.set('matching', this.get('gender'));
		return this.get('matching');
	}

}
