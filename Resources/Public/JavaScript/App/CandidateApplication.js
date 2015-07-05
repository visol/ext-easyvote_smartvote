"use strict";

import CandidateListView from './Views/CandidateListView';
import CandidateFacetView from './Views/CandidateFacetView';
import Registry from './Registry';


var eventBus = _.extend({}, Backbone.Events);


$(() => {

	let facetView = new CandidateFacetView();
	facetView.render();

	// Register the facet view for later use.
	Registry.set('facetView', facetView);

	let listView = new CandidateListView();

	// Register the list view for later use.
	Registry.set('listView', listView);

});