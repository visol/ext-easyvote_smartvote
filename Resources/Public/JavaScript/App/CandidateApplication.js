"use strict";

import CandidateListView from './Views/CandidateListView';
import CandidateFacetView from './Views/CandidateFacetView';


var eventBus = _.extend({}, Backbone.Events);


$(() => {
	new CandidateFacetView().render();
	new CandidateListView();
});