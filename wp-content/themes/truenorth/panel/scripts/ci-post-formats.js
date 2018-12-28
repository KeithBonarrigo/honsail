(function($) {

	var post_format_dropdown = '.editor-post-format select';

	$(window).load( function() {

		// Colorize post formats
		$('#post-formats-select').prepend('<br>');
		$('#post-formats-select br').each( function(){
			var pft_id = $(this).next().attr('id');
			$(this).nextUntil("br").wrapAll('<fieldset class="ci-post-format"><p></p></fieldset>').end().children('input').attr('id','test');
			$(this).next().attr('id', 'ci-' + pft_id);
		});
		$('#post-formats-select br').remove();

		// First run.
		var post_format_selected = $('#post-formats-select input.post-format:checked').val();

		if ( $('body').hasClass('gutenberg-editor-page') ) {
			var post_format_selected = $( post_format_dropdown ).find(':selected').val();
		}

		$('div[id^="ci_format_box_"]:visible').hide();
		$('div#ci_format_box_'+post_format_selected).show();

		// Show only the custom fields we need in the post screen.
		$('#post-formats-select input.post-format').click(function(){
			var format = $(this).attr('value');
			$('div[id^="ci_format_box_"]:visible').hide();
			$('div#ci_format_box_'+format).show();
		});

		$( post_format_dropdown ).on( "change", function() {
			var format = $(this).find(':selected').val();
			$('div[id^="ci_format_box_"]:visible').hide();
			$('div#ci_format_box_'+format).show();
		});

	});
})(jQuery);
