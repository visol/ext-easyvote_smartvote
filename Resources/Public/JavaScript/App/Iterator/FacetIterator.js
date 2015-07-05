/*jshint esnext:true */

/*
 * This file is part of the TYPO3 CMS project.
 *
 * See LICENSE.txt that was shipped with this package.
 */

export default class FacetIterator {

	static getIterator() {

		var facets = [];
		let $elements = $('#container-candidate-filter').find('.form-control');
		$elements.each((index, element)  => {
			let facet = {};
			facet.name = $(element).attr('name');
			facet.value = $(element).val();
			facets.push(facet);
		});

		return facets[Symbol.iterator]();
	}
}