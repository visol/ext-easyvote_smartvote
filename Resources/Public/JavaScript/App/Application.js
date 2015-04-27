"use strict";

import Poll from './Poll.js'
var poll = new Poll();

let url = 'routing/questions/' + EasyvoteSmartvote.currentElection;
poll.load(url)
	.then((questions) => {

		var data = {
			questions: questions,
			index: () => {
				return ++window['INDEX'] || (window['INDEX'] = 1);
			},
			resetIndex: () => {
				window['INDEX'] = null;
			}
		};
		let template = $('#template-questions').html();
		let info = Mustache.render(template, data);
		//console.log(Mustache.render(template, data));
		$('#container-questions').html(info);

	}, (err) => {
		let message = 'Something when wrong when loading the data';
		$('#container-questions').html(message);
		console.log(err); // Error: "It broke"
	}
);
