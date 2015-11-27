/*jshint esnext:true */

/*
 * This file is part of the TYPO3 CMS project.
 *
 * See LICENSE.txt that was shipped with this package.
 */

export default class SpiderChartPlotter {

	/**
	 * Constructor
	 */
	constructor(options) {
		this.config = {
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
					this.config[i] = options[i];
				}
			}
		}
	}

	/**
	 * @param {string} id
	 * @param {object} serie1
	 * @param {string} serieName1
	 * @param {object} serie2
	 * @param {string} serieName2
	 */
	plot(id, serie1, serieName1 = '', serie2 = [], serieName2 = '') {

		this.id = id;

		this.config.maxValue = Math.max(this.config.maxValue, d3.max(serie1, function(i) {
			return d3.max(i.map(function(o) {
				return o.value;
			}))
		}));

		var allAxis = (serie1[0].map(function(i, j) {
			return i.axis
		}));

		var total = allAxis.length;
		var radius = this.config.factor * Math.min(this.config.w / 2, this.config.h / 2);
		var Format = d3.format('%');
		d3.select(id).select('svg').remove();
		d3.select(id)
			.append('svg')
			.attr('width', this.config.w + this.config.ExtraWidthX)
			.attr('height', this.config.h + this.config.ExtraWidthY);

		/**
		 * Function that returns a SVG path
		 * Example: m14,120 a114,114 0 0 1 228,0
		 *
		 * @param {int} sweepFlag
		 * @param {float} adjustment
		 * @param {object} config
		 * @returns {string}
		 */
		function getPathData(sweepFlag, adjustment = 0.95, config) {
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
					return getPathData(sweepFlag, adjustment, this.config)
				},
				id: 'curvedTextPathUp'
			});

		// Draw first invisible path for the text, upper demi-circle
		d3.select(id).selectAll('svg')
			.insert('defs')
			.append('path')
			.attr({
				d: () => {
					let sweepFlag = 1;
					let adjustment = 0.82;
					return getPathData(sweepFlag, adjustment, this.config)
				},
				id: 'curvedTextPathUpInnerCircle'
			});


		// Draw second invisible path for the text, upper demi-circle
		d3.select(id).selectAll('svg')
			.insert('defs')
			.append('path')
			.attr({
				d: () => {
					let sweepFlag = 0;
					let adjustment = 1.08;
					return getPathData(sweepFlag, adjustment, this.config)
				},
				id: 'curvedTextPathDown'
			});

		// Draw second invisible path for the text, upper demi-circle
		d3.select(id).selectAll('svg')
			.insert('defs')
			.append('path')
			.attr({
				d: () => {
					let sweepFlag = 0;
					let adjustment = 1;
					return getPathData(sweepFlag, adjustment, this.config)
				},
				id: 'curvedTextPathDownInnerCircle'
			});

		// Debug: to see the path where the text is written
		//d3.select(id).selectAll('svg')
		//	.append('path')
		//	.attr({
		//		d: function() {
		//			let sweepFlag = 0;
		//			return getPathData(sweepFlag, this.config)
		//		},
		//		fill: 'red',
		//		opacity: '0.4',
		//		id: 'visiblePath'
		//	});

		var dataSet = this.getDataSet();
		var config = this.config;

		// Loop around the dataset and write text + draw lines around the axis.
		var index = 0;
		for (index = 0; index < dataSet.length; index++) {
			this.drawLabelLevel1(index);
			this.drawLabelLevel2(index);
			this.drawAxis(index);
		}

		// Circular segments
		for (index = 0; index < this.config.levels - 1; index++) {

			var _radius = Math.min(this.config.w / 2, this.config.h / 2);
			var circleRadius = (_radius / this.config.levels) * (index + 1);
			var translateAxisX = this.config.w / 2 + this.config.TranslateX;
			var translateAxisY = this.config.h / 2 + this.config.TranslateY;

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

		// Spider graph
		var g = d3.select(id)
			.selectAll('svg')
			.insert('g')
			.attr('transform', "translate(" + this.config.TranslateX + "," + this.config.TranslateY + ")");

		var axis = g.selectAll('.axis')
			.data(allAxis)
			.enter()
			.append('g')
			.attr('class', 'axis');

		//Tooltip
		var tooltip = d3.select(id)
				.selectAll('svg')
				.insert('text')
				.style('opacity', 0)
				.style('font-family', 'Arial,Helvetica,sans-serif')
				.style('font-weight', 'bold')
				.style('font-size', '11px');

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

		var counter = 0;
		var series = [
			{points: serie2, color: '#E5005E', name: serieName2},
			{points: serie1, color: this.config.color, name: serieName1}
		];

		for (var serie of series) {
			if (serie.points.length > 0 && serie.points[0].length === 0) {
				// Hotfix for https://redmine.visol.ch/issues/1263
				continue;
			}

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
					.attr('data-name', serie.name)
					.attr("points", function(d) {
						var str = "";
						for (var pti = 0; pti < d.length; pti++) {
							str = str + d[pti][0] + "," + d[pti][1] + " ";
						}
						return str;
					})
					.style("fill", serie.color)
					.style("fill-opacity", config.opacityArea)
					.on('mousemove', function(d) {

						// Get the mouse coordinate.
						var coordinates = d3.mouse(this);
						var newX = coordinates[0];
						var newY = coordinates[1];

						// Fetch name from the polygon
						var name = d3.select(this).attr('data-name');

						// Activate tooltip
						tooltip
							.attr('x', newX - 50) // offset-x so that the tooltip is centered.
							.attr('y', newY)
							.text(name)
							.transition(0)
							.style('fill', '#333')
							.style('opacity', 1);
					})
					.on('mouseout', function() {
						tooltip.style('opacity', 0);
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
					.append("svg:title");
				//.text(function(j){return Math.max(j.value, 0)});

				counter++;
			});
		}
	}

	/**
	 * Draw label of "level" 1.
	 *
	 * @param {string} index
	 */
	drawLabelLevel1(index) {

		var dataSet = this.getDataSet();

		// Label 1
		d3.select(this.id).select('svg')
				.append('text')
				.attr('text-anchor', 'middle')
				.attr('transform', () => {
					let realWidth = this.config.w + 2 * this.config.TranslateX;
					return 'rotate(' + dataSet[index].rotation + ',' + realWidth / 2 + ',' + realWidth / 2 + ')';
				})
				.style({
					'font-family': 'Arial,Helvetica,sans-serif',
					'font-size': "10px"
				})
				.append('textPath')
				.attr({
					startOffset: '50%',
					'xlink:href': '#' + dataSet[index].path
				})
				.text(dataSet[index].text1)
		;
	}

	/**
	 * Draw label of "level" 2.
	 *
	 * @param {string} index
	 */
	drawLabelLevel2(index) {

		var dataSet = this.getDataSet();

		// Label 2
		d3.select(this.id).select('svg')
				.append('text')
				.attr('text-anchor', 'middle')
				.attr('transform', () => {
					let realWidth = this.config.w + 2 * this.config.TranslateX;
					return 'rotate(' + dataSet[index].rotation + ',' + realWidth / 2 + ',' + realWidth / 2 + ')';
				})
				.style({
					'font-family': 'Arial,Helvetica,sans-serif',
					'font-size': "10px"
				})
				.append('textPath')
				.attr({
					startOffset: '50%',
					'xlink:href': '#' + dataSet[index].path + 'InnerCircle'
				})
				.text(dataSet[index].text2);
	}


	/**
	 * @param {string} index
	 */
	drawAxis(index) {

		var dataSet = this.getDataSet();

		// Draw the axis
		d3.select(this.id).selectAll('svg')
				.append('path')
				.attr({
					d: () => {

						let point1X = this.config.w / 2 + this.config.TranslateX;
						let point1Y = this.config.h / 2 + this.config.TranslateY;

						let point2X = this.config.w - (this.config.TranslateX * 2);
						let point2Y = this.config.h / 2 + this.config.TranslateY;

						return 'M ' + point1X + ', ' + point1Y + ' L ' + point2X + ', ' + point2Y
					},
					stroke: 'grey',
					'stroke-width': '0.3px',
					'stroke-opacity': '0.75',
					transform: object => {

						let unitAngle = 360 / dataSet.length;
						let angle = unitAngle * dataSet[index].position;

						let rotationOriginPointX = this.config.w / 2 + this.config.TranslateX;
						let rotationOriginPointY = this.config.h / 2 + this.config.TranslateY;

						return 'rotate(' + angle + ' , ' + rotationOriginPointX + ', ' + rotationOriginPointY + ')';
					}
				});
	}

	/**
	 * @returns {*[]}
	 */
	getDataSet() {
		return [
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
	}
}