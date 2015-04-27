export default class Poll {

	/**
	 * Constructor
	 */
	constructor() {

		console.log(321321);

		// @todo use promise

	//	$(".communityUser-citySelection").select2({
	//		placeholder: EasyvoteLabels.enterZipOrCity,
	//		minimumInputLength: 2,
	//		ajax: {
	//			url: '/?eID=easyvote_cityselection',
	//			dataType: 'json',
	//			data: function(term, page) {
	//				return {
	//					q: term // search term
	//				};
	//			},
	//			results: function(data, page) {
	//				return {results: data.results};
	//			}
	//		},
	//		initSelection: function(element, callback) {
	//			//callback({ id: initialValue, text: initialValue });
	//		},
	//		dropdownCssClass: "bigdrop",
	//		escapeMarkup: function(m) {
	//			return m;
	//		}
	//	}).on('change', function(e) {
	//		var data = $(this).select2('data');
	//		Maps.getInstance().getMap().setCenter(new google.maps.LatLng(data.latitude, data.longitude));
	//		Maps.getInstance().getMap().setZoom(14);
	//	});
	}

	/**
	 * Load
	 */
	load(url) {

		// Return a new promise.
		return new Promise(function(resolve, reject) {

			// Do the usual XHR stuff
			var request = new XMLHttpRequest();
			request.open('GET', url);

			request.onload = function() {
				// This is called even on 404 etc
				// so check the status
				if (request.status == 200) {

					let response = JSON.parse(request.response);

					// Resolve the promise with the response text
					resolve(response);
				}
				else {
					// Otherwise reject with the status text
					// which will hopefully be a meaningful error
					reject(Error(request.statusText));
				}
			};

			// Handle network errors
			request.onerror = function() {
				reject(Error("Network Error"));
			};

			// Make the request
			request.send();
		});
	}
}
