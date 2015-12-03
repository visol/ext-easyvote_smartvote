"use strict";

import ListView from './Views/Candidate/ListView';
import FacetView from './Views/Candidate/FacetView';
import Responsive from './Responsive.js'
import EnvironmentChecker from './EnvironmentChecker.js'

$(() => {

	var environment = new EnvironmentChecker();
	var isOk = environment.isLocalStorageAvailable() && environment.isLocalStorageReady();

	if (isOk) {
		let facet = new FacetView();
		facet.render();

		new ListView({facet: facet});

		// Add some responsiveness feature such as the search form
		// which should be displayed elsewhere in the mobile layout.
		var responsive = new Responsive();
		responsive.bindAction();
	}
});