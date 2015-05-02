"use strict";

import QuestionListView from './QuestionListView';

$(() => {
	new QuestionListView();

	var data = [
		[
			{axis: "strength", value: 13},
			{axis: "intelligence", value: 1},
			{axis: "charisma", value: 8},
			{axis: "dexterity", value: 4},
			{axis: "luck", value: 9}
		]
	];

	RadarChart.draw("#chart", data, {w: 200, h: 200});

});

