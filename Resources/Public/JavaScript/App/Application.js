"use strict";

import QuestionListView from './Views/QuestionListView';
import CandidateListView from './Views/CandidateListView';
import SpiderChart from './Chart/SpiderChart';

$(() => {
	new QuestionListView();
	new CandidateListView();
	SpiderChart.getInstance().draw();
});