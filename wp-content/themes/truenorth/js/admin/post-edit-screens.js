jQuery(document).ready(function($) {
	"use strict";

	$('body').on('change', '.ci-cf-wrap .uploaded-id', function(){
		var preview = $(this).siblings('.selected_image');
		$.ajax({
			type: "post",
			url: ajaxurl,
			data: {
				action: 'truenorth_widget_get_selected_image_preview',
				image_id: $(this).val(),
				image_size: 'thumbnail'
			},
			dataType: 'text',
			success: function(response){
				if(response != '') {
					preview.html(response);
				}
				else {
					preview.html('');
				}
			}
		});//ajax
	});

	$('body').on('click', '.ci-cf-wrap .selected_image .close', function() {
		$( this ).parent().siblings( '.uploaded' ).val( '' );
		$( this ).parent().siblings( '.uploaded-id' ).val( '' );
		$( this ).parent().html( '' );
		return false;
	});

});
