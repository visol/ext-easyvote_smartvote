"use strict";

import ListView from './Views/Candidate/ListView';
import FacetView from './Views/Candidate/FacetView';

$(() => {
	let facet = new FacetView();
	facet.render();

	new ListView({facet: facet});
});