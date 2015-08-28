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
				EasyvoteSmartvote.originalWrapperFilter = $('#wrapper-filter');
				EasyvoteSmartvote.originalWrapperFilterParentContent = EasyvoteSmartvote.originalWrapperFilter.closest('.csc-default');
				let $box = EasyvoteSmartvote.originalWrapperFilter.parent().detach();
				$('#container-filter-responsive').append($box);

				EasyvoteSmartvote.chartElement = $('#chart');
				EasyvoteSmartvote.chartElementParentContent = EasyvoteSmartvote.chartElement.closest('.csc-default');
				let $chart = EasyvoteSmartvote.chartElement.parent().detach();
				$('#spider-responsive').append($chart);

			},
			exit: function exit() {
				let $box = $('#wrapper-filter').parent().detach();
				EasyvoteSmartvote.originalWrapperFilterParentContent.append($box);

				let $chart = $('#chart').parent().detach();
				EasyvoteSmartvote.chartElementParentContent.append($chart);
			}
		});
	}
}

export default Responsive;