"use strict";

import ListView from './Views/Question/ListView';
import SpiderChart from './Chart/SpiderChart';
import Responsive from './Responsive.js'

$(() => {
	new ListView();

	// Draw empty Spider Chart only if not yet initialized.
	if (!$('#chart').html()) {
		SpiderChart.getInstance().draw();
	}

	// Add some responsiveness feature such as the search form
	// which should be displayed elsewhere in the mobile layout.
	var responsive = new Responsive();
	responsive.bindAction();
});