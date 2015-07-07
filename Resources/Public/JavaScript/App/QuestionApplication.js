"use strict";

import ListView from './Views/Question/ListView';
import SpiderChart from './Chart/SpiderChart';

$(() => {
	new ListView();
	SpiderChart.getInstance().draw();
});