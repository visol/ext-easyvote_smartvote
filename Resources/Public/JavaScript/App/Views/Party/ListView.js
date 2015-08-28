/*jshint esnext:true */
import PartyCollection from '../../Collections/PartyCollection'
import PartyView from './PartyView'
import QuestionCollection from '../../Collections/QuestionCollection'

/*
 * This file is part of the TYPO3 CMS project.
 *
 * See LICENSE.txt that was shipped with this package.
 */

export default class ListView extends Backbone.View {

	/**
	 * Constructor
	 *
	 * @param options
	 */
	constructor(options) {
		// Instead of generating a new element, bind to the existing skeleton of
		// the App already present in the HTML.
		this.setElement($('#container-parties'), true);

		/** @var partyCollection PartyCollection*/
		var partyCollection = PartyCollection.getInstance();

		// Fetch parties.
		partyCollection.fetch().done(() => {
			this.render();
		});

		// Call parent constructor.
		super();
	}

	/**
	 * Render the view.
	 */
	render() {

		var parties = PartyCollection.getInstance().filter();
		// Render intermediate content in a temporary DOM.
		var container = document.createDocumentFragment();
		for (let party of parties) {
			let content = this.renderOne(party);
			container.appendChild(content);
		}

		// Finally update the DOM.
		$('#container-party-list').html(container);

		// Add lazy loading to images.
		$("img.lazy", $('#container-party-list')).lazyload();
	}

	/**
	 * Add a single party item to the list by creating a view for it, then
	 * appending its element to the `<div>`.
	 * @param model
	 */
	renderOne(model) {
		let view = new PartyView({model});
		return view.render();
	}

	/**
	 * @return {bool}
	 * @private
	 */
	_isAnonymous() {
		return !EasyvoteSmartvote.isUserAuthenticated
	}

}
