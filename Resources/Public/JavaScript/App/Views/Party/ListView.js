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

		// Important: define listener before fetching data.
		this.listenTo(partyCollection, 'sort reset', this.render);
		this.listenTo(Backbone, 'facet:changed', this.render, this);

		// Load first the Question collection.
		/** @var questionCollection QuestionCollection */
		QuestionCollection.getInstance().load().done(() => {

			// Fetch parties.
			partyCollection.fetch().done(() => {
				partyCollection.sort(); // will trigger the rendering.
			});
		});

		// Call parent constructor.
		super();
	}

	/**
	 * Render the view.
	 */
	render() {

		var filteredParties = PartyCollection.getInstance().getFilteredParties();

		// Render intermediate content in a temporary DOM.
		var container = document.createDocumentFragment();
		for (let party of filteredParties) {
			let content = this.renderOne(party);
			container.appendChild(content);
		}

		// Finally update the DOM.
		$('#container-party-list').html(container);
	}

	/**
	 * @param argument
	 */
	changeAnswer(argument) {
		let party = argument.attributes;

		this.updateChart(party);

		let partyCollection = PartyCollection.getInstance();
		let nextIndex = (partyCollection.length - 1) - party.index;
		let nextParty = partyCollection.at(nextIndex);
		nextParty.trigger('visible');
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
