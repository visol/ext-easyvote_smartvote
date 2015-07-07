/*jshint esnext:true */
import QuestionCollection from '../Collections/QuestionCollection'

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
			matching: null
		};
	}

	/**
	 * @returns {int}
	 */
	getMatching() {

		let questionCollection = QuestionCollection.getInstance();

		let matching = null;
		let candidateAnswers = this.get('answers');

		// true means the candidate has answered the survey which is normally the case but not always...
		if (questionCollection.hasCompletedAnswers() && candidateAnswers.length > 0) {

			let aggregatedResult = 0;
			let counter = 0;

			for (let candidateAnswer of candidateAnswers) {
				let userQuestion = this.retrieveQuestion(candidateAnswer);
				if (userQuestion) {
					if (userQuestion.get('answer') !== null && userQuestion.get('answer') !== -1) {
						aggregatedResult += Math.pow(userQuestion.get('answer') - candidateAnswer.answer, 2);
						counter++
					}
				} else {
					console.log('Warning #1435731882: I could not retrieve the question filled by the User ' + candidateAnswer.questionId);
				}
			}
			let distance = Math.sqrt(aggregatedResult);
			let maximalDistance = Math.sqrt(counter * Math.pow(100, 2));
			let nominalDistance = distance / maximalDistance;
			matching = Math.round(100 * (1 - nominalDistance));
		}

		this.set('matching', matching);
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
