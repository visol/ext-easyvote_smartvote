/*jshint esnext:true */

/*
 * This file is part of the TYPO3 CMS project.
 *
 * See LICENSE.txt that was shipped with this package.
 */

export default class RadarChartPlotter {

	static plot(id, d, options) {
		var config = {
			radius: 5,
			w: 600,
			h: 600,
			factor: 1,
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
			color: d3.scale.category10()
		};

		if ('undefined' !== typeof options) {
			for (var i in options) {
				if ('undefined' !== typeof options[i]) {
					config[i] = options[i];
				}
			}
		}
		config.maxValue = Math.max(config.maxValue, d3.max(d, function(i) {
			return d3.max(i.map(function(o) {
				return o.value;
			}))
		}));
		var allAxis = (d[0].map(function(i, j) {
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

		// append rectangle with background image
		d3.select(id).selectAll('svg')
			.insert('rect', ":first-child")
			.attr('height', '240')
			.attr('width', '240')
			.attr('fill', 'url(#image)')
			.attr('transform', "translate(" + config.TranslateX + "," + config.TranslateY + ")");

		// append defs > pattern to load the background image
		d3.select(id).selectAll('svg')
			.insert('defs', ":first-child")
			.append('pattern')
			.attr('id', 'image')
			.attr('width', '1')
			.attr('height', '1')
			.append('image')
			.attr('xlink:href', '/typo3conf/ext/easyvote_smartvote/Resources/Public/Images/spider-labels.png')
			.attr('width', '240')
			.attr('height', '240')
		;

		var tooltip;

		//Circular segments
		for (var j = 0; j < config.levels - 1; j++) {
			var levelFactor = config.factor * radius * ((j + 1) / config.levels);
			g.selectAll(".levels")
				.data(allAxis)
				.enter()
				.append("svg:line")
				.attr("x1", function(d, i) {
					return levelFactor * (1 - config.factor * Math.sin(i * config.radians / total));
				})
				.attr("y1", function(d, i) {
					return levelFactor * (1 - config.factor * Math.cos(i * config.radians / total));
				})
				.attr("x2", function(d, i) {
					return levelFactor * (1 - config.factor * Math.sin((i + 1) * config.radians / total));
				})
				.attr("y2", function(d, i) {
					return levelFactor * (1 - config.factor * Math.cos((i + 1) * config.radians / total));
				})
				.attr('class', "line")
				.style("stroke", "grey")
				.style("stroke-opacity", "0.75")
				.style("stroke-width", "0.3px")
				.attr('transform', "translate(" + (config.w / 2 - levelFactor) + ", " + (config.h / 2 - levelFactor) + ")");
		}

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

		var series = 0;

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


		var dataValues = [];
		d.forEach(function(y, x) {
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
				.attr('class', "radar-chart-serie" + series)
				.style("stroke-width", "2px")
				.style("stroke", config.color(series))
				.attr("points", function(d) {
					var str = "";
					for (var pti = 0; pti < d.length; pti++) {
						str = str + d[pti][0] + "," + d[pti][1] + " ";
					}
					return str;
				})
				.style("fill", function(j, i) {
					return config.color(series)
				})
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
			series++;
		});
		series = 0;

		d.forEach(function(y, x) {
			g.selectAll(".nodes")
				.data(y).enter()
				.append("svg:circle")
				.attr('class', "radar-chart-serie" + series)
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
				.style("fill", config.color(series)).style("fill-opacity", .9)
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

			series++;
		});
		//Tooltip
		//tooltip = g.append('text')
		//		   .style('opacity', 0)
		//		   .style('font-family', 'sans-serif')
		//		   .style('font-size', '13px');
	}
}