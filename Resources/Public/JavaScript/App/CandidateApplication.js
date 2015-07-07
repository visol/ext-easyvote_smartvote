"use strict";

import ListView from './Views/Candidate/ListView';
import FacetView from './Views/Candidate/FacetView';

$(() => {
	new FacetView().render();
	new ListView();
});