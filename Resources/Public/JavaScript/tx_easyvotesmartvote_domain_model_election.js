(function($) {
	$(function() {

		$(document).on('click', '.btn-import-voting', function(e) {

			e.preventDefault();

			// Display the empty modal box with default loading icon.
			// Its content is going to be replaced by the content of the Ajax request.
			var template = '<div style="text-align: center">' +
				'<div style="margin-bottom: 20px">Please be patient, this can take up to two minutes...</div>' +
				'<img src="' + Vidi.module.publicPath + 'Resources/Public/Images/loading.gif" width="" height="" alt="" />' +
				'</div>';

			bootbox.dialog(template, [
				{
					'label': Vidi.translate('close')
				}
			], {
				onEscape: function () {
					// Empty but required function to have escape keystroke hiding the modal window.
				}
			});

			// Load content by ajax for the modal window.
			$.ajax(
				{
					type: 'get',
					url: $(this).attr('href')
				})
				.done(function (logs) {

					var message = '<pre>' + logs.join('') + '</pre>';
					$('.modal-body').html(message);

					// Reload data table
					Vidi.grid.fnDraw(false); // false = for keeping the pagination.
				})
				.fail(function (data) {
					alert('Something went wrong! Check out console log for more detail');
					console.log(data);
				});
		});
	});
})(jQuery);

