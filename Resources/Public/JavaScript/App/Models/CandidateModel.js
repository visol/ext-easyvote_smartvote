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

		let questionCollection = QuestionCollection.getInstance();

		let answers = this.get('answers');
		if (answers.length === questionCollection.size()) {


		}

		this.set('matching', this.get('gender'));
		return this.get('matching');
	}


	/**
	 * @param answer
	 * @returns Question
	 */
	retrieveQuestion(answer) {
		let questionCollection = QuestionCollection.getInstance();
		let questionId = answer.questionId;
		let question = questionCollection.get(questionId);
		if (!question) {
			let questions = questionCollection.where({alternativeId: questionId});
			if (questions.length > 0) {
				question = questions[0];
			}
		}
		return question;
	}

}
