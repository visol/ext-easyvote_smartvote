class Responsive {

	/**
	 * Constructor
	 */
	constructor () {
		this.reference = jRespond([{
			label: "mobile",
			enter: 0,
			exit: 991
		}, {
			label: "desktop",
			enter: 992,
			exit: 10000
		}]);
	}

	/**
	 * @return void
	 */
	bindAction () {

		this.reference.addFunc({
			breakpoint: "mobile",
			enter: function enter() {
				let $box = $('#wrapper-filter').parent().detach();
				$('#container-filter-responsive').append($box);
			},
			exit: function exit() {
				let $box = $('#wrapper-filter').parent().detach();
				$('#c3293').append($box);
			}
		});
	}
}

export default Responsive;