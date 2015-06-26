"use strict";

import QuestionListView from './Views/QuestionListView';
import RadarChart from './Chart/RadarChart';

$(() => {
	new QuestionListView();
	RadarChart.getInstance().draw();
});