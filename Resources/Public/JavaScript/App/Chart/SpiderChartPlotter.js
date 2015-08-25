/*jshint esnext:true */

/*
 * This file is part of the TYPO3 CMS project.
 *
 * See LICENSE.txt that was shipped with this package.
 */

export default class SpiderChartPlotter {

	static plot(id, serie1, options, serie2 = []) {

		var config = {
			radius: 5,
			w: 600,
			h: 600,
			factor: 0.8, // was changed from original, default was 1
			factorLegend: .85,
			levels: 3,
			maxValue: 0,
			radians: 2 * Math.PI,
			opacityArea: 0.5,
			ToRight: 5,
			TranslateX: 8,
			TranslateY: 8,
			ExtraWidthX: 16,
			ExtraWidthY: 16,
			color: '#1f77b4'
		};

		if ('undefined' !== typeof options) {
			for (var i in options) {
				if ('undefined' !== typeof options[i]) {
					config[i] = options[i];
				}
			}
		}
		config.maxValue = Math.max(config.maxValue, d3.max(serie1, function(i) {
			return d3.max(i.map(function(o) {
				return o.value;
			}))
		}));
		var allAxis = (serie1[0].map(function(i, j) {
			return i.axis
		}));
		var total = allAxis.length;
		var radius = config.factor * Math.min(config.w / 2, config.h / 2);
		var Format = d3.format('%');
		d3.select(id).select('svg').remove();

		var g = d3.select(id)
			.append('svg')
			.attr('width', config.w + config.ExtraWidthX)
			.attr('height', config.h + config.ExtraWidthY)
			.append('g')
			.attr('transform', "translate(" + config.TranslateX + "," + config.TranslateY + ")");

		/**
		 * Function that returns a SVG path
		 * Example: m14,120 a114,114 0 0 1 228,0
		 *
		 * @param {int} sweepFlag
		 * @param {float} adjustment
		 * @returns {string}
		 */
		function getPathData(sweepFlag, adjustment = 0.95) {
			// adjust the radius a little so our text's baseline isn't sitting directly on the circle
			var radiusWithoutScalingFactor = Math.min(config.w / 2, config.h / 2);
			var r = radiusWithoutScalingFactor * adjustment;
			var startX = config.w / 2 - r + config.TranslateX;
			return 'm' + startX + ',' + (config.h / 2) + ' ' +
				'a' + r + ',' + r + ' 0 0 ' + sweepFlag + ' ' + (2 * r) + ',0';
		}

		// Draw first invisible path for the text, upper demi-circle
		d3.select(id).selectAll('svg')
			.insert('defs')
			.append('path')
			.attr({
				d: () => {
					let sweepFlag = 1;
					let adjustment = 0.90;
					return getPathData(sweepFlag, adjustment)
				},
				id: 'curvedTextPathUp'
			})
		;


		// Draw first invisible path for the text, upper demi-circle
		d3.select(id).selectAll('svg')
			.insert('defs')
			.append('path')
			.attr({
				d: () => {
					let sweepFlag = 1;
					let adjustment = 0.82;
					return getPathData(sweepFlag, adjustment)
				},
				id: 'curvedTextPathUpInnerCircle'
			})
		;


		// Draw second invisible path for the text, upper demi-circle
		d3.select(id).selectAll('svg')
			.insert('defs')
			.append('path')
			.attr({
				d: () => {
					let sweepFlag = 0;
					let adjustment = 1.08;
					return getPathData(sweepFlag, adjustment)
				},
				id: 'curvedTextPathDown'
			})
		;

		// Draw second invisible path for the text, upper demi-circle
		d3.select(id).selectAll('svg')
			.insert('defs')
			.append('path')
			.attr({
				d: () => {
					let sweepFlag = 0;
					let adjustment = 1;
					return getPathData(sweepFlag, adjustment)
				},
				id: 'curvedTextPathDownInnerCircle'
			})
		;

		// Debug: to see the path where the text is written
		//d3.select(id).selectAll('svg')
		//	.append('path')
		//	.attr({
		//		d: function() {
		//			let sweepFlag = 0;
		//			return getPathData(sweepFlag)
		//		},
		//		fill: 'red',
		//		opacity: '0.4',
		//		id: 'visiblePath'
		//	});

		var dataset = [
			{
				position: 1,
				text1: EasyvoteSmartvote.cleavage1Text1,
				text2: EasyvoteSmartvote.cleavage1Text2,
				rotation: 0,
				path: 'curvedTextPathUp'
			},
			{
				position: 2,
				text1: EasyvoteSmartvote.cleavage2Text1,
				text2: EasyvoteSmartvote.cleavage2Text2,
				rotation: 45,
				path: 'curvedTextPathUp'
			},
			{
				position: 3,
				text1: EasyvoteSmartvote.cleavage3Text1,
				text2: EasyvoteSmartvote.cleavage3Text2,
				rotation: 90,
				path: 'curvedTextPathUp'
			},
			{
				position: 4,
				text1: EasyvoteSmartvote.cleavage4Text1,
				text2: EasyvoteSmartvote.cleavage4Text2,
				rotation: -45,
				path: 'curvedTextPathUp'
			},
			{
				position: 5,
				text1: EasyvoteSmartvote.cleavage5Text1,
				text2: EasyvoteSmartvote.cleavage5Text2,
				rotation: -45,
				path: 'curvedTextPathDown'
			},
			{
				position: 6,
				text1: EasyvoteSmartvote.cleavage6Text1,
				text2: EasyvoteSmartvote.cleavage6Text2,
				rotation: 0,
				path: 'curvedTextPathDown'
			},
			{
				position: 7,
				text1: EasyvoteSmartvote.cleavage7Text1,
				text2: EasyvoteSmartvote.cleavage7Text2,
				rotation: 45,
				path: 'curvedTextPathDown'
			},
			{
				position: 8,
				text1: EasyvoteSmartvote.cleavage8Text1,
				text2: EasyvoteSmartvote.cleavage8Text2,
				rotation: -90,
				path: 'curvedTextPathUp'
			}
		];

		// Loop around the dataset and write text + draw lines around the axis.
		for (j = 0; j < dataset.length; j++) {

			// Label 1
			d3.select(id).select('svg')
				.append('text')
				.attr('text-anchor', 'middle')
				.attr('transform', function() {
					let realWidth = config.w + 2 * config.TranslateX;
					return 'rotate(' + dataset[j].rotation + ',' + realWidth / 2 + ',' + realWidth / 2 + ')';
				})
				.style({
					'font-family': 'Arial,Helvetica,sans-serif',
					'font-size': "10px"
				})
				.append('textPath')
				.attr({
					startOffset: '50%',
					'xlink:href': '#' + dataset[j].path
				})
				.text(dataset[j].text1)
			;


			// Label 2
			d3.select(id).select('svg')
				.append('text')
				.attr('text-anchor', 'middle')
				.attr('transform', function() {
					let realWidth = config.w + 2 * config.TranslateX;
					return 'rotate(' + dataset[j].rotation + ',' + realWidth / 2 + ',' + realWidth / 2 + ')';
				})
				.style({
					'font-family': 'Arial,Helvetica,sans-serif',
					'font-size': "10px"
				})
				.append('textPath')
				.attr({
					startOffset: '50%',
					'xlink:href': '#' + dataset[j].path + 'InnerCircle'
				})
				.text(dataset[j].text2)
			;

			// Draw the axe
			d3.select(id).selectAll('svg')
				.append('path')
				.attr({
					d: () => {

						let point1X = config.w / 2 + config.TranslateX;
						let point1Y = config.h / 2 + config.TranslateY;

						let point2X = config.w - (config.TranslateX * 2);
						let point2Y = config.h / 2 + config.TranslateY;

						return 'M ' + point1X + ', ' + point1Y + ' L ' + point2X + ', ' + point2Y
					},
					stroke: 'grey',
					'stroke-width': '0.3px',
					'stroke-opacity': '0.75',
					transform: object => {

						let unitAngle = 360 / dataset.length;
						let angle = unitAngle * dataset[j].position;

						let rotationOriginPointX = config.w / 2 + config.TranslateX;
						let rotationOriginPointY = config.h / 2 + config.TranslateY;

						return 'rotate(' + angle + ' , ' + rotationOriginPointX + ', ' + rotationOriginPointY + ')';
					}
				});
		}

		// Circular segments
		var j = 0;
		for (j = 0; j < config.levels - 1; j++) {

			var _radius = Math.min(config.w / 2, config.h / 2);
			var circleRadius = (_radius / config.levels) * (j + 1);
			var translateAxisX = config.w / 2 + config.TranslateX;
			var translateAxisY = config.h / 2 + config.TranslateY;

			d3.select(id).selectAll('svg')
				.insert('circle')
				.attr({
					cx: '0',
					cy: '0',
					r: circleRadius,
					fill: 'none',
					stroke: 'grey',
					'stroke-width': '0.3px',
					'stroke-opacity': '0.75',
					transform: 'translate(' + translateAxisX + ', ' + translateAxisY + ')'
				})
			;
		}

		// Previous spider lines, which was replaced by circles
		//for (var j = 0; j < config.levels; j++) {
		//	var levelFactor = config.factor * radius * ((j + 1) / config.levels);
		//	g.selectAll(".levels")
		//		.data(allAxis)
		//		.enter()
		//		.append("svg:line")
		//		.attr("x1", function(d, i) {
		//			return levelFactor * (1 - config.factor * Math.sin(i * config.radians / total));
		//		})
		//		.attr("y1", function(d, i) {
		//			return levelFactor * (1 - config.factor * Math.cos(i * config.radians / total));
		//		})
		//		.attr("x2", function(d, i) {
		//			return levelFactor * (1 - config.factor * Math.sin((i + 1) * config.radians / total));
		//		})
		//		.attr("y2", function(d, i) {
		//			return levelFactor * (1 - config.factor * Math.cos((i + 1) * config.radians / total));
		//		})
		//		.attr('class', "line")
		//		.style("stroke", "grey")
		//		.style("stroke-opacity", "0.75")
		//		.style("stroke-width", "0.3px")
		//		.attr('transform', "translate(" + (config.w / 2 - levelFactor) + ", " + (config.h / 2 - levelFactor) + ")");
		//}

		//Text indicating at what % each level is
		//for(var j=0; j<config.levels; j++){
		//  var levelFactor = config.factor*radius*((j+1)/config.levels);
		//  g.selectAll(".levels")
		//   .data([1]) //dummy data
		//   .enter()
		//   .append("svg:text")
		//   .attr("x", function(d){return levelFactor*(1-config.factor*Math.sin(0));})
		//   .attr("y", function(d){return levelFactor*(1-config.factor*Math.cos(0));})
		//   .attr('class', "legend")
		//   .style("font-family", "sans-serif")
		//   .style("font-size", "10px")
		//   .attr('transform', "translate(" + (config.w/2-levelFactor + config.ToRight) + ", " + (config.h/2-levelFactor) + ")")
		//   .attr("fill", "#737373")
		//   .text(Format((j+1)*config.maxValue/config.levels));
		//}

		var axis = g.selectAll('.axis')
			.data(allAxis)
			.enter()
			.append('g')
			.attr('class', 'axis');

		//axis.append('line')
		//	.attr("x1", config.w / 2)
		//	.attr("y1", config.h / 2)
		//	.attr("x2", function(d, i) {
		//		return config.w / 2 * (1 - config.factor * Math.sin(i * config.radians / total));
		//	})
		//	.attr("y2", function(d, i) {
		//		return config.h / 2 * (1 - config.factor * Math.cos(i * config.radians / total));
		//	})
		//	.attr('class', 'line')
		//	.style('stroke', 'grey')
		//	.style('stroke-width', '1px');

		axis.append("text")
			.attr('class', "legend")
			.text(function(d) {
				return d
			})
			.style("font-family", "sans-serif")
			.style("font-size", "11px")
			.attr("text-anchor", "middle")
			.attr("dy", "1.5em")
			.attr('transform', function(d, i) {
				return "translate(0, -10)"
			})
			.attr("x", function(d, i) {
				return config.w / 2 * (1 - config.factorLegend * Math.sin(i * config.radians / total)) - 60 * Math.sin(i * config.radians / total);
			})
			.attr("y", function(d, i) {
				return config.h / 2 * (1 - Math.cos(i * config.radians / total)) - 20 * Math.cos(i * config.radians / total);
			});

		var tooltip;
		var counter = 0;
		var series = [
			{points: serie2, color: '#E5005E'},
			{points: serie1, color: config.color}
		];

		for (var serie of series) {

			var dataValues = [];
			serie.points.forEach(function(y, x) {
				g.selectAll(".nodes")
					.data(y, function(j, i) {
						dataValues.push([
							config.w / 2 * (1 - (parseFloat(Math.max(j.value, 0)) / config.maxValue) * config.factor * Math.sin(i * config.radians / total)),
							config.h / 2 * (1 - (parseFloat(Math.max(j.value, 0)) / config.maxValue) * config.factor * Math.cos(i * config.radians / total))
						]);
					});
				dataValues.push(dataValues[0]);
				g.selectAll(".area")
					.data([dataValues])
					.enter()
					.append("polygon")
					.attr('class', "radar-chart-serie" + counter)
					.style("stroke-width", "2px")
					.style("stroke", serie.color)
					.attr("points", function(d) {
						var str = "";
						for (var pti = 0; pti < d.length; pti++) {
							str = str + d[pti][0] + "," + d[pti][1] + " ";
						}
						return str;
					})
					.style("fill", serie.color)
					.style("fill-opacity", config.opacityArea)
					.on('mouseover', function(d) {
						z = "polygon." + d3.select(this).attr('class');
						g.selectAll("polygon")
							.transition(200)
							.style("fill-opacity", 0.1);
						g.selectAll(z)
							.transition(200)
							.style("fill-opacity", .7);
					})
					.on('mouseout', function() {
						g.selectAll("polygon")
							.transition(200)
							.style("fill-opacity", config.opacityArea);
					});
				counter++;
			});
			counter = 0;

			serie.points.forEach(function(y, x) {
				g.selectAll(".nodes")
					.data(y)
					.enter()
					.append("svg:circle")
					.attr('class', "radar-chart-serie" + counter)
					.attr('r', config.radius)
					.attr("alt", function(j) {
						return Math.max(j.value, 0)
					})
					.attr("cx", function(j, i) {
						dataValues.push([
							config.w / 2 * (1 - (parseFloat(Math.max(j.value, 0)) / config.maxValue) * config.factor * Math.sin(i * config.radians / total)),
							config.h / 2 * (1 - (parseFloat(Math.max(j.value, 0)) / config.maxValue) * config.factor * Math.cos(i * config.radians / total))
						]);
						return config.w / 2 * (1 - (Math.max(j.value, 0) / config.maxValue) * config.factor * Math.sin(i * config.radians / total));
					})
					.attr("cy", function(j, i) {
						return config.h / 2 * (1 - (Math.max(j.value, 0) / config.maxValue) * config.factor * Math.cos(i * config.radians / total));
					})
					.attr("data-id", function(j) {
						return j.axis
					})
					.style("fill", serie.color)
					.style("fill-opacity", .9)
					.on('mouseover', function(d) {
						newX = parseFloat(d3.select(this).attr('cx')) - 10;
						newY = parseFloat(d3.select(this).attr('cy')) - 5;

						//tooltip
						//	.attr('x', newX)
						//	.attr('y', newY)
						//	.text(Format(d.value))
						//	.transition(200)
						//	.style('opacity', 1);

						z = "polygon." + d3.select(this).attr('class');
						g.selectAll("polygon")
							.transition(200)
							.style("fill-opacity", 0.1);
						g.selectAll(z)
							.transition(200)
							.style("fill-opacity", .7);
					})
					.on('mouseout', function() {
						//tooltip
						//	.transition(200)
						//	.style('opacity', 0);
						g.selectAll("polygon")
							.transition(200)
							.style("fill-opacity", config.opacityArea);
					})
					.append("svg:title");
				//.text(function(j){return Math.max(j.value, 0)});

				counter++;
			});
			//Tooltip
			//tooltip = g.append('text')
			//		   .style('opacity', 0)
			//		   .style('font-family', 'sans-serif')
			//		   .style('font-size', '13px');

		}
	}
}