"use strict";

import ListView from './Views/Candidate/ListView';
import FacetView from './Views/Candidate/FacetView';


var eventBus = _.extend({}, Backbone.Events);


$(() => {
	new FacetView().render();
	new ListView();
});