"use strict";

import QuestionListView from './Views/QuestionListView';
import SpiderChart from './Chart/SpiderChart';

$(() => {
	new QuestionListView();
	SpiderChart.getInstance().draw();
});