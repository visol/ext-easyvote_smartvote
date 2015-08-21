(function e(t,n,r){function s(o,u){if(!n[o]){if(!t[o]){var a=typeof require=="function"&&require;if(!u&&a)return a(o,!0);if(i)return i(o,!0);var f=new Error("Cannot find module '"+o+"'");throw f.code="MODULE_NOT_FOUND",f}var l=n[o]={exports:{}};t[o][0].call(l.exports,function(e){var n=t[o][1][e];return s(n?n:e)},l,l.exports,e,t,n,r)}return n[o].exports}var i=typeof require=="function"&&require;for(var o=0;o<r.length;o++)s(r[o]);return s})({1:[function(require,module,exports){
"use strict";

var _interopRequire = require("babel-runtime/helpers/interop-require")["default"];

var ListView = _interopRequire(require("./Views/Candidate/ListView"));

var FacetView = _interopRequire(require("./Views/Candidate/FacetView"));

$(function () {
	var facet = new FacetView();
	facet.render();

	new ListView({ facet: facet });
});
},{"./Views/Candidate/FacetView":11,"./Views/Candidate/ListView":12,"babel-runtime/helpers/interop-require":18}],2:[function(require,module,exports){
/*jshint esnext:true */

/*
 * This file is part of the TYPO3 CMS project.
 *
 * See LICENSE.txt that was shipped with this package.
 */

"use strict";

var _classCallCheck = require("babel-runtime/helpers/class-call-check")["default"];

var _createClass = require("babel-runtime/helpers/create-class")["default"];

var _core = require("babel-runtime/core-js")["default"];

var SpiderChartPlotter = (function () {
	function SpiderChartPlotter() {
		_classCallCheck(this, SpiderChartPlotter);
	}

	_createClass(SpiderChartPlotter, null, {
		plot: {
			value: function plot(id, serie1, options) {
				var serie2 = arguments[3] === undefined ? [] : arguments[3];

				var config = {
					radius: 5,
					w: 600,
					h: 600,
					factor: 0.8, // was changed from original, default was 1
					factorLegend: 0.85,
					levels: 3,
					maxValue: 0,
					radians: 2 * Math.PI,
					opacityArea: 0.5,
					ToRight: 5,
					TranslateX: 8,
					TranslateY: 8,
					ExtraWidthX: 16,
					ExtraWidthY: 16,
					color: "#1f77b4"
				};

				if ("undefined" !== typeof options) {
					for (var i in options) {
						if ("undefined" !== typeof options[i]) {
							config[i] = options[i];
						}
					}
				}
				config.maxValue = Math.max(config.maxValue, d3.max(serie1, function (i) {
					return d3.max(i.map(function (o) {
						return o.value;
					}));
				}));
				var allAxis = serie1[0].map(function (i, j) {
					return i.axis;
				});
				var total = allAxis.length;
				var radius = config.factor * Math.min(config.w / 2, config.h / 2);
				var Format = d3.format("%");
				d3.select(id).select("svg").remove();

				var g = d3.select(id).append("svg").attr("width", config.w + config.ExtraWidthX).attr("height", config.h + config.ExtraWidthY).append("g").attr("transform", "translate(" + config.TranslateX + "," + config.TranslateY + ")");

				/**
     * Function that returns a SVG path
     * Example: m14,120 a114,114 0 0 1 228,0
     *
     * @param {int} sweepFlag
     * @param {float} adjustment
     * @returns {string}
     */
				function getPathData(sweepFlag) {
					var adjustment = arguments[1] === undefined ? 0.95 : arguments[1];

					// adjust the radius a little so our text's baseline isn't sitting directly on the circle
					var radiusWithoutScalingFactor = Math.min(config.w / 2, config.h / 2);
					var r = radiusWithoutScalingFactor * adjustment;
					var startX = config.w / 2 - r + config.TranslateX;
					return "m" + startX + "," + config.h / 2 + " " + "a" + r + "," + r + " 0 0 " + sweepFlag + " " + 2 * r + ",0";
				}

				// Draw first invisible path for the text, upper demi-circle
				d3.select(id).selectAll("svg").insert("defs").append("path").attr({
					d: function () {
						var sweepFlag = 1;
						var adjustment = 0.9;
						return getPathData(sweepFlag, adjustment);
					},
					id: "curvedTextPathUp"
				});

				// Draw first invisible path for the text, upper demi-circle
				d3.select(id).selectAll("svg").insert("defs").append("path").attr({
					d: function () {
						var sweepFlag = 1;
						var adjustment = 0.82;
						return getPathData(sweepFlag, adjustment);
					},
					id: "curvedTextPathUpInnerCircle"
				});

				// Draw second invisible path for the text, upper demi-circle
				d3.select(id).selectAll("svg").insert("defs").append("path").attr({
					d: function () {
						var sweepFlag = 0;
						var adjustment = 1.08;
						return getPathData(sweepFlag, adjustment);
					},
					id: "curvedTextPathDown"
				});

				// Draw second invisible path for the text, upper demi-circle
				d3.select(id).selectAll("svg").insert("defs").append("path").attr({
					d: function () {
						var sweepFlag = 0;
						var adjustment = 1;
						return getPathData(sweepFlag, adjustment);
					},
					id: "curvedTextPathDownInnerCircle"
				});

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

				var dataset = [{
					position: 1,
					text1: EasyvoteSmartvote.cleavage1Text1,
					text2: EasyvoteSmartvote.cleavage1Text2,
					rotation: 0,
					path: "curvedTextPathUp"
				}, {
					position: 2,
					text1: EasyvoteSmartvote.cleavage2Text1,
					text2: EasyvoteSmartvote.cleavage2Text2,
					rotation: 45,
					path: "curvedTextPathUp"
				}, {
					position: 3,
					text1: EasyvoteSmartvote.cleavage3Text1,
					text2: EasyvoteSmartvote.cleavage3Text2,
					rotation: 90,
					path: "curvedTextPathUp"
				}, {
					position: 4,
					text1: EasyvoteSmartvote.cleavage4Text1,
					text2: EasyvoteSmartvote.cleavage4Text2,
					rotation: -45,
					path: "curvedTextPathUp"
				}, {
					position: 5,
					text1: EasyvoteSmartvote.cleavage5Text1,
					text2: EasyvoteSmartvote.cleavage5Text2,
					rotation: -45,
					path: "curvedTextPathDown"
				}, {
					position: 6,
					text1: EasyvoteSmartvote.cleavage6Text1,
					text2: EasyvoteSmartvote.cleavage6Text2,
					rotation: 0,
					path: "curvedTextPathDown"
				}, {
					position: 7,
					text1: EasyvoteSmartvote.cleavage7Text1,
					text2: EasyvoteSmartvote.cleavage7Text2,
					rotation: 45,
					path: "curvedTextPathDown"
				}, {
					position: 8,
					text1: EasyvoteSmartvote.cleavage8Text1,
					text2: EasyvoteSmartvote.cleavage8Text2,
					rotation: -90,
					path: "curvedTextPathUp"
				}];

				// Loop around the dataset and write text + draw lines around the axis.
				for (j = 0; j < dataset.length; j++) {

					// Label 1
					d3.select(id).select("svg").append("text").attr("text-anchor", "middle").attr("transform", function () {
						var realWidth = config.w + 2 * config.TranslateX;
						console.log("rotate(" + dataset[j].rotation + "," + realWidth / 2 + "," + realWidth / 2 + ")");
						return "rotate(" + dataset[j].rotation + "," + realWidth / 2 + "," + realWidth / 2 + ")";
					}).style({
						"font-family": "Arial,Helvetica,sans-serif",
						"font-size": "10px"
					}).append("textPath").attr({
						startOffset: "50%",
						"xlink:href": "#" + dataset[j].path
					}).text(dataset[j].text1);

					// Label 2
					d3.select(id).select("svg").append("text").attr("text-anchor", "middle").attr("transform", function () {
						var realWidth = config.w + 2 * config.TranslateX;
						console.log("rotate(" + dataset[j].rotation + "," + realWidth / 2 + "," + realWidth / 2 + ")");
						return "rotate(" + dataset[j].rotation + "," + realWidth / 2 + "," + realWidth / 2 + ")";
					}).style({
						"font-family": "Arial,Helvetica,sans-serif",
						"font-size": "10px"
					}).append("textPath").attr({
						startOffset: "50%",
						"xlink:href": "#" + dataset[j].path + "InnerCircle"
					}).text(dataset[j].text2);

					// Draw the axe
					d3.select(id).selectAll("svg").append("path").attr({
						d: function () {

							var point1X = config.w / 2 + config.TranslateX;
							var point1Y = config.h / 2 + config.TranslateY;

							var point2X = config.w - config.TranslateX * 2;
							var point2Y = config.h / 2 + config.TranslateY;

							return "M " + point1X + ", " + point1Y + " L " + point2X + ", " + point2Y;
						},
						stroke: "grey",
						"stroke-width": "0.3px",
						"stroke-opacity": "0.75",
						transform: function (object) {

							var unitAngle = 360 / dataset.length;
							var angle = unitAngle * dataset[j].position;

							var rotationOriginPointX = config.w / 2 + config.TranslateX;
							var rotationOriginPointY = config.h / 2 + config.TranslateY;

							return "rotate(" + angle + " , " + rotationOriginPointX + ", " + rotationOriginPointY + ")";
						}
					});
				}

				// Circular segments
				var j = 0;
				for (j = 0; j < config.levels - 1; j++) {

					var _radius = Math.min(config.w / 2, config.h / 2);
					var circleRadius = _radius / config.levels * (j + 1);
					var translateAxisX = config.w / 2 + config.TranslateX;
					var translateAxisY = config.h / 2 + config.TranslateY;

					d3.select(id).selectAll("svg").insert("circle").attr({
						cx: "0",
						cy: "0",
						r: circleRadius,
						fill: "none",
						stroke: "grey",
						"stroke-width": "0.3px",
						"stroke-opacity": "0.75",
						transform: "translate(" + translateAxisX + ", " + translateAxisY + ")"
					});
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

				var axis = g.selectAll(".axis").data(allAxis).enter().append("g").attr("class", "axis");

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

				axis.append("text").attr("class", "legend").text(function (d) {
					return d;
				}).style("font-family", "sans-serif").style("font-size", "11px").attr("text-anchor", "middle").attr("dy", "1.5em").attr("transform", function (d, i) {
					return "translate(0, -10)";
				}).attr("x", function (d, i) {
					return config.w / 2 * (1 - config.factorLegend * Math.sin(i * config.radians / total)) - 60 * Math.sin(i * config.radians / total);
				}).attr("y", function (d, i) {
					return config.h / 2 * (1 - Math.cos(i * config.radians / total)) - 20 * Math.cos(i * config.radians / total);
				});

				var tooltip;
				var counter = 0;
				var series = [{ points: serie2, color: "#E5005E" }, { points: serie1, color: config.color }];

				var _iteratorNormalCompletion = true;
				var _didIteratorError = false;
				var _iteratorError = undefined;

				try {
					for (var _iterator = _core.$for.getIterator(series), _step; !(_iteratorNormalCompletion = (_step = _iterator.next()).done); _iteratorNormalCompletion = true) {
						var serie = _step.value;

						var dataValues = [];
						serie.points.forEach(function (y, x) {
							g.selectAll(".nodes").data(y, function (j, i) {
								dataValues.push([config.w / 2 * (1 - parseFloat(Math.max(j.value, 0)) / config.maxValue * config.factor * Math.sin(i * config.radians / total)), config.h / 2 * (1 - parseFloat(Math.max(j.value, 0)) / config.maxValue * config.factor * Math.cos(i * config.radians / total))]);
							});
							dataValues.push(dataValues[0]);
							g.selectAll(".area").data([dataValues]).enter().append("polygon").attr("class", "radar-chart-serie" + counter).style("stroke-width", "2px").style("stroke", serie.color).attr("points", function (d) {
								var str = "";
								for (var pti = 0; pti < d.length; pti++) {
									str = str + d[pti][0] + "," + d[pti][1] + " ";
								}
								return str;
							}).style("fill", serie.color).style("fill-opacity", config.opacityArea).on("mouseover", function (d) {
								z = "polygon." + d3.select(this).attr("class");
								g.selectAll("polygon").transition(200).style("fill-opacity", 0.1);
								g.selectAll(z).transition(200).style("fill-opacity", 0.7);
							}).on("mouseout", function () {
								g.selectAll("polygon").transition(200).style("fill-opacity", config.opacityArea);
							});
							counter++;
						});
						counter = 0;

						serie.points.forEach(function (y, x) {
							g.selectAll(".nodes").data(y).enter().append("svg:circle").attr("class", "radar-chart-serie" + counter).attr("r", config.radius).attr("alt", function (j) {
								return Math.max(j.value, 0);
							}).attr("cx", function (j, i) {
								dataValues.push([config.w / 2 * (1 - parseFloat(Math.max(j.value, 0)) / config.maxValue * config.factor * Math.sin(i * config.radians / total)), config.h / 2 * (1 - parseFloat(Math.max(j.value, 0)) / config.maxValue * config.factor * Math.cos(i * config.radians / total))]);
								return config.w / 2 * (1 - Math.max(j.value, 0) / config.maxValue * config.factor * Math.sin(i * config.radians / total));
							}).attr("cy", function (j, i) {
								return config.h / 2 * (1 - Math.max(j.value, 0) / config.maxValue * config.factor * Math.cos(i * config.radians / total));
							}).attr("data-id", function (j) {
								return j.axis;
							}).style("fill", serie.color).style("fill-opacity", 0.9).on("mouseover", function (d) {
								newX = parseFloat(d3.select(this).attr("cx")) - 10;
								newY = parseFloat(d3.select(this).attr("cy")) - 5;

								//tooltip
								//	.attr('x', newX)
								//	.attr('y', newY)
								//	.text(Format(d.value))
								//	.transition(200)
								//	.style('opacity', 1);

								z = "polygon." + d3.select(this).attr("class");
								g.selectAll("polygon").transition(200).style("fill-opacity", 0.1);
								g.selectAll(z).transition(200).style("fill-opacity", 0.7);
							}).on("mouseout", function () {
								//tooltip
								//	.transition(200)
								//	.style('opacity', 0);
								g.selectAll("polygon").transition(200).style("fill-opacity", config.opacityArea);
							}).append("svg:title");
							//.text(function(j){return Math.max(j.value, 0)});

							counter++;
						});
						//Tooltip
						//tooltip = g.append('text')
						//		   .style('opacity', 0)
						//		   .style('font-family', 'sans-serif')
						//		   .style('font-size', '13px');
					}
				} catch (err) {
					_didIteratorError = true;
					_iteratorError = err;
				} finally {
					try {
						if (!_iteratorNormalCompletion && _iterator["return"]) {
							_iterator["return"]();
						}
					} finally {
						if (_didIteratorError) {
							throw _iteratorError;
						}
					}
				}
			}
		}
	});

	return SpiderChartPlotter;
})();

module.exports = SpiderChartPlotter;
},{"babel-runtime/core-js":13,"babel-runtime/helpers/class-call-check":14,"babel-runtime/helpers/create-class":15}],3:[function(require,module,exports){
/*jshint esnext:true */
"use strict";

var _classCallCheck = require("babel-runtime/helpers/class-call-check")["default"];

var _inherits = require("babel-runtime/helpers/inherits")["default"];

var _get = require("babel-runtime/helpers/get")["default"];

var _createClass = require("babel-runtime/helpers/create-class")["default"];

var _core = require("babel-runtime/core-js")["default"];

var _interopRequire = require("babel-runtime/helpers/interop-require")["default"];

var CandidateModel = _interopRequire(require("../Models/CandidateModel"));

var FacetView = _interopRequire(require("../Views/Candidate/FacetView"));

var FilterEngine = _interopRequire(require("../Filter/FilterEngine"));

var FacetIterator = _interopRequire(require("../Iterator/FacetIterator"));

/*
 * This file is part of the TYPO3 CMS project.
 *
 * See LICENSE.txt that was shipped with this package.
 */

var CandidateCollection = (function (_Backbone$Collection) {

	/**
  * @param options
  */

	function CandidateCollection(options) {
		_classCallCheck(this, CandidateCollection);

		_get(_core.Object.getPrototypeOf(CandidateCollection.prototype), "constructor", this).call(this, options);

		// Hold a reference to this collection's model.
		this.model = CandidateModel;

		// Set default orderings.
		this.sorting = "matching";
		this.direction = "descending";

		// Save all of the candidate items under the `'candidates'` namespace.
		this.localStorage = new Backbone.LocalStorage("candidates-" + EasyvoteSmartvote.token);
	}

	_inherits(CandidateCollection, _Backbone$Collection);

	_createClass(CandidateCollection, {
		comparator: {

			/**
    * Comparator used to sort candidates by "matching" criteria.
    *
    * @param candidate1
    * @param candidate2
    * @returns {number}
    */

			value: function comparator(candidate1, candidate2) {

				var comparison;

				if (this.sorting === "name" && this.direction === "ascending") {
					comparison = candidate1.get("lastName") > candidate2.get("lastName");
				} else if (this.sorting === "name" && this.direction === "descending") {
					comparison = candidate1.get("lastName") < candidate2.get("lastName");
				} else if (this.sorting === "matching" && this.direction === "ascending") {
					comparison = candidate1.getMatching() > candidate2.getMatching();
				} else {
					comparison = candidate1.getMatching() < candidate2.getMatching(); // default choice
				}

				return comparison;
			}
		},
		fetch: {

			/**
    * @returns {*}
    */

			value: function fetch() {

				// Check whether localStorage contains record about this collection otherwise fetch it by ajax.
				var records = this.localStorage.findAll();
				if (_.isEmpty(records)) {
					return this.remoteFetch();
				} else {
					// call original fetch method.
					return _get(_core.Object.getPrototypeOf(CandidateCollection.prototype), "fetch", this).call(this);
				}
			}
		},
		getFilteredCandidates: {

			/**
    * @returns {*}
    */

			value: function getFilteredCandidates() {

				return this.filter(function (candidate) {

					var filterEngine = new FilterEngine();
					var facetIterator = FacetIterator.getIterator();
					var isOk = true;

					// Fetch first facet
					var facet = facetIterator.next().value;
					while (facet && isOk) {
						isOk = filterEngine.isOk(candidate, facet);
						facet = facetIterator.next().value;
					}

					return isOk;
				});
			}
		},
		remoteFetch: {

			/**
    *
    * @returns {*}
    */

			value: function remoteFetch() {
				var _this = this;

				return Backbone.ajaxSync("read", this).done(function (models) {
					var _iteratorNormalCompletion = true;
					var _didIteratorError = false;
					var _iteratorError = undefined;

					try {
						for (var _iterator = _core.$for.getIterator(models), _step; !(_iteratorNormalCompletion = (_step = _iterator.next()).done); _iteratorNormalCompletion = true) {
							var model = _step.value;

							_this.create(model, { sort: false });
						}
					} catch (err) {
						_didIteratorError = true;
						_iteratorError = err;
					} finally {
						try {
							if (!_iteratorNormalCompletion && _iterator["return"]) {
								_iterator["return"]();
							}
						} finally {
							if (_didIteratorError) {
								throw _iteratorError;
							}
						}
					}

					// Trigger final sort => will trigger the view to render.
					_this.sort(); // not needed here since manually triggered in the view.
				});
			}
		},
		url: {

			/**
    * Return the URL to be used.
    *
    * @returns {string}
    */

			value: function url() {
				return "/routing/candidates/" + EasyvoteSmartvote.currentElection;
			}
		},
		getSorting: {

			/**
    * @returns {string}
    */

			value: function getSorting() {
				return this.sorting;
			}
		},
		setSorting: {

			/**
    * @param {String} sort
    * @return void
    */

			value: function setSorting(sort) {
				this.sorting = sort;
			}
		},
		getDirection: {

			/**
    * @returns {string}
    */

			value: function getDirection() {
				return this.direction;
			}
		},
		setDirection: {

			/**
    * @param {String} direction
    * @return void
    */

			value: function setDirection(direction) {
				this.direction = direction;
			}
		}
	}, {
		getInstance: {

			/**
    * @return CandidateCollection
    */

			value: function getInstance() {
				if (!this.instance) {
					this.instance = new CandidateCollection();
				}
				return this.instance;
			}
		}
	});

	return CandidateCollection;
})(Backbone.Collection);

module.exports = CandidateCollection;
},{"../Filter/FilterEngine":5,"../Iterator/FacetIterator":6,"../Models/CandidateModel":7,"../Views/Candidate/FacetView":11,"babel-runtime/core-js":13,"babel-runtime/helpers/class-call-check":14,"babel-runtime/helpers/create-class":15,"babel-runtime/helpers/get":16,"babel-runtime/helpers/inherits":17,"babel-runtime/helpers/interop-require":18}],4:[function(require,module,exports){
/*jshint esnext:true */
"use strict";

var _classCallCheck = require("babel-runtime/helpers/class-call-check")["default"];

var _inherits = require("babel-runtime/helpers/inherits")["default"];

var _get = require("babel-runtime/helpers/get")["default"];

var _createClass = require("babel-runtime/helpers/create-class")["default"];

var _core = require("babel-runtime/core-js")["default"];

var _interopRequire = require("babel-runtime/helpers/interop-require")["default"];

var QuestionModel = _interopRequire(require("../Models/QuestionModel"));

/*
 * This file is part of the TYPO3 CMS project.
 *
 * See LICENSE.txt that was shipped with this package.
 */

var QuestionCollection = (function (_Backbone$Collection) {

	/**
  * @param options
  */

	function QuestionCollection(options) {
		_classCallCheck(this, QuestionCollection);

		_get(_core.Object.getPrototypeOf(QuestionCollection.prototype), "constructor", this).call(this, options);

		// Hold a reference to this collection's model.
		this.model = QuestionModel;
	}

	_inherits(QuestionCollection, _Backbone$Collection);

	_createClass(QuestionCollection, {
		fetchForAnonymousUser: {

			/**
    * Anonymous User uses the localStorage as a first storage.
    *
    * @returns {*}
    */

			value: function fetchForAnonymousUser() {
				var _this = this;

				// Save all of the question items under the `'questions'` namespace for anonymous user.
				this.localStorage = new Backbone.LocalStorage("questions-" + this.getToken());

				// Check whether localStorage contains record about this collection
				var records = this.localStorage.findAll();
				if (_.isEmpty(records)) {
					return Backbone.ajaxSync("read", this).done(function (models) {
						var _iteratorNormalCompletion = true;
						var _didIteratorError = false;
						var _iteratorError = undefined;

						try {
							for (var _iterator = _core.$for.getIterator(models), _step; !(_iteratorNormalCompletion = (_step = _iterator.next()).done); _iteratorNormalCompletion = true) {
								var model = _step.value;

								_this.create(model, { sort: false });
							}
						} catch (err) {
							_didIteratorError = true;
							_iteratorError = err;
						} finally {
							try {
								if (!_iteratorNormalCompletion && _iterator["return"]) {
									_iterator["return"]();
								}
							} finally {
								if (_didIteratorError) {
									throw _iteratorError;
								}
							}
						}
					});
				} else {
					// call original fetch method
					return _get(_core.Object.getPrototypeOf(QuestionCollection.prototype), "fetch", this).call(this);
				}
			}
		},
		hasCompletedAnswers: {

			/**
    * @return bool
    */

			value: function hasCompletedAnswers() {
				var hasAnswers = false;
				this.each(function (question) {
					var answer = question.get("answer");
					if (_core.Number.isInteger(answer)) {
						hasAnswers = true;
					}
				});

				return hasAnswers;
			}
		},
		getToken: {

			/**
    * Compute the token.
    *
    * @returns {string}
    */

			value: function getToken() {
				var token = EasyvoteSmartvote.token;
				if (EasyvoteSmartvote.relatedToken) {
					token = EasyvoteSmartvote.relatedToken;
				}
				return token;
			}
		},
		url: {

			/**
    * Return the URL to be used.
    *
    * @returns {string}
    */

			value: function url() {
				var token = "";
				if (EasyvoteSmartvote.isUserAuthenticated) {
					token += "&token=" + this.getToken();
				}

				// Compute the final election identifier.
				var electionIdentifier = EasyvoteSmartvote.currentElection;
				if (EasyvoteSmartvote.relatedElection > 0) {
					electionIdentifier = EasyvoteSmartvote.relatedElection;
				}

				return "/routing/questions/" + electionIdentifier + "?id=" + EasyvoteSmartvote.pageUid + "&L=" + EasyvoteSmartvote.sysLanguageUid + token;
			}
		},
		getFilteredQuestions: {

			/**
    * @param {bool} isShortVersion
    * @return array
    */

			value: function getFilteredQuestions(isShortVersion) {
				var questions;
				if (isShortVersion) {
					questions = this.filter(function (question) {
						return question.get("rapide");
					});
				} else {
					questions = this.filter();
				}
				return questions;
			}
		},
		countAnsweredQuestions: {

			/**
    * @returns {array}
    */

			value: function countAnsweredQuestions() {
				return this.filter(function (question) {
					return question.get("answer") !== null;
				});
			}
		},
		hasAnsweredQuestions: {

			/**
    * @returns {bool}
    */

			value: function hasAnsweredQuestions() {
				var numberOfAnsweredQuestions = this.countAnsweredQuestions();
				return numberOfAnsweredQuestions.length > 0;
			}
		},
		load: {

			/**
    * @returns {*}
    */

			value: function load() {
				if (this._isAnonymous()) {
					return this.fetchForAnonymousUser();
				} else {
					return _get(_core.Object.getPrototypeOf(QuestionCollection.prototype), "fetch", this).call(this);
				}
			}
		},
		count: {

			/**
    * Return the total number of questions for this collection.
    *
    * @param {bool} isShortVersion
    * @returns int
    */

			value: function count(isShortVersion) {
				return this.getFilteredQuestions(isShortVersion).length;
			}
		},
		countVisible: {

			/**
    * Return the number of visible questions.
    *
    * @param {bool} isShortVersion
    * @returns int
    */

			value: function countVisible(isShortVersion) {
				var numberVisible;
				if (isShortVersion) {
					numberVisible = this.filter(function (question) {
						return question.get("visible") && question.get("rapide");
					}).length;
				} else {
					numberVisible = this.filter(function (question) {
						return question.get("visible");
					}).length;
				}
				return numberVisible;
			}
		},
		_isAnonymous: {

			/**
    * @return {bool}
    * @private
    */

			value: function _isAnonymous() {
				return !EasyvoteSmartvote.isUserAuthenticated;
			}
		}
	}, {
		getInstance: {

			/**
    * @return QuestionCollection
    */

			value: function getInstance() {
				if (!this.instance) {
					this.instance = new QuestionCollection();
				}
				return this.instance;
			}
		}
	});

	return QuestionCollection;
})(Backbone.Collection);

module.exports = QuestionCollection;
},{"../Models/QuestionModel":9,"babel-runtime/core-js":13,"babel-runtime/helpers/class-call-check":14,"babel-runtime/helpers/create-class":15,"babel-runtime/helpers/get":16,"babel-runtime/helpers/inherits":17,"babel-runtime/helpers/interop-require":18}],5:[function(require,module,exports){
/*jshint esnext:true */

/*
 * This file is part of the TYPO3 CMS project.
 *
 * See LICENSE.txt that was shipped with this package.
 */

"use strict";

var _classCallCheck = require("babel-runtime/helpers/class-call-check")["default"];

var _createClass = require("babel-runtime/helpers/create-class")["default"];

var FilterEngine = (function () {
	function FilterEngine() {
		_classCallCheck(this, FilterEngine);
	}

	_createClass(FilterEngine, {
		isOk: {

			/**
    * @param candidate
    * @param facet
    * @returns {boolean}
    */

			value: (function (_isOk) {
				var _isOkWrapper = function isOk(_x, _x2) {
					return _isOk.apply(this, arguments);
				};

				_isOkWrapper.toString = function () {
					return _isOk.toString();
				};

				return _isOkWrapper;
			})(function (candidate, facet) {

				var value, filterValue;
				var isOk = true;

				if (!facet.value) {
					isOk = true;
				} else if (facet.name === "minAge") {
					value = candidate.get("yearOfBirth");
					filterValue = facet.value;
					isOk = this.isYoungerOrEqual(value, filterValue);
				} else if (facet.name === "maxAge") {
					value = candidate.get("yearOfBirth");
					filterValue = facet.value;
					isOk = this.isOlderOrEqual(value, filterValue);
				} else {
					value = candidate.get(facet.name);
					isOk = this.isEqual(value, facet.value);
				}

				return isOk;
			})
		},
		isEqual: {

			/**
    * @param {int} objectValue
    * @param {int} facetValue
    * @returns {boolean}
    */

			value: function isEqual(objectValue, facetValue) {
				return objectValue == facetValue;
			}
		},
		isYoungerOrEqual: {

			/**
    * @param {int} subjectYearOfBirth
    * @param {int} age
    * @returns {boolean}
    */

			value: function isYoungerOrEqual(subjectYearOfBirth, age) {
				var currentYear = new Date().getFullYear();
				return subjectYearOfBirth <= currentYear - age;
			}
		},
		isOlderOrEqual: {

			/**
    * @param {int} subjectYearOfBirth
    * @param {int} age
    * @returns {boolean}
    */

			value: function isOlderOrEqual(subjectYearOfBirth, age) {
				var currentYear = new Date().getFullYear();
				return subjectYearOfBirth >= currentYear - age;
			}
		}
	});

	return FilterEngine;
})();

module.exports = FilterEngine;
},{"babel-runtime/helpers/class-call-check":14,"babel-runtime/helpers/create-class":15}],6:[function(require,module,exports){
/*jshint esnext:true */

/*
 * This file is part of the TYPO3 CMS project.
 *
 * See LICENSE.txt that was shipped with this package.
 */

"use strict";

var _classCallCheck = require("babel-runtime/helpers/class-call-check")["default"];

var _createClass = require("babel-runtime/helpers/create-class")["default"];

var _core = require("babel-runtime/core-js")["default"];

var FacetIterator = (function () {
	function FacetIterator() {
		_classCallCheck(this, FacetIterator);
	}

	_createClass(FacetIterator, null, {
		getIterator: {
			value: function getIterator() {

				var facets = [];
				var $elements = $("#container-candidate-filter").find(".form-control");
				$elements.each(function (index, element) {
					var facet = {};
					facet.name = $(element).attr("name");
					facet.value = $(element).val();
					facets.push(facet);
				});

				return _core.$for.getIterator(facets);
			}
		}
	});

	return FacetIterator;
})();

module.exports = FacetIterator;
},{"babel-runtime/core-js":13,"babel-runtime/helpers/class-call-check":14,"babel-runtime/helpers/create-class":15}],7:[function(require,module,exports){
/*jshint esnext:true */
"use strict";

var _classCallCheck = require("babel-runtime/helpers/class-call-check")["default"];

var _inherits = require("babel-runtime/helpers/inherits")["default"];

var _createClass = require("babel-runtime/helpers/create-class")["default"];

var _core = require("babel-runtime/core-js")["default"];

var _interopRequire = require("babel-runtime/helpers/interop-require")["default"];

var QuestionCollection = _interopRequire(require("../Collections/QuestionCollection"));

/*
 * This file is part of the TYPO3 CMS project.
 *
 * See LICENSE.txt that was shipped with this package.
 */

var CandidateModel = (function (_Backbone$Model) {
	function CandidateModel() {
		_classCallCheck(this, CandidateModel);

		if (_Backbone$Model != null) {
			_Backbone$Model.apply(this, arguments);
		}
	}

	_inherits(CandidateModel, _Backbone$Model);

	_createClass(CandidateModel, {
		defaults: {

			/**
    * @returns {{matching: number}}
    */

			value: function defaults() {
				return {
					matching: null
				};
			}
		},
		getMatching: {

			/**
    * @returns {int}
    */

			value: function getMatching() {

				var questionCollection = QuestionCollection.getInstance();

				var matching = null;
				var candidateAnswers = this.get("answers");

				// true means the candidate has answered the survey which is normally the case but not always...
				if (questionCollection.hasCompletedAnswers() && candidateAnswers.length > 0) {

					var aggregatedResult = 0;
					var counter = 0;

					var _iteratorNormalCompletion = true;
					var _didIteratorError = false;
					var _iteratorError = undefined;

					try {
						for (var _iterator = _core.$for.getIterator(candidateAnswers), _step; !(_iteratorNormalCompletion = (_step = _iterator.next()).done); _iteratorNormalCompletion = true) {
							var candidateAnswer = _step.value;

							var userQuestion = this.retrieveQuestion(candidateAnswer);
							if (userQuestion) {
								if (userQuestion.get("answer") !== null && userQuestion.get("answer") !== -1) {
									aggregatedResult += Math.pow(userQuestion.get("answer") - candidateAnswer.answer, 2);
									counter++;
								}
							} else {
								console.log("Warning #1435731882: I could not retrieve the question filled by the User " + candidateAnswer.questionId);
							}
						}
					} catch (err) {
						_didIteratorError = true;
						_iteratorError = err;
					} finally {
						try {
							if (!_iteratorNormalCompletion && _iterator["return"]) {
								_iterator["return"]();
							}
						} finally {
							if (_didIteratorError) {
								throw _iteratorError;
							}
						}
					}

					var distance = Math.sqrt(aggregatedResult);
					var maximalDistance = Math.sqrt(counter * Math.pow(100, 2));
					var nominalDistance = distance / maximalDistance;
					matching = Math.round(100 * (1 - nominalDistance));
				}

				this.set("matching", matching);
				return this.get("matching");
			}
		},
		retrieveQuestion: {

			/**
    * @param answer
    * @returns Question
    */

			value: function retrieveQuestion(answer) {
				var questionCollection = QuestionCollection.getInstance();
				var questionId = answer.questionId;
				var question = questionCollection.get(questionId);
				if (!question) {
					var questions = questionCollection.where({ alternativeId: questionId });
					if (questions.length > 0) {
						question = questions[0];
					}
				}
				return question;
			}
		}
	});

	return CandidateModel;
})(Backbone.Model);

module.exports = CandidateModel;
},{"../Collections/QuestionCollection":4,"babel-runtime/core-js":13,"babel-runtime/helpers/class-call-check":14,"babel-runtime/helpers/create-class":15,"babel-runtime/helpers/inherits":17,"babel-runtime/helpers/interop-require":18}],8:[function(require,module,exports){
/*jshint esnext:true */

/*
 * This file is part of the TYPO3 CMS project.
 *
 * See LICENSE.txt that was shipped with this package.
 */

"use strict";

var _classCallCheck = require("babel-runtime/helpers/class-call-check")["default"];

var _inherits = require("babel-runtime/helpers/inherits")["default"];

var _createClass = require("babel-runtime/helpers/create-class")["default"];

var _core = require("babel-runtime/core-js")["default"];

var FacetModel = (function (_Backbone$Model) {
	function FacetModel() {
		_classCallCheck(this, FacetModel);

		if (_Backbone$Model != null) {
			_Backbone$Model.apply(this, arguments);
		}
	}

	_inherits(FacetModel, _Backbone$Model);

	_createClass(FacetModel, {
		defaults: {

			/**
    * @returns {{id: number, nationalParty: string, district: string, minAge: string, maxAge: string, incumbent: string, gender: string}}
    */

			value: function defaults() {
				return {
					id: 1, // fictive id but is mandatory in order to retrieve the model in the session.
					nationalParty: "",
					district: EasyvoteSmartvote.userDistrict,
					minAge: "18",
					maxAge: "90",
					incumbent: "",
					gender: ""
				};
			}
		},
		initialize: {

			/**
    * Initialize object.
    */

			value: function initialize() {
				this.localStorage = new Backbone.LocalStorage("candidates-facet-" + EasyvoteSmartvote.token);
			}
		},
		hasState: {

			/**
    * Return whether the object has a state
    */

			value: function hasState() {
				return _core.Object.keys(this.getState()).length;
			}
		},
		getState: {

			/**
    * Get state of the object coming form the URL hash.
    */

			value: function getState() {

				if (!this.state) {
					this.state = {};

					var allowedArguments = ["nationalParty", "district", "minAge", "maxAge", "incumbent", "gender"];
					var query = window.location.hash.split("&");
					var _iteratorNormalCompletion = true;
					var _didIteratorError = false;
					var _iteratorError = undefined;

					try {
						for (var _iterator = _core.$for.getIterator(query), _step; !(_iteratorNormalCompletion = (_step = _iterator.next()).done); _iteratorNormalCompletion = true) {
							var argument = _step.value;

							// sanitize arguments
							argument = argument.replace("#", "");
							var argumentParts = argument.split("=");
							if (argumentParts.length === 2 && allowedArguments.indexOf(argumentParts[0]) >= 0) {
								var _name = argumentParts[0];
								var value = argumentParts[1];
								this.state[_name] = value;
							}
						}
					} catch (err) {
						_didIteratorError = true;
						_iteratorError = err;
					} finally {
						try {
							if (!_iteratorNormalCompletion && _iterator["return"]) {
								_iterator["return"]();
							}
						} finally {
							if (_didIteratorError) {
								throw _iteratorError;
							}
						}
					}
				}
				return this.state;
			}
		},
		setState: {

			/**
    * Set default values form the URL hash.
    */

			value: function setState() {
				this.save(this.getState());
			}
		}
	});

	return FacetModel;
})(Backbone.Model);

module.exports = FacetModel;
},{"babel-runtime/core-js":13,"babel-runtime/helpers/class-call-check":14,"babel-runtime/helpers/create-class":15,"babel-runtime/helpers/inherits":17}],9:[function(require,module,exports){
/*jshint esnext:true */

/*
 * This file is part of the TYPO3 CMS project.
 *
 * See LICENSE.txt that was shipped with this package.
 */

"use strict";

var _classCallCheck = require("babel-runtime/helpers/class-call-check")["default"];

var _inherits = require("babel-runtime/helpers/inherits")["default"];

var _createClass = require("babel-runtime/helpers/create-class")["default"];

var QuestionModel = (function (_Backbone$Model) {
	function QuestionModel() {
		_classCallCheck(this, QuestionModel);

		if (_Backbone$Model != null) {
			_Backbone$Model.apply(this, arguments);
		}
	}

	_inherits(QuestionModel, _Backbone$Model);

	_createClass(QuestionModel, {
		defaults: {

			/**
    * @returns {{name: string, answer: number, index: number, cleavage1: number, cleavage2: number, cleavage3: number, cleavage4: number, cleavage5: number, cleavage6: number, cleavage7: number, cleavage8: number, visible: boolean}}
    */

			value: function defaults() {

				return {
					name: "",
					answer: 100,
					index: 0,
					cleavage1: 0,
					cleavage2: 0,
					cleavage3: 0,
					cleavage4: 0,
					cleavage5: 0,
					cleavage6: 0,
					cleavage7: 0,
					cleavage8: 0,
					visible: false
				};
			}
		},
		url: {

			/**
    * Return the URL to be used.
    *
    * @returns {string}
    */

			value: function url() {
				var token = "";
				if (EasyvoteSmartvote.isUserAuthenticated) {
					token += "?token=" + EasyvoteSmartvote.token;
				}
				return "/routing/state/" + token;
			}
		}
	});

	return QuestionModel;
})(Backbone.Model);

module.exports = QuestionModel;
},{"babel-runtime/helpers/class-call-check":14,"babel-runtime/helpers/create-class":15,"babel-runtime/helpers/inherits":17}],10:[function(require,module,exports){
/*jshint esnext:true */
"use strict";

var _classCallCheck = require("babel-runtime/helpers/class-call-check")["default"];

var _inherits = require("babel-runtime/helpers/inherits")["default"];

var _get = require("babel-runtime/helpers/get")["default"];

var _createClass = require("babel-runtime/helpers/create-class")["default"];

var _core = require("babel-runtime/core-js")["default"];

var _interopRequire = require("babel-runtime/helpers/interop-require")["default"];

var SpiderChartPlotter = _interopRequire(require("../../Chart/SpiderChartPlotter"));

/*
 * This file is part of the TYPO3 CMS project.
 *
 * See LICENSE.txt that was shipped with this package.
 */

var CandidateView = (function (_Backbone$View) {

	/**
  * @param options
  */

	function CandidateView(options) {
		_classCallCheck(this, CandidateView);

		// *... is a list tag.*
		this.tagName = "div";

		// *Cache the template function for a single item.*
		this.template = _.template($("#template-candidate").html());

		// *Define the DOM events specific to an item.*
		this.events = {
			"click .toggle": "renderChart"
		};

		_get(_core.Object.getPrototypeOf(CandidateView.prototype), "constructor", this).call(this, options);
	}

	_inherits(CandidateView, _Backbone$View);

	_createClass(CandidateView, {
		renderChart: {

			/**
    * Render the candidate view.
    *
    * @returns string
    */

			value: function renderChart() {

				// Lazy rendering of the Chart.
				if (!$("#chart-candidate-" + this.model.id).has("svg").length) {
					var values = this.model.get("spiderChart");
					if (values.length > 0) {
						this.drawChart(this.model.id, values);
					}
				}
			}
		},
		render: {

			/**
    * Render the candidate view.
    *
    * @returns string
    */

			value: function render() {
				var content = this.template(this.model.toJSON());
				this.$el.html(content);
				return this.el;
			}
		},
		drawChart: {

			/**
    * @param {int} candidateId
    * @param {array} values
    * @return {bool}
    * @private
    */

			value: function drawChart(candidateId, values) {

				var data = [
				//                                                         cleavage# - position in chart
				{ value: values[0].value * 0.01 }, // Offene Aussenpolitik           1 - 1
				{ value: values[7].value * 0.01 }, // Liberale Gesellschaft          8 - 2
				{ value: values[6].value * 0.01 }, // Ausgebauter Sozialstaat        7 - 3
				{ value: values[5].value * 0.01 }, // Ausgebauter Umweltschutz       6 - 4
				{ value: values[4].value * 0.01 }, // Restrictive Migrationspolitik  5 - 5
				{ value: values[3].value * 0.01 }, // Law & Order                    4 - 6
				{ value: values[2].value * 0.01 }, // Restrictive Finanzpolitik      3 - 7
				{ value: values[1].value * 0.01 } // Liberale Wirtschaftspolitik    2 - 8
				];

				// Start the local storage
				var localStorage = new Backbone.LocalStorage("spider-chart-" + this.getToken());
				var data2 = JSON.parse(localStorage.localStorage().getItem("data"));
				if (!data2) {
					data2 = [];
				}

				SpiderChartPlotter.plot("#chart-candidate-" + candidateId, [data], {
					w: 240,
					h: 240,
					levels: 5,
					maxValue: 1
				}, [data2]);
			}
		},
		getToken: {

			/**
    * Compute the token.
    *
    * @returns {string}
    */

			value: function getToken() {
				var token = EasyvoteSmartvote.token;
				if (EasyvoteSmartvote.relatedToken) {
					token = EasyvoteSmartvote.relatedToken;
				}
				return token;
			}
		}
	});

	return CandidateView;
})(Backbone.View);

module.exports = CandidateView;
},{"../../Chart/SpiderChartPlotter":2,"babel-runtime/core-js":13,"babel-runtime/helpers/class-call-check":14,"babel-runtime/helpers/create-class":15,"babel-runtime/helpers/get":16,"babel-runtime/helpers/inherits":17,"babel-runtime/helpers/interop-require":18}],11:[function(require,module,exports){
/*jshint esnext:true */
"use strict";

var _classCallCheck = require("babel-runtime/helpers/class-call-check")["default"];

var _inherits = require("babel-runtime/helpers/inherits")["default"];

var _get = require("babel-runtime/helpers/get")["default"];

var _createClass = require("babel-runtime/helpers/create-class")["default"];

var _core = require("babel-runtime/core-js")["default"];

var _interopRequire = require("babel-runtime/helpers/interop-require")["default"];

var CandidateCollection = _interopRequire(require("../../Collections/CandidateCollection"));

var FacetModel = _interopRequire(require("../../Models/FacetModel"));

var FacetIterator = _interopRequire(require("../../Iterator/FacetIterator"));

/*
 * This file is part of the TYPO3 CMS project.
 *
 * See LICENSE.txt that was shipped with this package.
 */

var FacetView = (function (_Backbone$View) {

	/**
  * Constructor
  *
  * @param options
  */

	function FacetView(options) {
		_classCallCheck(this, FacetView);

		// Instead of generating a new element, bind to the existing skeleton of
		// the App already present in the HTML.
		this.setElement($("#container-candidate-filter"), true);

		// *Cache the template function for a single item.*
		this.template = _.template($("#template-candidate-filter").html());

		// *Define the DOM events specific to an item.*
		this.events = {
			"change .form-control": "save"
		};

		this.model = new FacetModel();

		this.listenTo(this.model, "change", this.save);

		if (this.model.hasState()) {
			this.model.setState();
		} else {
			this.model.fetch();
		}

		this.bindings = {
			"#nationalParty": "nationalParty",
			"#district": "district",
			"#minAge": "minAge",
			"#maxAge": "maxAge",
			"#incumbent": "incumbent",
			"#gender": "gender"
		};

		// special binding since the reset button is outside the scope of this view.
		_.bindAll(this, "reset");
		$(document).on("click", "#btn-reset-facets", this.reset);

		_get(_core.Object.getPrototypeOf(FacetView.prototype), "constructor", this).call(this, options);
	}

	_inherits(FacetView, _Backbone$View);

	_createClass(FacetView, {
		hasMinimumFilter: {

			/**
    * @returns {boolean}
    */

			value: function hasMinimumFilter() {
				var district = this.model.get("district") - 0;
				var nationalParty = this.model.get("nationalParty") - 0;
				return district > 0 || nationalParty > 0;
			}
		},
		save: {

			/**
    * @returns void
    */

			value: function save() {

				var query = [];
				var data = {};
				var _iteratorNormalCompletion = true;
				var _didIteratorError = false;
				var _iteratorError = undefined;

				try {
					for (var _iterator = _core.$for.getIterator(FacetIterator.getIterator()), _step; !(_iteratorNormalCompletion = (_step = _iterator.next()).done); _iteratorNormalCompletion = true) {
						var facet = _step.value;

						data[facet.name] = facet.value;
						query.push(facet.name + "=" + facet.value);
					}
				} catch (err) {
					_didIteratorError = true;
					_iteratorError = err;
				} finally {
					try {
						if (!_iteratorNormalCompletion && _iterator["return"]) {
							_iterator["return"]();
						}
					} finally {
						if (_didIteratorError) {
							throw _iteratorError;
						}
					}
				}

				// Set state of the filter in the URL.
				window.location.hash = query.join("&");

				this.model.save(data);
				Backbone.trigger("facet:changed");
			}
		},
		reset: {

			/**
    * @returns {boolean}
    */

			value: function reset() {
				this.model = new FacetModel();
				this.render();
				this.save();
				return false;
			}
		},
		render: {

			/**
    * Render the candidate view.
    *
    * @returns void
    */

			value: function render() {
				var content = this.template();
				this.$el.html(content);
				this.stickit();

				// Hide by default until we can tell whether the box should be shown or not.
				$("#container-candidate-filter").closest(".csc-default").removeClass("hidden");
			}
		}
	});

	return FacetView;
})(Backbone.View);

module.exports = FacetView;
},{"../../Collections/CandidateCollection":3,"../../Iterator/FacetIterator":6,"../../Models/FacetModel":8,"babel-runtime/core-js":13,"babel-runtime/helpers/class-call-check":14,"babel-runtime/helpers/create-class":15,"babel-runtime/helpers/get":16,"babel-runtime/helpers/inherits":17,"babel-runtime/helpers/interop-require":18}],12:[function(require,module,exports){
/*jshint esnext:true */
"use strict";

var _classCallCheck = require("babel-runtime/helpers/class-call-check")["default"];

var _inherits = require("babel-runtime/helpers/inherits")["default"];

var _get = require("babel-runtime/helpers/get")["default"];

var _createClass = require("babel-runtime/helpers/create-class")["default"];

var _core = require("babel-runtime/core-js")["default"];

var _interopRequire = require("babel-runtime/helpers/interop-require")["default"];

var CandidateCollection = _interopRequire(require("../../Collections/CandidateCollection"));

var CandidateView = _interopRequire(require("./CandidateView"));

var QuestionCollection = _interopRequire(require("../../Collections/QuestionCollection"));

/*
 * This file is part of the TYPO3 CMS project.
 *
 * See LICENSE.txt that was shipped with this package.
 */

var ListView = (function (_Backbone$View) {

	/**
  * Constructor
  *
  * @param options
  */

	function ListView(options) {
		_classCallCheck(this, ListView);

		this.facetView = options.facet;

		// Instead of generating a new element, bind to the existing skeleton of
		// the App already present in the HTML.
		this.setElement($("#container-candidates"), true);

		// Contains the "number of candidates" and button to reset the filter.
		this.beforeStartingTemplate = _.template($("#template-before-starting").html());

		// Contains the "number of candidates" and button to reset the filter.
		this.listTopTemplate = _.template($("#template-candidates-top").html());

		/** @var candidateCollection CandidateCollection*/
		var candidateCollection = CandidateCollection.getInstance();
		this.questionCollection = QuestionCollection.getInstance();

		// Important: define listener before fetching data.
		this.listenTo(candidateCollection, "sort", this.render);
		this.listenTo(Backbone, "facet:changed", this.render, this);

		_.bindAll(this, "changeFacetView");
		_.bindAll(this, "sortAndRender");
		$(document).on("click", "#btn-show-login", this.showLoginBox);
		$(document).on("change", "#container-before-starting .form-control", this.changeFacetView);
		$(document).on("change", "#btn-sorting", this.sortAndRender);

		// Load first the Question collection.
		/** @var questionCollection QuestionCollection */
		this.questionCollection.load().done(function () {

			candidateCollection.fetch(); // will trigger the rendering.

			// Fetch candidates.
			//candidateCollection.fetch().done(() => {
			//candidateCollection.sort(); // will trigger the rendering.
			//});
		});

		// Call parent constructor.
		_get(_core.Object.getPrototypeOf(ListView.prototype), "constructor", this).call(this);
	}

	_inherits(ListView, _Backbone$View);

	_createClass(ListView, {
		render: {

			/**
    * Render the view.
    */

			value: function render() {

				if (this.questionCollection.hasAnsweredQuestions() && this.facetView.hasMinimumFilter()) {

					var filteredCandidates = CandidateCollection.getInstance().getFilteredCandidates();

					// Render intermediate content in a temporary DOM.
					var container = document.createDocumentFragment();
					var _iteratorNormalCompletion = true;
					var _didIteratorError = false;
					var _iteratorError = undefined;

					try {
						for (var _iterator = _core.$for.getIterator(filteredCandidates), _step; !(_iteratorNormalCompletion = (_step = _iterator.next()).done); _iteratorNormalCompletion = true) {
							var candidate = _step.value;

							var _content = this.renderOne(candidate);
							container.appendChild(_content);
						}
					} catch (err) {
						_didIteratorError = true;
						_iteratorError = err;
					} finally {
						try {
							if (!_iteratorNormalCompletion && _iterator["return"]) {
								_iterator["return"]();
							}
						} finally {
							if (_didIteratorError) {
								throw _iteratorError;
							}
						}
					}

					// Finally update the DOM.
					$("#container-candidate-list").html(container);

					// Add lazy loading to images.
					$("img.lazy", $("#container-candidate-list")).lazyload();

					// Update top list content.
					var content = this.listTopTemplate({
						numberOfItems: filteredCandidates.length,
						sorting: CandidateCollection.getInstance().getSorting(),
						direction: CandidateCollection.getInstance().getDirection()
					});
					$("#container-candidates-top").html(content);
					$("#wrapper-candidates").removeClass("hidden");
					$("#wrapper-filter").removeClass("hidden");
					$("#container-before-starting").addClass("hidden");
				} else {

					// User must pick some option
					var content = this.beforeStartingTemplate({
						isLinkToQuestionnaire: !this.questionCollection.hasAnsweredQuestions(),
						isFormDefaultFilter: !this.facetView.hasMinimumFilter(),
						isLinkToAuthentication: !this.isAuthenticated()
					});

					$("#wrapper-candidates").addClass("hidden");
					$("#wrapper-filter").addClass("hidden");
					$("#container-before-starting").html(content).removeClass("hidden");
				}
			}
		},
		sortAndRender: {

			/**
    * update facet view.
    */

			value: function sortAndRender(e) {
				var candidateCollection = CandidateCollection.getInstance();

				var parameters = $(e.target).val().split("&");
				if (parameters.length == 2) {

					var sorting = parameters[0];
					var direction = parameters[1];
					candidateCollection.setSorting(sorting);
					candidateCollection.setDirection(direction);
					candidateCollection.sort(); // trigger rendering
				}
			}
		},
		changeFacetView: {

			/**
    * update facet view.
    */

			value: function changeFacetView(e) {
				var name = $(e.target).attr("name");
				var value = $(e.target).val();
				this.facetView.model.set(name, value);
				this.facetView.save();
			}
		},
		showLoginBox: {

			/**
    * Display the login box
    */

			value: function showLoginBox() {
				$(".login-link").trigger("click");
				return false; // prevent default behaviour.
			}
		},
		changeAnswer: {

			/**
    * @param argument
    */

			value: function changeAnswer(argument) {
				var candidate = argument.attributes;

				this.updateChart(candidate);

				var candidateCollection = CandidateCollection.getInstance();
				var nextIndex = candidateCollection.length - 1 - candidate.index;
				var nextCandidate = candidateCollection.at(nextIndex);
				nextCandidate.trigger("visible");
			}
		},
		renderOne: {

			/**
    * Add a single candidate item to the list by creating a view for it, then
    * appending its element to the `<div>`.
    * @param model
    */

			value: function renderOne(model) {
				var view = new CandidateView({ model: model });
				return view.render();
			}
		},
		isAuthenticated: {

			/**
    * @return {bool}
    * @private
    */

			value: function isAuthenticated() {
				return EasyvoteSmartvote.isUserAuthenticated;
			}
		}
	});

	return ListView;
})(Backbone.View);

module.exports = ListView;
},{"../../Collections/CandidateCollection":3,"../../Collections/QuestionCollection":4,"./CandidateView":10,"babel-runtime/core-js":13,"babel-runtime/helpers/class-call-check":14,"babel-runtime/helpers/create-class":15,"babel-runtime/helpers/get":16,"babel-runtime/helpers/inherits":17,"babel-runtime/helpers/interop-require":18}],13:[function(require,module,exports){
/**
 * Core.js 0.6.1
 * https://github.com/zloirock/core-js
 * License: http://rock.mit-license.org
 * © 2015 Denis Pushkarev
 */
!function(global, framework, undefined){
'use strict';

/******************************************************************************
 * Module : common                                                            *
 ******************************************************************************/

  // Shortcuts for [[Class]] & property names
var OBJECT          = 'Object'
  , FUNCTION        = 'Function'
  , ARRAY           = 'Array'
  , STRING          = 'String'
  , NUMBER          = 'Number'
  , REGEXP          = 'RegExp'
  , DATE            = 'Date'
  , MAP             = 'Map'
  , SET             = 'Set'
  , WEAKMAP         = 'WeakMap'
  , WEAKSET         = 'WeakSet'
  , SYMBOL          = 'Symbol'
  , PROMISE         = 'Promise'
  , MATH            = 'Math'
  , ARGUMENTS       = 'Arguments'
  , PROTOTYPE       = 'prototype'
  , CONSTRUCTOR     = 'constructor'
  , TO_STRING       = 'toString'
  , TO_STRING_TAG   = TO_STRING + 'Tag'
  , TO_LOCALE       = 'toLocaleString'
  , HAS_OWN         = 'hasOwnProperty'
  , FOR_EACH        = 'forEach'
  , ITERATOR        = 'iterator'
  , FF_ITERATOR     = '@@' + ITERATOR
  , PROCESS         = 'process'
  , CREATE_ELEMENT  = 'createElement'
  // Aliases global objects and prototypes
  , Function        = global[FUNCTION]
  , Object          = global[OBJECT]
  , Array           = global[ARRAY]
  , String          = global[STRING]
  , Number          = global[NUMBER]
  , RegExp          = global[REGEXP]
  , Date            = global[DATE]
  , Map             = global[MAP]
  , Set             = global[SET]
  , WeakMap         = global[WEAKMAP]
  , WeakSet         = global[WEAKSET]
  , Symbol          = global[SYMBOL]
  , Math            = global[MATH]
  , TypeError       = global.TypeError
  , RangeError      = global.RangeError
  , setTimeout      = global.setTimeout
  , setImmediate    = global.setImmediate
  , clearImmediate  = global.clearImmediate
  , parseInt        = global.parseInt
  , isFinite        = global.isFinite
  , process         = global[PROCESS]
  , nextTick        = process && process.nextTick
  , document        = global.document
  , html            = document && document.documentElement
  , navigator       = global.navigator
  , define          = global.define
  , console         = global.console || {}
  , ArrayProto      = Array[PROTOTYPE]
  , ObjectProto     = Object[PROTOTYPE]
  , FunctionProto   = Function[PROTOTYPE]
  , Infinity        = 1 / 0
  , DOT             = '.';

// http://jsperf.com/core-js-isobject
function isObject(it){
  return it !== null && (typeof it == 'object' || typeof it == 'function');
}
function isFunction(it){
  return typeof it == 'function';
}
// Native function?
var isNative = ctx(/./.test, /\[native code\]\s*\}\s*$/, 1);

// Object internal [[Class]] or toStringTag
// http://people.mozilla.org/~jorendorff/es6-draft.html#sec-object.prototype.tostring
var toString = ObjectProto[TO_STRING];
function setToStringTag(it, tag, stat){
  if(it && !has(it = stat ? it : it[PROTOTYPE], SYMBOL_TAG))hidden(it, SYMBOL_TAG, tag);
}
function cof(it){
  return toString.call(it).slice(8, -1);
}
function classof(it){
  var O, T;
  return it == undefined ? it === undefined ? 'Undefined' : 'Null'
    : typeof (T = (O = Object(it))[SYMBOL_TAG]) == 'string' ? T : cof(O);
}

// Function
var call  = FunctionProto.call
  , apply = FunctionProto.apply
  , REFERENCE_GET;
// Partial apply
function part(/* ...args */){
  var fn     = assertFunction(this)
    , length = arguments.length
    , args   = Array(length)
    , i      = 0
    , _      = path._
    , holder = false;
  while(length > i)if((args[i] = arguments[i++]) === _)holder = true;
  return function(/* ...args */){
    var that    = this
      , _length = arguments.length
      , i = 0, j = 0, _args;
    if(!holder && !_length)return invoke(fn, args, that);
    _args = args.slice();
    if(holder)for(;length > i; i++)if(_args[i] === _)_args[i] = arguments[j++];
    while(_length > j)_args.push(arguments[j++]);
    return invoke(fn, _args, that);
  }
}
// Optional / simple context binding
function ctx(fn, that, length){
  assertFunction(fn);
  if(~length && that === undefined)return fn;
  switch(length){
    case 1: return function(a){
      return fn.call(that, a);
    }
    case 2: return function(a, b){
      return fn.call(that, a, b);
    }
    case 3: return function(a, b, c){
      return fn.call(that, a, b, c);
    }
  } return function(/* ...args */){
      return fn.apply(that, arguments);
  }
}
// Fast apply
// http://jsperf.lnkit.com/fast-apply/5
function invoke(fn, args, that){
  var un = that === undefined;
  switch(args.length | 0){
    case 0: return un ? fn()
                      : fn.call(that);
    case 1: return un ? fn(args[0])
                      : fn.call(that, args[0]);
    case 2: return un ? fn(args[0], args[1])
                      : fn.call(that, args[0], args[1]);
    case 3: return un ? fn(args[0], args[1], args[2])
                      : fn.call(that, args[0], args[1], args[2]);
    case 4: return un ? fn(args[0], args[1], args[2], args[3])
                      : fn.call(that, args[0], args[1], args[2], args[3]);
    case 5: return un ? fn(args[0], args[1], args[2], args[3], args[4])
                      : fn.call(that, args[0], args[1], args[2], args[3], args[4]);
  } return              fn.apply(that, args);
}

// Object:
var create           = Object.create
  , getPrototypeOf   = Object.getPrototypeOf
  , setPrototypeOf   = Object.setPrototypeOf
  , defineProperty   = Object.defineProperty
  , defineProperties = Object.defineProperties
  , getOwnDescriptor = Object.getOwnPropertyDescriptor
  , getKeys          = Object.keys
  , getNames         = Object.getOwnPropertyNames
  , getSymbols       = Object.getOwnPropertySymbols
  , isFrozen         = Object.isFrozen
  , has              = ctx(call, ObjectProto[HAS_OWN], 2)
  // Dummy, fix for not array-like ES3 string in es5 module
  , ES5Object        = Object
  , Dict;
function toObject(it){
  return ES5Object(assertDefined(it));
}
function returnIt(it){
  return it;
}
function returnThis(){
  return this;
}
function get(object, key){
  if(has(object, key))return object[key];
}
function ownKeys(it){
  assertObject(it);
  return getSymbols ? getNames(it).concat(getSymbols(it)) : getNames(it);
}
// 19.1.2.1 Object.assign(target, source, ...)
var assign = Object.assign || function(target, source){
  var T = Object(assertDefined(target))
    , l = arguments.length
    , i = 1;
  while(l > i){
    var S      = ES5Object(arguments[i++])
      , keys   = getKeys(S)
      , length = keys.length
      , j      = 0
      , key;
    while(length > j)T[key = keys[j++]] = S[key];
  }
  return T;
}
function keyOf(object, el){
  var O      = toObject(object)
    , keys   = getKeys(O)
    , length = keys.length
    , index  = 0
    , key;
  while(length > index)if(O[key = keys[index++]] === el)return key;
}

// Array
// array('str1,str2,str3') => ['str1', 'str2', 'str3']
function array(it){
  return String(it).split(',');
}
var push    = ArrayProto.push
  , unshift = ArrayProto.unshift
  , slice   = ArrayProto.slice
  , splice  = ArrayProto.splice
  , indexOf = ArrayProto.indexOf
  , forEach = ArrayProto[FOR_EACH];
/*
 * 0 -> forEach
 * 1 -> map
 * 2 -> filter
 * 3 -> some
 * 4 -> every
 * 5 -> find
 * 6 -> findIndex
 */
function createArrayMethod(type){
  var isMap       = type == 1
    , isFilter    = type == 2
    , isSome      = type == 3
    , isEvery     = type == 4
    , isFindIndex = type == 6
    , noholes     = type == 5 || isFindIndex;
  return function(callbackfn/*, that = undefined */){
    var O      = Object(assertDefined(this))
      , that   = arguments[1]
      , self   = ES5Object(O)
      , f      = ctx(callbackfn, that, 3)
      , length = toLength(self.length)
      , index  = 0
      , result = isMap ? Array(length) : isFilter ? [] : undefined
      , val, res;
    for(;length > index; index++)if(noholes || index in self){
      val = self[index];
      res = f(val, index, O);
      if(type){
        if(isMap)result[index] = res;             // map
        else if(res)switch(type){
          case 3: return true;                    // some
          case 5: return val;                     // find
          case 6: return index;                   // findIndex
          case 2: result.push(val);               // filter
        } else if(isEvery)return false;           // every
      }
    }
    return isFindIndex ? -1 : isSome || isEvery ? isEvery : result;
  }
}
function createArrayContains(isContains){
  return function(el /*, fromIndex = 0 */){
    var O      = toObject(this)
      , length = toLength(O.length)
      , index  = toIndex(arguments[1], length);
    if(isContains && el != el){
      for(;length > index; index++)if(sameNaN(O[index]))return isContains || index;
    } else for(;length > index; index++)if(isContains || index in O){
      if(O[index] === el)return isContains || index;
    } return !isContains && -1;
  }
}
function generic(A, B){
  // strange IE quirks mode bug -> use typeof vs isFunction
  return typeof A == 'function' ? A : B;
}

// Math
var MAX_SAFE_INTEGER = 0x1fffffffffffff // pow(2, 53) - 1 == 9007199254740991
  , pow    = Math.pow
  , abs    = Math.abs
  , ceil   = Math.ceil
  , floor  = Math.floor
  , max    = Math.max
  , min    = Math.min
  , random = Math.random
  , trunc  = Math.trunc || function(it){
      return (it > 0 ? floor : ceil)(it);
    }
// 20.1.2.4 Number.isNaN(number)
function sameNaN(number){
  return number != number;
}
// 7.1.4 ToInteger
function toInteger(it){
  return isNaN(it) ? 0 : trunc(it);
}
// 7.1.15 ToLength
function toLength(it){
  return it > 0 ? min(toInteger(it), MAX_SAFE_INTEGER) : 0;
}
function toIndex(index, length){
  var index = toInteger(index);
  return index < 0 ? max(index + length, 0) : min(index, length);
}
function lz(num){
  return num > 9 ? num : '0' + num;
}

function createReplacer(regExp, replace, isStatic){
  var replacer = isObject(replace) ? function(part){
    return replace[part];
  } : replace;
  return function(it){
    return String(isStatic ? it : this).replace(regExp, replacer);
  }
}
function createPointAt(toString){
  return function(pos){
    var s = String(assertDefined(this))
      , i = toInteger(pos)
      , l = s.length
      , a, b;
    if(i < 0 || i >= l)return toString ? '' : undefined;
    a = s.charCodeAt(i);
    return a < 0xd800 || a > 0xdbff || i + 1 === l || (b = s.charCodeAt(i + 1)) < 0xdc00 || b > 0xdfff
      ? toString ? s.charAt(i) : a
      : toString ? s.slice(i, i + 2) : (a - 0xd800 << 10) + (b - 0xdc00) + 0x10000;
  }
}

// Assertion & errors
var REDUCE_ERROR = 'Reduce of empty object with no initial value';
function assert(condition, msg1, msg2){
  if(!condition)throw TypeError(msg2 ? msg1 + msg2 : msg1);
}
function assertDefined(it){
  if(it == undefined)throw TypeError('Function called on null or undefined');
  return it;
}
function assertFunction(it){
  assert(isFunction(it), it, ' is not a function!');
  return it;
}
function assertObject(it){
  assert(isObject(it), it, ' is not an object!');
  return it;
}
function assertInstance(it, Constructor, name){
  assert(it instanceof Constructor, name, ": use the 'new' operator!");
}

// Property descriptors & Symbol
function descriptor(bitmap, value){
  return {
    enumerable  : !(bitmap & 1),
    configurable: !(bitmap & 2),
    writable    : !(bitmap & 4),
    value       : value
  }
}
function simpleSet(object, key, value){
  object[key] = value;
  return object;
}
function createDefiner(bitmap){
  return DESC ? function(object, key, value){
    return defineProperty(object, key, descriptor(bitmap, value));
  } : simpleSet;
}
function uid(key){
  return SYMBOL + '(' + key + ')_' + (++sid + random())[TO_STRING](36);
}
function getWellKnownSymbol(name, setter){
  return (Symbol && Symbol[name]) || (setter ? Symbol : safeSymbol)(SYMBOL + DOT + name);
}
// The engine works fine with descriptors? Thank's IE8 for his funny defineProperty.
var DESC = !!function(){
      try {
        return defineProperty({}, 'a', {get: function(){ return 2 }}).a == 2;
      } catch(e){}
    }()
  , sid    = 0
  , hidden = createDefiner(1)
  , set    = Symbol ? simpleSet : hidden
  , safeSymbol = Symbol || uid;
function assignHidden(target, src){
  for(var key in src)hidden(target, key, src[key]);
  return target;
}

var SYMBOL_UNSCOPABLES = getWellKnownSymbol('unscopables')
  , ArrayUnscopables   = ArrayProto[SYMBOL_UNSCOPABLES] || {}
  , SYMBOL_TAG         = getWellKnownSymbol(TO_STRING_TAG)
  , SYMBOL_SPECIES     = getWellKnownSymbol('species')
  , SYMBOL_ITERATOR;
function setSpecies(C){
  if(DESC && (framework || !isNative(C)))defineProperty(C, SYMBOL_SPECIES, {
    configurable: true,
    get: returnThis
  });
}

/******************************************************************************
 * Module : common.export                                                     *
 ******************************************************************************/

var NODE = cof(process) == PROCESS
  , core = {}
  , path = framework ? global : core
  , old  = global.core
  , exportGlobal
  // type bitmap
  , FORCED = 1
  , GLOBAL = 2
  , STATIC = 4
  , PROTO  = 8
  , BIND   = 16
  , WRAP   = 32;
function $define(type, name, source){
  var key, own, out, exp
    , isGlobal = type & GLOBAL
    , target   = isGlobal ? global : (type & STATIC)
        ? global[name] : (global[name] || ObjectProto)[PROTOTYPE]
    , exports  = isGlobal ? core : core[name] || (core[name] = {});
  if(isGlobal)source = name;
  for(key in source){
    // there is a similar native
    own = !(type & FORCED) && target && key in target
      && (!isFunction(target[key]) || isNative(target[key]));
    // export native or passed
    out = (own ? target : source)[key];
    // prevent global pollution for namespaces
    if(!framework && isGlobal && !isFunction(target[key]))exp = source[key];
    // bind timers to global for call from export context
    else if(type & BIND && own)exp = ctx(out, global);
    // wrap global constructors for prevent change them in library
    else if(type & WRAP && !framework && target[key] == out){
      exp = function(param){
        return this instanceof out ? new out(param) : out(param);
      }
      exp[PROTOTYPE] = out[PROTOTYPE];
    } else exp = type & PROTO && isFunction(out) ? ctx(call, out) : out;
    // extend global
    if(framework && target && !own){
      if(isGlobal)target[key] = out;
      else delete target[key] && hidden(target, key, out);
    }
    // export
    if(exports[key] != out)hidden(exports, key, exp);
  }
}
// CommonJS export
if(typeof module != 'undefined' && module.exports)module.exports = core;
// RequireJS export
else if(isFunction(define) && define.amd)define(function(){return core});
// Export to global object
else exportGlobal = true;
if(exportGlobal || framework){
  core.noConflict = function(){
    global.core = old;
    return core;
  }
  global.core = core;
}

/******************************************************************************
 * Module : common.iterators                                                  *
 ******************************************************************************/

SYMBOL_ITERATOR = getWellKnownSymbol(ITERATOR);
var ITER  = safeSymbol('iter')
  , KEY   = 1
  , VALUE = 2
  , Iterators = {}
  , IteratorPrototype = {}
    // Safari has byggy iterators w/o `next`
  , BUGGY_ITERATORS = 'keys' in ArrayProto && !('next' in [].keys());
// 25.1.2.1.1 %IteratorPrototype%[@@iterator]()
setIterator(IteratorPrototype, returnThis);
function setIterator(O, value){
  hidden(O, SYMBOL_ITERATOR, value);
  // Add iterator for FF iterator protocol
  FF_ITERATOR in ArrayProto && hidden(O, FF_ITERATOR, value);
}
function createIterator(Constructor, NAME, next, proto){
  Constructor[PROTOTYPE] = create(proto || IteratorPrototype, {next: descriptor(1, next)});
  setToStringTag(Constructor, NAME + ' Iterator');
}
function defineIterator(Constructor, NAME, value, DEFAULT){
  var proto = Constructor[PROTOTYPE]
    , iter  = get(proto, SYMBOL_ITERATOR) || get(proto, FF_ITERATOR) || (DEFAULT && get(proto, DEFAULT)) || value;
  if(framework){
    // Define iterator
    setIterator(proto, iter);
    if(iter !== value){
      var iterProto = getPrototypeOf(iter.call(new Constructor));
      // Set @@toStringTag to native iterators
      setToStringTag(iterProto, NAME + ' Iterator', true);
      // FF fix
      has(proto, FF_ITERATOR) && setIterator(iterProto, returnThis);
    }
  }
  // Plug for library
  Iterators[NAME] = iter;
  // FF & v8 fix
  Iterators[NAME + ' Iterator'] = returnThis;
  return iter;
}
function defineStdIterators(Base, NAME, Constructor, next, DEFAULT, IS_SET){
  function createIter(kind){
    return function(){
      return new Constructor(this, kind);
    }
  }
  createIterator(Constructor, NAME, next);
  var entries = createIter(KEY+VALUE)
    , values  = createIter(VALUE);
  if(DEFAULT == VALUE)values = defineIterator(Base, NAME, values, 'values');
  else entries = defineIterator(Base, NAME, entries, 'entries');
  if(DEFAULT){
    $define(PROTO + FORCED * BUGGY_ITERATORS, NAME, {
      entries: entries,
      keys: IS_SET ? values : createIter(KEY),
      values: values
    });
  }
}
function iterResult(done, value){
  return {value: value, done: !!done};
}
function isIterable(it){
  var O      = Object(it)
    , Symbol = global[SYMBOL]
    , hasExt = (Symbol && Symbol[ITERATOR] || FF_ITERATOR) in O;
  return hasExt || SYMBOL_ITERATOR in O || has(Iterators, classof(O));
}
function getIterator(it){
  var Symbol  = global[SYMBOL]
    , ext     = it[Symbol && Symbol[ITERATOR] || FF_ITERATOR]
    , getIter = ext || it[SYMBOL_ITERATOR] || Iterators[classof(it)];
  return assertObject(getIter.call(it));
}
function stepCall(fn, value, entries){
  return entries ? invoke(fn, value) : fn(value);
}
function checkDangerIterClosing(fn){
  var danger = true;
  var O = {
    next: function(){ throw 1 },
    'return': function(){ danger = false }
  };
  O[SYMBOL_ITERATOR] = returnThis;
  try {
    fn(O);
  } catch(e){}
  return danger;
}
function closeIterator(iterator){
  var ret = iterator['return'];
  if(ret !== undefined)ret.call(iterator);
}
function safeIterClose(exec, iterator){
  try {
    exec(iterator);
  } catch(e){
    closeIterator(iterator);
    throw e;
  }
}
function forOf(iterable, entries, fn, that){
  safeIterClose(function(iterator){
    var f = ctx(fn, that, entries ? 2 : 1)
      , step;
    while(!(step = iterator.next()).done)if(stepCall(f, step.value, entries) === false){
      return closeIterator(iterator);
    }
  }, getIterator(iterable));
}

/******************************************************************************
 * Module : es6.symbol                                                        *
 ******************************************************************************/

// ECMAScript 6 symbols shim
!function(TAG, SymbolRegistry, AllSymbols, setter){
  // 19.4.1.1 Symbol([description])
  if(!isNative(Symbol)){
    Symbol = function(description){
      assert(!(this instanceof Symbol), SYMBOL + ' is not a ' + CONSTRUCTOR);
      var tag = uid(description)
        , sym = set(create(Symbol[PROTOTYPE]), TAG, tag);
      AllSymbols[tag] = sym;
      DESC && setter && defineProperty(ObjectProto, tag, {
        configurable: true,
        set: function(value){
          hidden(this, tag, value);
        }
      });
      return sym;
    }
    hidden(Symbol[PROTOTYPE], TO_STRING, function(){
      return this[TAG];
    });
  }
  $define(GLOBAL + WRAP, {Symbol: Symbol});
  
  var symbolStatics = {
    // 19.4.2.1 Symbol.for(key)
    'for': function(key){
      return has(SymbolRegistry, key += '')
        ? SymbolRegistry[key]
        : SymbolRegistry[key] = Symbol(key);
    },
    // 19.4.2.4 Symbol.iterator
    iterator: SYMBOL_ITERATOR || getWellKnownSymbol(ITERATOR),
    // 19.4.2.5 Symbol.keyFor(sym)
    keyFor: part.call(keyOf, SymbolRegistry),
    // 19.4.2.10 Symbol.species
    species: SYMBOL_SPECIES,
    // 19.4.2.13 Symbol.toStringTag
    toStringTag: SYMBOL_TAG = getWellKnownSymbol(TO_STRING_TAG, true),
    // 19.4.2.14 Symbol.unscopables
    unscopables: SYMBOL_UNSCOPABLES,
    pure: safeSymbol,
    set: set,
    useSetter: function(){setter = true},
    useSimple: function(){setter = false}
  };
  // 19.4.2.2 Symbol.hasInstance
  // 19.4.2.3 Symbol.isConcatSpreadable
  // 19.4.2.6 Symbol.match
  // 19.4.2.8 Symbol.replace
  // 19.4.2.9 Symbol.search
  // 19.4.2.11 Symbol.split
  // 19.4.2.12 Symbol.toPrimitive
  forEach.call(array('hasInstance,isConcatSpreadable,match,replace,search,split,toPrimitive'),
    function(it){
      symbolStatics[it] = getWellKnownSymbol(it);
    }
  );
  $define(STATIC, SYMBOL, symbolStatics);
  
  setToStringTag(Symbol, SYMBOL);
  
  $define(STATIC + FORCED * !isNative(Symbol), OBJECT, {
    // 19.1.2.7 Object.getOwnPropertyNames(O)
    getOwnPropertyNames: function(it){
      var names = getNames(toObject(it)), result = [], key, i = 0;
      while(names.length > i)has(AllSymbols, key = names[i++]) || result.push(key);
      return result;
    },
    // 19.1.2.8 Object.getOwnPropertySymbols(O)
    getOwnPropertySymbols: function(it){
      var names = getNames(toObject(it)), result = [], key, i = 0;
      while(names.length > i)has(AllSymbols, key = names[i++]) && result.push(AllSymbols[key]);
      return result;
    }
  });
  
  // 20.2.1.9 Math[@@toStringTag]
  setToStringTag(Math, MATH, true);
  // 24.3.3 JSON[@@toStringTag]
  setToStringTag(global.JSON, 'JSON', true);
}(safeSymbol('tag'), {}, {}, true);

/******************************************************************************
 * Module : es6.object.statics                                                *
 ******************************************************************************/

!function(){
  var objectStatic = {
    // 19.1.3.1 Object.assign(target, source)
    assign: assign,
    // 19.1.3.10 Object.is(value1, value2)
    is: function(x, y){
      return x === y ? x !== 0 || 1 / x === 1 / y : x != x && y != y;
    }
  };
  // 19.1.3.19 Object.setPrototypeOf(O, proto)
  // Works with __proto__ only. Old v8 can't works with null proto objects.
  '__proto__' in ObjectProto && function(buggy, set){
    try {
      set = ctx(call, getOwnDescriptor(ObjectProto, '__proto__').set, 2);
      set({}, ArrayProto);
    } catch(e){ buggy = true }
    objectStatic.setPrototypeOf = setPrototypeOf = setPrototypeOf || function(O, proto){
      assertObject(O);
      assert(proto === null || isObject(proto), proto, ": can't set as prototype!");
      if(buggy)O.__proto__ = proto;
      else set(O, proto);
      return O;
    }
  }();
  $define(STATIC, OBJECT, objectStatic);
}();

/******************************************************************************
 * Module : es6.object.statics-accept-primitives                              *
 ******************************************************************************/

!function(){
  // Object static methods accept primitives
  function wrapObjectMethod(key, MODE){
    var fn  = Object[key]
      , exp = core[OBJECT][key]
      , f   = 0
      , o   = {};
    if(!exp || isNative(exp)){
      o[key] = MODE == 1 ? function(it){
        return isObject(it) ? fn(it) : it;
      } : MODE == 2 ? function(it){
        return isObject(it) ? fn(it) : true;
      } : MODE == 3 ? function(it){
        return isObject(it) ? fn(it) : false;
      } : MODE == 4 ? function(it, key){
        return fn(toObject(it), key);
      } : function(it){
        return fn(toObject(it));
      };
      try { fn(DOT) }
      catch(e){ f = 1 }
      $define(STATIC + FORCED * f, OBJECT, o);
    }
  }
  wrapObjectMethod('freeze', 1);
  wrapObjectMethod('seal', 1);
  wrapObjectMethod('preventExtensions', 1);
  wrapObjectMethod('isFrozen', 2);
  wrapObjectMethod('isSealed', 2);
  wrapObjectMethod('isExtensible', 3);
  wrapObjectMethod('getOwnPropertyDescriptor', 4);
  wrapObjectMethod('getPrototypeOf');
  wrapObjectMethod('keys');
  wrapObjectMethod('getOwnPropertyNames');
}();

/******************************************************************************
 * Module : es6.number.statics                                                *
 ******************************************************************************/

!function(isInteger){
  $define(STATIC, NUMBER, {
    // 20.1.2.1 Number.EPSILON
    EPSILON: pow(2, -52),
    // 20.1.2.2 Number.isFinite(number)
    isFinite: function(it){
      return typeof it == 'number' && isFinite(it);
    },
    // 20.1.2.3 Number.isInteger(number)
    isInteger: isInteger,
    // 20.1.2.4 Number.isNaN(number)
    isNaN: sameNaN,
    // 20.1.2.5 Number.isSafeInteger(number)
    isSafeInteger: function(number){
      return isInteger(number) && abs(number) <= MAX_SAFE_INTEGER;
    },
    // 20.1.2.6 Number.MAX_SAFE_INTEGER
    MAX_SAFE_INTEGER: MAX_SAFE_INTEGER,
    // 20.1.2.10 Number.MIN_SAFE_INTEGER
    MIN_SAFE_INTEGER: -MAX_SAFE_INTEGER,
    // 20.1.2.12 Number.parseFloat(string)
    parseFloat: parseFloat,
    // 20.1.2.13 Number.parseInt(string, radix)
    parseInt: parseInt
  });
// 20.1.2.3 Number.isInteger(number)
}(Number.isInteger || function(it){
  return !isObject(it) && isFinite(it) && floor(it) === it;
});

/******************************************************************************
 * Module : es6.math                                                          *
 ******************************************************************************/

// ECMAScript 6 shim
!function(){
  // 20.2.2.28 Math.sign(x)
  var E    = Math.E
    , exp  = Math.exp
    , log  = Math.log
    , sqrt = Math.sqrt
    , sign = Math.sign || function(x){
        return (x = +x) == 0 || x != x ? x : x < 0 ? -1 : 1;
      };
  
  // 20.2.2.5 Math.asinh(x)
  function asinh(x){
    return !isFinite(x = +x) || x == 0 ? x : x < 0 ? -asinh(-x) : log(x + sqrt(x * x + 1));
  }
  // 20.2.2.14 Math.expm1(x)
  function expm1(x){
    return (x = +x) == 0 ? x : x > -1e-6 && x < 1e-6 ? x + x * x / 2 : exp(x) - 1;
  }
    
  $define(STATIC, MATH, {
    // 20.2.2.3 Math.acosh(x)
    acosh: function(x){
      return (x = +x) < 1 ? NaN : isFinite(x) ? log(x / E + sqrt(x + 1) * sqrt(x - 1) / E) + 1 : x;
    },
    // 20.2.2.5 Math.asinh(x)
    asinh: asinh,
    // 20.2.2.7 Math.atanh(x)
    atanh: function(x){
      return (x = +x) == 0 ? x : log((1 + x) / (1 - x)) / 2;
    },
    // 20.2.2.9 Math.cbrt(x)
    cbrt: function(x){
      return sign(x = +x) * pow(abs(x), 1 / 3);
    },
    // 20.2.2.11 Math.clz32(x)
    clz32: function(x){
      return (x >>>= 0) ? 32 - x[TO_STRING](2).length : 32;
    },
    // 20.2.2.12 Math.cosh(x)
    cosh: function(x){
      return (exp(x = +x) + exp(-x)) / 2;
    },
    // 20.2.2.14 Math.expm1(x)
    expm1: expm1,
    // 20.2.2.16 Math.fround(x)
    // TODO: fallback for IE9-
    fround: function(x){
      return new Float32Array([x])[0];
    },
    // 20.2.2.17 Math.hypot([value1[, value2[, … ]]])
    hypot: function(value1, value2){
      var sum  = 0
        , len1 = arguments.length
        , len2 = len1
        , args = Array(len1)
        , larg = -Infinity
        , arg;
      while(len1--){
        arg = args[len1] = +arguments[len1];
        if(arg == Infinity || arg == -Infinity)return Infinity;
        if(arg > larg)larg = arg;
      }
      larg = arg || 1;
      while(len2--)sum += pow(args[len2] / larg, 2);
      return larg * sqrt(sum);
    },
    // 20.2.2.18 Math.imul(x, y)
    imul: function(x, y){
      var UInt16 = 0xffff
        , xn = +x
        , yn = +y
        , xl = UInt16 & xn
        , yl = UInt16 & yn;
      return 0 | xl * yl + ((UInt16 & xn >>> 16) * yl + xl * (UInt16 & yn >>> 16) << 16 >>> 0);
    },
    // 20.2.2.20 Math.log1p(x)
    log1p: function(x){
      return (x = +x) > -1e-8 && x < 1e-8 ? x - x * x / 2 : log(1 + x);
    },
    // 20.2.2.21 Math.log10(x)
    log10: function(x){
      return log(x) / Math.LN10;
    },
    // 20.2.2.22 Math.log2(x)
    log2: function(x){
      return log(x) / Math.LN2;
    },
    // 20.2.2.28 Math.sign(x)
    sign: sign,
    // 20.2.2.30 Math.sinh(x)
    sinh: function(x){
      return (abs(x = +x) < 1) ? (expm1(x) - expm1(-x)) / 2 : (exp(x - 1) - exp(-x - 1)) * (E / 2);
    },
    // 20.2.2.33 Math.tanh(x)
    tanh: function(x){
      var a = expm1(x = +x)
        , b = expm1(-x);
      return a == Infinity ? 1 : b == Infinity ? -1 : (a - b) / (exp(x) + exp(-x));
    },
    // 20.2.2.34 Math.trunc(x)
    trunc: trunc
  });
}();

/******************************************************************************
 * Module : es6.string                                                        *
 ******************************************************************************/

!function(fromCharCode){
  function assertNotRegExp(it){
    if(cof(it) == REGEXP)throw TypeError();
  }
  
  $define(STATIC, STRING, {
    // 21.1.2.2 String.fromCodePoint(...codePoints)
    fromCodePoint: function(x){
      var res = []
        , len = arguments.length
        , i   = 0
        , code
      while(len > i){
        code = +arguments[i++];
        if(toIndex(code, 0x10ffff) !== code)throw RangeError(code + ' is not a valid code point');
        res.push(code < 0x10000
          ? fromCharCode(code)
          : fromCharCode(((code -= 0x10000) >> 10) + 0xd800, code % 0x400 + 0xdc00)
        );
      } return res.join('');
    },
    // 21.1.2.4 String.raw(callSite, ...substitutions)
    raw: function(callSite){
      var raw = toObject(callSite.raw)
        , len = toLength(raw.length)
        , sln = arguments.length
        , res = []
        , i   = 0;
      while(len > i){
        res.push(String(raw[i++]));
        if(i < sln)res.push(String(arguments[i]));
      } return res.join('');
    }
  });
  
  $define(PROTO, STRING, {
    // 21.1.3.3 String.prototype.codePointAt(pos)
    codePointAt: createPointAt(false),
    // 21.1.3.6 String.prototype.endsWith(searchString [, endPosition])
    endsWith: function(searchString /*, endPosition = @length */){
      assertNotRegExp(searchString);
      var that = String(assertDefined(this))
        , endPosition = arguments[1]
        , len = toLength(that.length)
        , end = endPosition === undefined ? len : min(toLength(endPosition), len);
      searchString += '';
      return that.slice(end - searchString.length, end) === searchString;
    },
    // 21.1.3.7 String.prototype.includes(searchString, position = 0)
    includes: function(searchString /*, position = 0 */){
      assertNotRegExp(searchString);
      return !!~String(assertDefined(this)).indexOf(searchString, arguments[1]);
    },
    // 21.1.3.13 String.prototype.repeat(count)
    repeat: function(count){
      var str = String(assertDefined(this))
        , res = ''
        , n   = toInteger(count);
      if(0 > n || n == Infinity)throw RangeError("Count can't be negative");
      for(;n > 0; (n >>>= 1) && (str += str))if(n & 1)res += str;
      return res;
    },
    // 21.1.3.18 String.prototype.startsWith(searchString [, position ])
    startsWith: function(searchString /*, position = 0 */){
      assertNotRegExp(searchString);
      var that  = String(assertDefined(this))
        , index = toLength(min(arguments[1], that.length));
      searchString += '';
      return that.slice(index, index + searchString.length) === searchString;
    }
  });
}(String.fromCharCode);

/******************************************************************************
 * Module : es6.array.statics                                                 *
 ******************************************************************************/

!function(){
  $define(STATIC + FORCED * checkDangerIterClosing(Array.from), ARRAY, {
    // 22.1.2.1 Array.from(arrayLike, mapfn = undefined, thisArg = undefined)
    from: function(arrayLike/*, mapfn = undefined, thisArg = undefined*/){
      var O       = Object(assertDefined(arrayLike))
        , mapfn   = arguments[1]
        , mapping = mapfn !== undefined
        , f       = mapping ? ctx(mapfn, arguments[2], 2) : undefined
        , index   = 0
        , length, result, step;
      if(isIterable(O)){
        result = new (generic(this, Array));
        safeIterClose(function(iterator){
          for(; !(step = iterator.next()).done; index++){
            result[index] = mapping ? f(step.value, index) : step.value;
          }
        }, getIterator(O));
      } else {
        result = new (generic(this, Array))(length = toLength(O.length));
        for(; length > index; index++){
          result[index] = mapping ? f(O[index], index) : O[index];
        }
      }
      result.length = index;
      return result;
    }
  });
  
  $define(STATIC, ARRAY, {
    // 22.1.2.3 Array.of( ...items)
    of: function(/* ...args */){
      var index  = 0
        , length = arguments.length
        , result = new (generic(this, Array))(length);
      while(length > index)result[index] = arguments[index++];
      result.length = length;
      return result;
    }
  });
  
  setSpecies(Array);
}();

/******************************************************************************
 * Module : es6.array.prototype                                               *
 ******************************************************************************/

!function(){
  $define(PROTO, ARRAY, {
    // 22.1.3.3 Array.prototype.copyWithin(target, start, end = this.length)
    copyWithin: function(target /* = 0 */, start /* = 0, end = @length */){
      var O     = Object(assertDefined(this))
        , len   = toLength(O.length)
        , to    = toIndex(target, len)
        , from  = toIndex(start, len)
        , end   = arguments[2]
        , fin   = end === undefined ? len : toIndex(end, len)
        , count = min(fin - from, len - to)
        , inc   = 1;
      if(from < to && to < from + count){
        inc  = -1;
        from = from + count - 1;
        to   = to + count - 1;
      }
      while(count-- > 0){
        if(from in O)O[to] = O[from];
        else delete O[to];
        to += inc;
        from += inc;
      } return O;
    },
    // 22.1.3.6 Array.prototype.fill(value, start = 0, end = this.length)
    fill: function(value /*, start = 0, end = @length */){
      var O      = Object(assertDefined(this))
        , length = toLength(O.length)
        , index  = toIndex(arguments[1], length)
        , end    = arguments[2]
        , endPos = end === undefined ? length : toIndex(end, length);
      while(endPos > index)O[index++] = value;
      return O;
    },
    // 22.1.3.8 Array.prototype.find(predicate, thisArg = undefined)
    find: createArrayMethod(5),
    // 22.1.3.9 Array.prototype.findIndex(predicate, thisArg = undefined)
    findIndex: createArrayMethod(6)
  });
  
  if(framework){
    // 22.1.3.31 Array.prototype[@@unscopables]
    forEach.call(array('find,findIndex,fill,copyWithin,entries,keys,values'), function(it){
      ArrayUnscopables[it] = true;
    });
    SYMBOL_UNSCOPABLES in ArrayProto || hidden(ArrayProto, SYMBOL_UNSCOPABLES, ArrayUnscopables);
  }
}();

/******************************************************************************
 * Module : es6.iterators                                                     *
 ******************************************************************************/

!function(at){
  // 22.1.3.4 Array.prototype.entries()
  // 22.1.3.13 Array.prototype.keys()
  // 22.1.3.29 Array.prototype.values()
  // 22.1.3.30 Array.prototype[@@iterator]()
  defineStdIterators(Array, ARRAY, function(iterated, kind){
    set(this, ITER, {o: toObject(iterated), i: 0, k: kind});
  // 22.1.5.2.1 %ArrayIteratorPrototype%.next()
  }, function(){
    var iter  = this[ITER]
      , O     = iter.o
      , kind  = iter.k
      , index = iter.i++;
    if(!O || index >= O.length){
      iter.o = undefined;
      return iterResult(1);
    }
    if(kind == KEY)  return iterResult(0, index);
    if(kind == VALUE)return iterResult(0, O[index]);
                     return iterResult(0, [index, O[index]]);
  }, VALUE);
  
  // argumentsList[@@iterator] is %ArrayProto_values% (9.4.4.6, 9.4.4.7)
  Iterators[ARGUMENTS] = Iterators[ARRAY];
  
  // 21.1.3.27 String.prototype[@@iterator]()
  defineStdIterators(String, STRING, function(iterated){
    set(this, ITER, {o: String(iterated), i: 0});
  // 21.1.5.2.1 %StringIteratorPrototype%.next()
  }, function(){
    var iter  = this[ITER]
      , O     = iter.o
      , index = iter.i
      , point;
    if(index >= O.length)return iterResult(1);
    point = at.call(O, index);
    iter.i += point.length;
    return iterResult(0, point);
  });
}(createPointAt(true));

/******************************************************************************
 * Module : web.immediate                                                     *
 ******************************************************************************/

// setImmediate shim
// Node.js 0.9+ & IE10+ has setImmediate, else:
isFunction(setImmediate) && isFunction(clearImmediate) || function(ONREADYSTATECHANGE){
  var postMessage      = global.postMessage
    , addEventListener = global.addEventListener
    , MessageChannel   = global.MessageChannel
    , counter          = 0
    , queue            = {}
    , defer, channel, port;
  setImmediate = function(fn){
    var args = [], i = 1;
    while(arguments.length > i)args.push(arguments[i++]);
    queue[++counter] = function(){
      invoke(isFunction(fn) ? fn : Function(fn), args);
    }
    defer(counter);
    return counter;
  }
  clearImmediate = function(id){
    delete queue[id];
  }
  function run(id){
    if(has(queue, id)){
      var fn = queue[id];
      delete queue[id];
      fn();
    }
  }
  function listner(event){
    run(event.data);
  }
  // Node.js 0.8-
  if(NODE){
    defer = function(id){
      nextTick(part.call(run, id));
    }
  // Modern browsers, skip implementation for WebWorkers
  // IE8 has postMessage, but it's sync & typeof its postMessage is object
  } else if(addEventListener && isFunction(postMessage) && !global.importScripts){
    defer = function(id){
      postMessage(id, '*');
    }
    addEventListener('message', listner, false);
  // WebWorkers
  } else if(isFunction(MessageChannel)){
    channel = new MessageChannel;
    port    = channel.port2;
    channel.port1.onmessage = listner;
    defer = ctx(port.postMessage, port, 1);
  // IE8-
  } else if(document && ONREADYSTATECHANGE in document[CREATE_ELEMENT]('script')){
    defer = function(id){
      html.appendChild(document[CREATE_ELEMENT]('script'))[ONREADYSTATECHANGE] = function(){
        html.removeChild(this);
        run(id);
      }
    }
  // Rest old browsers
  } else {
    defer = function(id){
      setTimeout(run, 0, id);
    }
  }
}('onreadystatechange');
$define(GLOBAL + BIND, {
  setImmediate:   setImmediate,
  clearImmediate: clearImmediate
});

/******************************************************************************
 * Module : es6.promise                                                       *
 ******************************************************************************/

// ES6 promises shim
// Based on https://github.com/getify/native-promise-only/
!function(Promise, test){
  isFunction(Promise) && isFunction(Promise.resolve)
  && Promise.resolve(test = new Promise(function(){})) == test
  || function(asap, RECORD){
    function isThenable(it){
      var then;
      if(isObject(it))then = it.then;
      return isFunction(then) ? then : false;
    }
    function handledRejectionOrHasOnRejected(promise){
      var record = promise[RECORD]
        , chain  = record.c
        , i      = 0
        , react;
      if(record.h)return true;
      while(chain.length > i){
        react = chain[i++];
        if(react.fail || handledRejectionOrHasOnRejected(react.P))return true;
      }
    }
    function notify(record, reject){
      var chain = record.c;
      if(reject || chain.length)asap(function(){
        var promise = record.p
          , value   = record.v
          , ok      = record.s == 1
          , i       = 0;
        if(reject && !handledRejectionOrHasOnRejected(promise)){
          setTimeout(function(){
            if(!handledRejectionOrHasOnRejected(promise)){
              if(NODE){
                if(!process.emit('unhandledRejection', value, promise)){
                  // default node.js behavior
                }
              } else if(isFunction(console.error)){
                console.error('Unhandled promise rejection', value);
              }
            }
          }, 1e3);
        } else while(chain.length > i)!function(react){
          var cb = ok ? react.ok : react.fail
            , ret, then;
          try {
            if(cb){
              if(!ok)record.h = true;
              ret = cb === true ? value : cb(value);
              if(ret === react.P){
                react.rej(TypeError(PROMISE + '-chain cycle'));
              } else if(then = isThenable(ret)){
                then.call(ret, react.res, react.rej);
              } else react.res(ret);
            } else react.rej(value);
          } catch(err){
            react.rej(err);
          }
        }(chain[i++]);
        chain.length = 0;
      });
    }
    function resolve(value){
      var record = this
        , then, wrapper;
      if(record.d)return;
      record.d = true;
      record = record.r || record; // unwrap
      try {
        if(then = isThenable(value)){
          wrapper = {r: record, d: false}; // wrap
          then.call(value, ctx(resolve, wrapper, 1), ctx(reject, wrapper, 1));
        } else {
          record.v = value;
          record.s = 1;
          notify(record);
        }
      } catch(err){
        reject.call(wrapper || {r: record, d: false}, err); // wrap
      }
    }
    function reject(value){
      var record = this;
      if(record.d)return;
      record.d = true;
      record = record.r || record; // unwrap
      record.v = value;
      record.s = 2;
      notify(record, true);
    }
    function getConstructor(C){
      var S = assertObject(C)[SYMBOL_SPECIES];
      return S != undefined ? S : C;
    }
    // 25.4.3.1 Promise(executor)
    Promise = function(executor){
      assertFunction(executor);
      assertInstance(this, Promise, PROMISE);
      var record = {
        p: this,      // promise
        c: [],        // chain
        s: 0,         // state
        d: false,     // done
        v: undefined, // value
        h: false      // handled rejection
      };
      hidden(this, RECORD, record);
      try {
        executor(ctx(resolve, record, 1), ctx(reject, record, 1));
      } catch(err){
        reject.call(record, err);
      }
    }
    assignHidden(Promise[PROTOTYPE], {
      // 25.4.5.3 Promise.prototype.then(onFulfilled, onRejected)
      then: function(onFulfilled, onRejected){
        var S = assertObject(assertObject(this)[CONSTRUCTOR])[SYMBOL_SPECIES];
        var react = {
          ok:   isFunction(onFulfilled) ? onFulfilled : true,
          fail: isFunction(onRejected)  ? onRejected  : false
        } , P = react.P = new (S != undefined ? S : Promise)(function(resolve, reject){
          react.res = assertFunction(resolve);
          react.rej = assertFunction(reject);
        }), record = this[RECORD];
        record.c.push(react);
        record.s && notify(record);
        return P;
      },
      // 25.4.5.1 Promise.prototype.catch(onRejected)
      'catch': function(onRejected){
        return this.then(undefined, onRejected);
      }
    });
    assignHidden(Promise, {
      // 25.4.4.1 Promise.all(iterable)
      all: function(iterable){
        var Promise = getConstructor(this)
          , values  = [];
        return new Promise(function(resolve, reject){
          forOf(iterable, false, push, values);
          var remaining = values.length
            , results   = Array(remaining);
          if(remaining)forEach.call(values, function(promise, index){
            Promise.resolve(promise).then(function(value){
              results[index] = value;
              --remaining || resolve(results);
            }, reject);
          });
          else resolve(results);
        });
      },
      // 25.4.4.4 Promise.race(iterable)
      race: function(iterable){
        var Promise = getConstructor(this);
        return new Promise(function(resolve, reject){
          forOf(iterable, false, function(promise){
            Promise.resolve(promise).then(resolve, reject);
          });
        });
      },
      // 25.4.4.5 Promise.reject(r)
      reject: function(r){
        return new (getConstructor(this))(function(resolve, reject){
          reject(r);
        });
      },
      // 25.4.4.6 Promise.resolve(x)
      resolve: function(x){
        return isObject(x) && RECORD in x && getPrototypeOf(x) === this[PROTOTYPE]
          ? x : new (getConstructor(this))(function(resolve, reject){
            resolve(x);
          });
      }
    });
  }(nextTick || setImmediate, safeSymbol('record'));
  setToStringTag(Promise, PROMISE);
  setSpecies(Promise);
  $define(GLOBAL + FORCED * !isNative(Promise), {Promise: Promise});
}(global[PROMISE]);

/******************************************************************************
 * Module : es6.collections                                                   *
 ******************************************************************************/

// ECMAScript 6 collections shim
!function(){
  var UID   = safeSymbol('uid')
    , O1    = safeSymbol('O1')
    , WEAK  = safeSymbol('weak')
    , LEAK  = safeSymbol('leak')
    , LAST  = safeSymbol('last')
    , FIRST = safeSymbol('first')
    , SIZE  = DESC ? safeSymbol('size') : 'size'
    , uid   = 0
    , tmp   = {};
  
  function getCollection(C, NAME, methods, commonMethods, isMap, isWeak){
    var ADDER = isMap ? 'set' : 'add'
      , proto = C && C[PROTOTYPE]
      , O     = {};
    function initFromIterable(that, iterable){
      if(iterable != undefined)forOf(iterable, isMap, that[ADDER], that);
      return that;
    }
    function fixSVZ(key, chain){
      var method = proto[key];
      if(framework)proto[key] = function(a, b){
        var result = method.call(this, a === 0 ? 0 : a, b);
        return chain ? this : result;
      };
    }
    if(!isNative(C) || !(isWeak || (!BUGGY_ITERATORS && has(proto, FOR_EACH) && has(proto, 'entries')))){
      // create collection constructor
      C = isWeak
        ? function(iterable){
            assertInstance(this, C, NAME);
            set(this, UID, uid++);
            initFromIterable(this, iterable);
          }
        : function(iterable){
            var that = this;
            assertInstance(that, C, NAME);
            set(that, O1, create(null));
            set(that, SIZE, 0);
            set(that, LAST, undefined);
            set(that, FIRST, undefined);
            initFromIterable(that, iterable);
          };
      assignHidden(assignHidden(C[PROTOTYPE], methods), commonMethods);
      isWeak || !DESC || defineProperty(C[PROTOTYPE], 'size', {get: function(){
        return assertDefined(this[SIZE]);
      }});
    } else {
      var Native = C
        , inst   = new C
        , chain  = inst[ADDER](isWeak ? {} : -0, 1)
        , buggyZero;
      // wrap to init collections from iterable
      if(checkDangerIterClosing(function(O){ new C(O) })){
        C = function(iterable){
          assertInstance(this, C, NAME);
          return initFromIterable(new Native, iterable);
        }
        C[PROTOTYPE] = proto;
        if(framework)proto[CONSTRUCTOR] = C;
      }
      isWeak || inst[FOR_EACH](function(val, key){
        buggyZero = 1 / key === -Infinity;
      });
      // fix converting -0 key to +0
      if(buggyZero){
        fixSVZ('delete');
        fixSVZ('has');
        isMap && fixSVZ('get');
      }
      // + fix .add & .set for chaining
      if(buggyZero || chain !== inst)fixSVZ(ADDER, true);
    }
    setToStringTag(C, NAME);
    setSpecies(C);
    
    O[NAME] = C;
    $define(GLOBAL + WRAP + FORCED * !isNative(C), O);
    
    // add .keys, .values, .entries, [@@iterator]
    // 23.1.3.4, 23.1.3.8, 23.1.3.11, 23.1.3.12, 23.2.3.5, 23.2.3.8, 23.2.3.10, 23.2.3.11
    isWeak || defineStdIterators(C, NAME, function(iterated, kind){
      set(this, ITER, {o: iterated, k: kind});
    }, function(){
      var iter  = this[ITER]
        , kind  = iter.k
        , entry = iter.l;
      // revert to the last existing entry
      while(entry && entry.r)entry = entry.p;
      // get next entry
      if(!iter.o || !(iter.l = entry = entry ? entry.n : iter.o[FIRST])){
        // or finish the iteration
        iter.o = undefined;
        return iterResult(1);
      }
      // return step by kind
      if(kind == KEY)  return iterResult(0, entry.k);
      if(kind == VALUE)return iterResult(0, entry.v);
                       return iterResult(0, [entry.k, entry.v]);   
    }, isMap ? KEY+VALUE : VALUE, !isMap);
    
    return C;
  }
  
  function fastKey(it, create){
    // return primitive with prefix
    if(!isObject(it))return (typeof it == 'string' ? 'S' : 'P') + it;
    // can't set id to frozen object
    if(isFrozen(it))return 'F';
    if(!has(it, UID)){
      // not necessary to add id
      if(!create)return 'E';
      // add missing object id
      hidden(it, UID, ++uid);
    // return object id with prefix
    } return 'O' + it[UID];
  }
  function getEntry(that, key){
    // fast case
    var index = fastKey(key), entry;
    if(index != 'F')return that[O1][index];
    // frozen object case
    for(entry = that[FIRST]; entry; entry = entry.n){
      if(entry.k == key)return entry;
    }
  }
  function def(that, key, value){
    var entry = getEntry(that, key)
      , prev, index;
    // change existing entry
    if(entry)entry.v = value;
    // create new entry
    else {
      that[LAST] = entry = {
        i: index = fastKey(key, true), // <- index
        k: key,                        // <- key
        v: value,                      // <- value
        p: prev = that[LAST],          // <- previous entry
        n: undefined,                  // <- next entry
        r: false                       // <- removed
      };
      if(!that[FIRST])that[FIRST] = entry;
      if(prev)prev.n = entry;
      that[SIZE]++;
      // add to index
      if(index != 'F')that[O1][index] = entry;
    } return that;
  }

  var collectionMethods = {
    // 23.1.3.1 Map.prototype.clear()
    // 23.2.3.2 Set.prototype.clear()
    clear: function(){
      for(var that = this, data = that[O1], entry = that[FIRST]; entry; entry = entry.n){
        entry.r = true;
        if(entry.p)entry.p = entry.p.n = undefined;
        delete data[entry.i];
      }
      that[FIRST] = that[LAST] = undefined;
      that[SIZE] = 0;
    },
    // 23.1.3.3 Map.prototype.delete(key)
    // 23.2.3.4 Set.prototype.delete(value)
    'delete': function(key){
      var that  = this
        , entry = getEntry(that, key);
      if(entry){
        var next = entry.n
          , prev = entry.p;
        delete that[O1][entry.i];
        entry.r = true;
        if(prev)prev.n = next;
        if(next)next.p = prev;
        if(that[FIRST] == entry)that[FIRST] = next;
        if(that[LAST] == entry)that[LAST] = prev;
        that[SIZE]--;
      } return !!entry;
    },
    // 23.2.3.6 Set.prototype.forEach(callbackfn, thisArg = undefined)
    // 23.1.3.5 Map.prototype.forEach(callbackfn, thisArg = undefined)
    forEach: function(callbackfn /*, that = undefined */){
      var f = ctx(callbackfn, arguments[1], 3)
        , entry;
      while(entry = entry ? entry.n : this[FIRST]){
        f(entry.v, entry.k, this);
        // revert to the last existing entry
        while(entry && entry.r)entry = entry.p;
      }
    },
    // 23.1.3.7 Map.prototype.has(key)
    // 23.2.3.7 Set.prototype.has(value)
    has: function(key){
      return !!getEntry(this, key);
    }
  }
  
  // 23.1 Map Objects
  Map = getCollection(Map, MAP, {
    // 23.1.3.6 Map.prototype.get(key)
    get: function(key){
      var entry = getEntry(this, key);
      return entry && entry.v;
    },
    // 23.1.3.9 Map.prototype.set(key, value)
    set: function(key, value){
      return def(this, key === 0 ? 0 : key, value);
    }
  }, collectionMethods, true);
  
  // 23.2 Set Objects
  Set = getCollection(Set, SET, {
    // 23.2.3.1 Set.prototype.add(value)
    add: function(value){
      return def(this, value = value === 0 ? 0 : value, value);
    }
  }, collectionMethods);
  
  function defWeak(that, key, value){
    if(isFrozen(assertObject(key)))leakStore(that).set(key, value);
    else {
      has(key, WEAK) || hidden(key, WEAK, {});
      key[WEAK][that[UID]] = value;
    } return that;
  }
  function leakStore(that){
    return that[LEAK] || hidden(that, LEAK, new Map)[LEAK];
  }
  
  var weakMethods = {
    // 23.3.3.2 WeakMap.prototype.delete(key)
    // 23.4.3.3 WeakSet.prototype.delete(value)
    'delete': function(key){
      if(!isObject(key))return false;
      if(isFrozen(key))return leakStore(this)['delete'](key);
      return has(key, WEAK) && has(key[WEAK], this[UID]) && delete key[WEAK][this[UID]];
    },
    // 23.3.3.4 WeakMap.prototype.has(key)
    // 23.4.3.4 WeakSet.prototype.has(value)
    has: function(key){
      if(!isObject(key))return false;
      if(isFrozen(key))return leakStore(this).has(key);
      return has(key, WEAK) && has(key[WEAK], this[UID]);
    }
  };
  
  // 23.3 WeakMap Objects
  WeakMap = getCollection(WeakMap, WEAKMAP, {
    // 23.3.3.3 WeakMap.prototype.get(key)
    get: function(key){
      if(isObject(key)){
        if(isFrozen(key))return leakStore(this).get(key);
        if(has(key, WEAK))return key[WEAK][this[UID]];
      }
    },
    // 23.3.3.5 WeakMap.prototype.set(key, value)
    set: function(key, value){
      return defWeak(this, key, value);
    }
  }, weakMethods, true, true);
  
  // IE11 WeakMap frozen keys fix
  if(framework && new WeakMap().set(Object.freeze(tmp), 7).get(tmp) != 7){
    forEach.call(array('delete,has,get,set'), function(key){
      var method = WeakMap[PROTOTYPE][key];
      WeakMap[PROTOTYPE][key] = function(a, b){
        // store frozen objects on leaky map
        if(isObject(a) && isFrozen(a)){
          var result = leakStore(this)[key](a, b);
          return key == 'set' ? this : result;
        // store all the rest on native weakmap
        } return method.call(this, a, b);
      };
    });
  }
  
  // 23.4 WeakSet Objects
  WeakSet = getCollection(WeakSet, WEAKSET, {
    // 23.4.3.1 WeakSet.prototype.add(value)
    add: function(value){
      return defWeak(this, value, true);
    }
  }, weakMethods, false, true);
}();

/******************************************************************************
 * Module : es6.reflect                                                       *
 ******************************************************************************/

!function(){
  function Enumerate(iterated){
    var keys = [], key;
    for(key in iterated)keys.push(key);
    set(this, ITER, {o: iterated, a: keys, i: 0});
  }
  createIterator(Enumerate, OBJECT, function(){
    var iter = this[ITER]
      , keys = iter.a
      , key;
    do {
      if(iter.i >= keys.length)return iterResult(1);
    } while(!((key = keys[iter.i++]) in iter.o));
    return iterResult(0, key);
  });
  
  function wrap(fn){
    return function(it){
      assertObject(it);
      try {
        return fn.apply(undefined, arguments), true;
      } catch(e){
        return false;
      }
    }
  }
  
  function reflectGet(target, propertyKey/*, receiver*/){
    var receiver = arguments.length < 3 ? target : arguments[2]
      , desc = getOwnDescriptor(assertObject(target), propertyKey), proto;
    if(desc)return has(desc, 'value')
      ? desc.value
      : desc.get === undefined
        ? undefined
        : desc.get.call(receiver);
    return isObject(proto = getPrototypeOf(target))
      ? reflectGet(proto, propertyKey, receiver)
      : undefined;
  }
  function reflectSet(target, propertyKey, V/*, receiver*/){
    var receiver = arguments.length < 4 ? target : arguments[3]
      , ownDesc  = getOwnDescriptor(assertObject(target), propertyKey)
      , existingDescriptor, proto;
    if(!ownDesc){
      if(isObject(proto = getPrototypeOf(target))){
        return reflectSet(proto, propertyKey, V, receiver);
      }
      ownDesc = descriptor(0);
    }
    if(has(ownDesc, 'value')){
      if(ownDesc.writable === false || !isObject(receiver))return false;
      existingDescriptor = getOwnDescriptor(receiver, propertyKey) || descriptor(0);
      existingDescriptor.value = V;
      return defineProperty(receiver, propertyKey, existingDescriptor), true;
    }
    return ownDesc.set === undefined
      ? false
      : (ownDesc.set.call(receiver, V), true);
  }
  var isExtensible = Object.isExtensible || returnIt;
  
  var reflect = {
    // 26.1.1 Reflect.apply(target, thisArgument, argumentsList)
    apply: ctx(call, apply, 3),
    // 26.1.2 Reflect.construct(target, argumentsList [, newTarget])
    construct: function(target, argumentsList /*, newTarget*/){
      var proto    = assertFunction(arguments.length < 3 ? target : arguments[2])[PROTOTYPE]
        , instance = create(isObject(proto) ? proto : ObjectProto)
        , result   = apply.call(target, instance, argumentsList);
      return isObject(result) ? result : instance;
    },
    // 26.1.3 Reflect.defineProperty(target, propertyKey, attributes)
    defineProperty: wrap(defineProperty),
    // 26.1.4 Reflect.deleteProperty(target, propertyKey)
    deleteProperty: function(target, propertyKey){
      var desc = getOwnDescriptor(assertObject(target), propertyKey);
      return desc && !desc.configurable ? false : delete target[propertyKey];
    },
    // 26.1.5 Reflect.enumerate(target)
    enumerate: function(target){
      return new Enumerate(assertObject(target));
    },
    // 26.1.6 Reflect.get(target, propertyKey [, receiver])
    get: reflectGet,
    // 26.1.7 Reflect.getOwnPropertyDescriptor(target, propertyKey)
    getOwnPropertyDescriptor: function(target, propertyKey){
      return getOwnDescriptor(assertObject(target), propertyKey);
    },
    // 26.1.8 Reflect.getPrototypeOf(target)
    getPrototypeOf: function(target){
      return getPrototypeOf(assertObject(target));
    },
    // 26.1.9 Reflect.has(target, propertyKey)
    has: function(target, propertyKey){
      return propertyKey in target;
    },
    // 26.1.10 Reflect.isExtensible(target)
    isExtensible: function(target){
      return !!isExtensible(assertObject(target));
    },
    // 26.1.11 Reflect.ownKeys(target)
    ownKeys: ownKeys,
    // 26.1.12 Reflect.preventExtensions(target)
    preventExtensions: wrap(Object.preventExtensions || returnIt),
    // 26.1.13 Reflect.set(target, propertyKey, V [, receiver])
    set: reflectSet
  }
  // 26.1.14 Reflect.setPrototypeOf(target, proto)
  if(setPrototypeOf)reflect.setPrototypeOf = function(target, proto){
    return setPrototypeOf(assertObject(target), proto), true;
  };
  
  $define(GLOBAL, {Reflect: {}});
  $define(STATIC, 'Reflect', reflect);
}();

/******************************************************************************
 * Module : es7.proposals                                                     *
 ******************************************************************************/

!function(){
  $define(PROTO, ARRAY, {
    // https://github.com/domenic/Array.prototype.includes
    includes: createArrayContains(true)
  });
  $define(PROTO, STRING, {
    // https://github.com/mathiasbynens/String.prototype.at
    at: createPointAt(true)
  });
  
  function createObjectToArray(isEntries){
    return function(object){
      var O      = toObject(object)
        , keys   = getKeys(object)
        , length = keys.length
        , i      = 0
        , result = Array(length)
        , key;
      if(isEntries)while(length > i)result[i] = [key = keys[i++], O[key]];
      else while(length > i)result[i] = O[keys[i++]];
      return result;
    }
  }
  $define(STATIC, OBJECT, {
    // https://gist.github.com/WebReflection/9353781
    getOwnPropertyDescriptors: function(object){
      var O      = toObject(object)
        , result = {};
      forEach.call(ownKeys(O), function(key){
        defineProperty(result, key, descriptor(0, getOwnDescriptor(O, key)));
      });
      return result;
    },
    // https://github.com/rwaldron/tc39-notes/blob/master/es6/2014-04/apr-9.md#51-objectentries-objectvalues
    values:  createObjectToArray(false),
    entries: createObjectToArray(true)
  });
  $define(STATIC, REGEXP, {
    // https://gist.github.com/kangax/9698100
    escape: createReplacer(/([\\\-[\]{}()*+?.,^$|])/g, '\\$1', true)
  });
}();

/******************************************************************************
 * Module : es7.abstract-refs                                                 *
 ******************************************************************************/

// https://github.com/zenparsing/es-abstract-refs
!function(REFERENCE){
  REFERENCE_GET = getWellKnownSymbol(REFERENCE+'Get', true);
  var REFERENCE_SET = getWellKnownSymbol(REFERENCE+SET, true)
    , REFERENCE_DELETE = getWellKnownSymbol(REFERENCE+'Delete', true);
  
  $define(STATIC, SYMBOL, {
    referenceGet: REFERENCE_GET,
    referenceSet: REFERENCE_SET,
    referenceDelete: REFERENCE_DELETE
  });
  
  hidden(FunctionProto, REFERENCE_GET, returnThis);
  
  function setMapMethods(Constructor){
    if(Constructor){
      var MapProto = Constructor[PROTOTYPE];
      hidden(MapProto, REFERENCE_GET, MapProto.get);
      hidden(MapProto, REFERENCE_SET, MapProto.set);
      hidden(MapProto, REFERENCE_DELETE, MapProto['delete']);
    }
  }
  setMapMethods(Map);
  setMapMethods(WeakMap);
}('reference');

/******************************************************************************
 * Module : core.dict                                                         *
 ******************************************************************************/

!function(DICT){
  Dict = function(iterable){
    var dict = create(null);
    if(iterable != undefined){
      if(isIterable(iterable)){
        forOf(iterable, true, function(key, value){
          dict[key] = value;
        });
      } else assign(dict, iterable);
    }
    return dict;
  }
  Dict[PROTOTYPE] = null;
  
  function DictIterator(iterated, kind){
    set(this, ITER, {o: toObject(iterated), a: getKeys(iterated), i: 0, k: kind});
  }
  createIterator(DictIterator, DICT, function(){
    var iter = this[ITER]
      , O    = iter.o
      , keys = iter.a
      , kind = iter.k
      , key;
    do {
      if(iter.i >= keys.length){
        iter.o = undefined;
        return iterResult(1);
      }
    } while(!has(O, key = keys[iter.i++]));
    if(kind == KEY)  return iterResult(0, key);
    if(kind == VALUE)return iterResult(0, O[key]);
                     return iterResult(0, [key, O[key]]);
  });
  function createDictIter(kind){
    return function(it){
      return new DictIterator(it, kind);
    }
  }
  
  /*
   * 0 -> forEach
   * 1 -> map
   * 2 -> filter
   * 3 -> some
   * 4 -> every
   * 5 -> find
   * 6 -> findKey
   * 7 -> mapPairs
   */
  function createDictMethod(type){
    var isMap    = type == 1
      , isEvery  = type == 4;
    return function(object, callbackfn, that /* = undefined */){
      var f      = ctx(callbackfn, that, 3)
        , O      = toObject(object)
        , result = isMap || type == 7 || type == 2 ? new (generic(this, Dict)) : undefined
        , key, val, res;
      for(key in O)if(has(O, key)){
        val = O[key];
        res = f(val, key, object);
        if(type){
          if(isMap)result[key] = res;             // map
          else if(res)switch(type){
            case 2: result[key] = val; break      // filter
            case 3: return true;                  // some
            case 5: return val;                   // find
            case 6: return key;                   // findKey
            case 7: result[res[0]] = res[1];      // mapPairs
          } else if(isEvery)return false;         // every
        }
      }
      return type == 3 || isEvery ? isEvery : result;
    }
  }
  function createDictReduce(isTurn){
    return function(object, mapfn, init){
      assertFunction(mapfn);
      var O      = toObject(object)
        , keys   = getKeys(O)
        , length = keys.length
        , i      = 0
        , memo, key, result;
      if(isTurn)memo = init == undefined ? new (generic(this, Dict)) : Object(init);
      else if(arguments.length < 3){
        assert(length, REDUCE_ERROR);
        memo = O[keys[i++]];
      } else memo = Object(init);
      while(length > i)if(has(O, key = keys[i++])){
        result = mapfn(memo, O[key], key, object);
        if(isTurn){
          if(result === false)break;
        } else memo = result;
      }
      return memo;
    }
  }
  var findKey = createDictMethod(6);
  function includes(object, el){
    return (el == el ? keyOf(object, el) : findKey(object, sameNaN)) !== undefined;
  }
  
  var dictMethods = {
    keys:    createDictIter(KEY),
    values:  createDictIter(VALUE),
    entries: createDictIter(KEY+VALUE),
    forEach: createDictMethod(0),
    map:     createDictMethod(1),
    filter:  createDictMethod(2),
    some:    createDictMethod(3),
    every:   createDictMethod(4),
    find:    createDictMethod(5),
    findKey: findKey,
    mapPairs:createDictMethod(7),
    reduce:  createDictReduce(false),
    turn:    createDictReduce(true),
    keyOf:   keyOf,
    includes:includes,
    // Has / get / set own property
    has: has,
    get: get,
    set: createDefiner(0),
    isDict: function(it){
      return isObject(it) && getPrototypeOf(it) === Dict[PROTOTYPE];
    }
  };
  
  if(REFERENCE_GET)for(var key in dictMethods)!function(fn){
    function method(){
      for(var args = [this], i = 0; i < arguments.length;)args.push(arguments[i++]);
      return invoke(fn, args);
    }
    fn[REFERENCE_GET] = function(){
      return method;
    }
  }(dictMethods[key]);
  
  $define(GLOBAL + FORCED, {Dict: assignHidden(Dict, dictMethods)});
}('Dict');

/******************************************************************************
 * Module : core.$for                                                         *
 ******************************************************************************/

!function(ENTRIES, FN){  
  function $for(iterable, entries){
    if(!(this instanceof $for))return new $for(iterable, entries);
    this[ITER]    = getIterator(iterable);
    this[ENTRIES] = !!entries;
  }
  
  createIterator($for, 'Wrapper', function(){
    return this[ITER].next();
  });
  var $forProto = $for[PROTOTYPE];
  setIterator($forProto, function(){
    return this[ITER]; // unwrap
  });
  
  function createChainIterator(next){
    function Iter(I, fn, that){
      this[ITER]    = getIterator(I);
      this[ENTRIES] = I[ENTRIES];
      this[FN]      = ctx(fn, that, I[ENTRIES] ? 2 : 1);
    }
    createIterator(Iter, 'Chain', next, $forProto);
    setIterator(Iter[PROTOTYPE], returnThis); // override $forProto iterator
    return Iter;
  }
  
  var MapIter = createChainIterator(function(){
    var step = this[ITER].next();
    return step.done ? step : iterResult(0, stepCall(this[FN], step.value, this[ENTRIES]));
  });
  
  var FilterIter = createChainIterator(function(){
    for(;;){
      var step = this[ITER].next();
      if(step.done || stepCall(this[FN], step.value, this[ENTRIES]))return step;
    }
  });
  
  assignHidden($forProto, {
    of: function(fn, that){
      forOf(this, this[ENTRIES], fn, that);
    },
    array: function(fn, that){
      var result = [];
      forOf(fn != undefined ? this.map(fn, that) : this, false, push, result);
      return result;
    },
    filter: function(fn, that){
      return new FilterIter(this, fn, that);
    },
    map: function(fn, that){
      return new MapIter(this, fn, that);
    }
  });
  
  $for.isIterable  = isIterable;
  $for.getIterator = getIterator;
  
  $define(GLOBAL + FORCED, {$for: $for});
}('entries', safeSymbol('fn'));

/******************************************************************************
 * Module : core.delay                                                        *
 ******************************************************************************/

// https://esdiscuss.org/topic/promise-returning-delay-function
$define(GLOBAL + FORCED, {
  delay: function(time){
    return new Promise(function(resolve){
      setTimeout(resolve, time, true);
    });
  }
});

/******************************************************************************
 * Module : core.binding                                                      *
 ******************************************************************************/

!function(_, toLocaleString){
  // Placeholder
  core._ = path._ = path._ || {};

  $define(PROTO + FORCED, FUNCTION, {
    part: part,
    only: function(numberArguments, that /* = @ */){
      var fn     = assertFunction(this)
        , n      = toLength(numberArguments)
        , isThat = arguments.length > 1;
      return function(/* ...args */){
        var length = min(n, arguments.length)
          , args   = Array(length)
          , i      = 0;
        while(length > i)args[i] = arguments[i++];
        return invoke(fn, args, isThat ? that : this);
      }
    }
  });
  
  function tie(key){
    var that  = this
      , bound = {};
    return hidden(that, _, function(key){
      if(key === undefined || !(key in that))return toLocaleString.call(that);
      return has(bound, key) ? bound[key] : (bound[key] = ctx(that[key], that, -1));
    })[_](key);
  }
  
  hidden(path._, TO_STRING, function(){
    return _;
  });
  
  hidden(ObjectProto, _, tie);
  DESC || hidden(ArrayProto, _, tie);
  // IE8- dirty hack - redefined toLocaleString is not enumerable
}(DESC ? uid('tie') : TO_LOCALE, ObjectProto[TO_LOCALE]);

/******************************************************************************
 * Module : core.object                                                       *
 ******************************************************************************/

!function(){
  function define(target, mixin){
    var keys   = ownKeys(toObject(mixin))
      , length = keys.length
      , i = 0, key;
    while(length > i)defineProperty(target, key = keys[i++], getOwnDescriptor(mixin, key));
    return target;
  };
  $define(STATIC + FORCED, OBJECT, {
    isObject: isObject,
    classof: classof,
    define: define,
    make: function(proto, mixin){
      return define(create(proto), mixin);
    }
  });
}();

/******************************************************************************
 * Module : core.array                                                        *
 ******************************************************************************/

$define(PROTO + FORCED, ARRAY, {
  turn: function(fn, target /* = [] */){
    assertFunction(fn);
    var memo   = target == undefined ? [] : Object(target)
      , O      = ES5Object(this)
      , length = toLength(O.length)
      , index  = 0;
    while(length > index)if(fn(memo, O[index], index++, this) === false)break;
    return memo;
  }
});
if(framework)ArrayUnscopables.turn = true;

/******************************************************************************
 * Module : core.number                                                       *
 ******************************************************************************/

!function(numberMethods){  
  function NumberIterator(iterated){
    set(this, ITER, {l: toLength(iterated), i: 0});
  }
  createIterator(NumberIterator, NUMBER, function(){
    var iter = this[ITER]
      , i    = iter.i++;
    return i < iter.l ? iterResult(0, i) : iterResult(1);
  });
  defineIterator(Number, NUMBER, function(){
    return new NumberIterator(this);
  });
  
  numberMethods.random = function(lim /* = 0 */){
    var a = +this
      , b = lim == undefined ? 0 : +lim
      , m = min(a, b);
    return random() * (max(a, b) - m) + m;
  };

  forEach.call(array(
      // ES3:
      'round,floor,ceil,abs,sin,asin,cos,acos,tan,atan,exp,sqrt,max,min,pow,atan2,' +
      // ES6:
      'acosh,asinh,atanh,cbrt,clz32,cosh,expm1,hypot,imul,log1p,log10,log2,sign,sinh,tanh,trunc'
    ), function(key){
      var fn = Math[key];
      if(fn)numberMethods[key] = function(/* ...args */){
        // ie9- dont support strict mode & convert `this` to object -> convert it to number
        var args = [+this]
          , i    = 0;
        while(arguments.length > i)args.push(arguments[i++]);
        return invoke(fn, args);
      }
    }
  );
  
  $define(PROTO + FORCED, NUMBER, numberMethods);
}({});

/******************************************************************************
 * Module : core.string                                                       *
 ******************************************************************************/

!function(){
  var escapeHTMLDict = {
    '&': '&amp;',
    '<': '&lt;',
    '>': '&gt;',
    '"': '&quot;',
    "'": '&apos;'
  }, unescapeHTMLDict = {}, key;
  for(key in escapeHTMLDict)unescapeHTMLDict[escapeHTMLDict[key]] = key;
  $define(PROTO + FORCED, STRING, {
    escapeHTML:   createReplacer(/[&<>"']/g, escapeHTMLDict),
    unescapeHTML: createReplacer(/&(?:amp|lt|gt|quot|apos);/g, unescapeHTMLDict)
  });
}();

/******************************************************************************
 * Module : core.date                                                         *
 ******************************************************************************/

!function(formatRegExp, flexioRegExp, locales, current, SECONDS, MINUTES, HOURS, MONTH, YEAR){
  function createFormat(prefix){
    return function(template, locale /* = current */){
      var that = this
        , dict = locales[has(locales, locale) ? locale : current];
      function get(unit){
        return that[prefix + unit]();
      }
      return String(template).replace(formatRegExp, function(part){
        switch(part){
          case 's'  : return get(SECONDS);                  // Seconds : 0-59
          case 'ss' : return lz(get(SECONDS));              // Seconds : 00-59
          case 'm'  : return get(MINUTES);                  // Minutes : 0-59
          case 'mm' : return lz(get(MINUTES));              // Minutes : 00-59
          case 'h'  : return get(HOURS);                    // Hours   : 0-23
          case 'hh' : return lz(get(HOURS));                // Hours   : 00-23
          case 'D'  : return get(DATE);                     // Date    : 1-31
          case 'DD' : return lz(get(DATE));                 // Date    : 01-31
          case 'W'  : return dict[0][get('Day')];           // Day     : Понедельник
          case 'N'  : return get(MONTH) + 1;                // Month   : 1-12
          case 'NN' : return lz(get(MONTH) + 1);            // Month   : 01-12
          case 'M'  : return dict[2][get(MONTH)];           // Month   : Январь
          case 'MM' : return dict[1][get(MONTH)];           // Month   : Января
          case 'Y'  : return get(YEAR);                     // Year    : 2014
          case 'YY' : return lz(get(YEAR) % 100);           // Year    : 14
        } return part;
      });
    }
  }
  function addLocale(lang, locale){
    function split(index){
      var result = [];
      forEach.call(array(locale.months), function(it){
        result.push(it.replace(flexioRegExp, '$' + index));
      });
      return result;
    }
    locales[lang] = [array(locale.weekdays), split(1), split(2)];
    return core;
  }
  $define(PROTO + FORCED, DATE, {
    format:    createFormat('get'),
    formatUTC: createFormat('getUTC')
  });
  addLocale(current, {
    weekdays: 'Sunday,Monday,Tuesday,Wednesday,Thursday,Friday,Saturday',
    months: 'January,February,March,April,May,June,July,August,September,October,November,December'
  });
  addLocale('ru', {
    weekdays: 'Воскресенье,Понедельник,Вторник,Среда,Четверг,Пятница,Суббота',
    months: 'Январ:я|ь,Феврал:я|ь,Март:а|,Апрел:я|ь,Ма:я|й,Июн:я|ь,' +
            'Июл:я|ь,Август:а|,Сентябр:я|ь,Октябр:я|ь,Ноябр:я|ь,Декабр:я|ь'
  });
  core.locale = function(locale){
    return has(locales, locale) ? current = locale : current;
  };
  core.addLocale = addLocale;
}(/\b\w\w?\b/g, /:(.*)\|(.*)$/, {}, 'en', 'Seconds', 'Minutes', 'Hours', 'Month', 'FullYear');

/******************************************************************************
 * Module : core.global                                                       *
 ******************************************************************************/

$define(GLOBAL + FORCED, {global: global});

/******************************************************************************
 * Module : js.array.statics                                                  *
 ******************************************************************************/

// JavaScript 1.6 / Strawman array statics shim
!function(arrayStatics){
  function setArrayStatics(keys, length){
    forEach.call(array(keys), function(key){
      if(key in ArrayProto)arrayStatics[key] = ctx(call, ArrayProto[key], length);
    });
  }
  setArrayStatics('pop,reverse,shift,keys,values,entries', 1);
  setArrayStatics('indexOf,every,some,forEach,map,filter,find,findIndex,includes', 3);
  setArrayStatics('join,slice,concat,push,splice,unshift,sort,lastIndexOf,' +
                  'reduce,reduceRight,copyWithin,fill,turn');
  $define(STATIC, ARRAY, arrayStatics);
}({});

/******************************************************************************
 * Module : web.dom.itarable                                                  *
 ******************************************************************************/

!function(NodeList){
  if(framework && NodeList && !(SYMBOL_ITERATOR in NodeList[PROTOTYPE])){
    hidden(NodeList[PROTOTYPE], SYMBOL_ITERATOR, Iterators[ARRAY]);
  }
  Iterators.NodeList = Iterators[ARRAY];
}(global.NodeList);

/******************************************************************************
 * Module : core.log                                                          *
 ******************************************************************************/

!function(log, enabled){
  // Methods from https://github.com/DeveloperToolsWG/console-object/blob/master/api.md
  forEach.call(array('assert,clear,count,debug,dir,dirxml,error,exception,' +
      'group,groupCollapsed,groupEnd,info,isIndependentlyComposed,log,' +
      'markTimeline,profile,profileEnd,table,time,timeEnd,timeline,' +
      'timelineEnd,timeStamp,trace,warn'), function(key){
    log[key] = function(){
      if(enabled && key in console)return apply.call(console[key], console, arguments);
    };
  });
  $define(GLOBAL + FORCED, {log: assign(log.log, log, {
    enable: function(){
      enabled = true;
    },
    disable: function(){
      enabled = false;
    }
  })});
}({}, true);
}(typeof self != 'undefined' && self.Math === Math ? self : Function('return this')(), false);
module.exports = { "default": module.exports, __esModule: true };

},{}],14:[function(require,module,exports){
"use strict";

exports["default"] = function (instance, Constructor) {
  if (!(instance instanceof Constructor)) {
    throw new TypeError("Cannot call a class as a function");
  }
};

exports.__esModule = true;
},{}],15:[function(require,module,exports){
"use strict";

exports["default"] = (function () {
  function defineProperties(target, props) {
    for (var key in props) {
      var prop = props[key];
      prop.configurable = true;
      if (prop.value) prop.writable = true;
    }

    Object.defineProperties(target, props);
  }

  return function (Constructor, protoProps, staticProps) {
    if (protoProps) defineProperties(Constructor.prototype, protoProps);
    if (staticProps) defineProperties(Constructor, staticProps);
    return Constructor;
  };
})();

exports.__esModule = true;
},{}],16:[function(require,module,exports){
"use strict";

var _core = require("babel-runtime/core-js")["default"];

exports["default"] = function get(_x, _x2, _x3) {
  var _again = true;

  _function: while (_again) {
    _again = false;
    var object = _x,
        property = _x2,
        receiver = _x3;
    desc = parent = getter = undefined;

    var desc = _core.Object.getOwnPropertyDescriptor(object, property);

    if (desc === undefined) {
      var parent = _core.Object.getPrototypeOf(object);

      if (parent === null) {
        return undefined;
      } else {
        _x = parent;
        _x2 = property;
        _x3 = receiver;
        _again = true;
        continue _function;
      }
    } else if ("value" in desc && desc.writable) {
      return desc.value;
    } else {
      var getter = desc.get;

      if (getter === undefined) {
        return undefined;
      }

      return getter.call(receiver);
    }
  }
};

exports.__esModule = true;
},{"babel-runtime/core-js":13}],17:[function(require,module,exports){
"use strict";

exports["default"] = function (subClass, superClass) {
  if (typeof superClass !== "function" && superClass !== null) {
    throw new TypeError("Super expression must either be null or a function, not " + typeof superClass);
  }

  subClass.prototype = Object.create(superClass && superClass.prototype, {
    constructor: {
      value: subClass,
      enumerable: false,
      writable: true,
      configurable: true
    }
  });
  if (superClass) subClass.__proto__ = superClass;
};

exports.__esModule = true;
},{}],18:[function(require,module,exports){
"use strict";

exports["default"] = function (obj) {
  return obj && obj.__esModule ? obj["default"] : obj;
};

exports.__esModule = true;
},{}]},{},[1]);
