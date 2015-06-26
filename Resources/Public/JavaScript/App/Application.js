"use strict";

import QuestionListView from './Views/QuestionListView';
import CandidateListView from './Views/CandidateListView';
import RadarChart from './Chart/RadarChart';

$(() => {
	new QuestionListView();
	new CandidateListView();
	RadarChart.getInstance().draw();
});