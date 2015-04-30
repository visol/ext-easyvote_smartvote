/*jshint esnext:true */

/*
 * This file is part of the TYPO3 CMS project.
 *
 * See LICENSE.txt that was shipped with this package.
 */

export default class QuestionModel extends Backbone.Model {

	/**
	 *
	 * @returns {{name: string, answer: number, index: number, visible: boolean}}
	 */
	defaults() {

		this.counter = this.counter++ || 1;
		return {
			name: '',
			answer: 100,
			index: QuestionModel.getIndex(),
			visible: false
		};
	}

	/**
	 * Setter for property "answer".
	 */
	setAnswer(value) {
		console.log(value);
		this.set('answer', parseInt(value));
		this.set('visible', !this.get('visible')); // @todo toggle
	}

	/**
	 * Return the URL being used.
	 *
	 * @returns {string}
	 */
	url() {
		return 'routing/state/';
	}

	/**
	 * Return an incremental index
	 *
	 * @returns {number}
	 */
	static getIndex() {

		if (typeof QuestionModel.counter === 'undefined') {
			QuestionModel.counter = 0;
		}
		QuestionModel.counter++; // increment
		return QuestionModel.counter;
	}
}
