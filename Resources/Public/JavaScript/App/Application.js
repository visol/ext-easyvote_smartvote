"use strict";

import QuestionListView from './QuestionListView';
import Chart from './Chart';

$(() => {
	new QuestionListView();
	Chart.getInstance().draw();
});
