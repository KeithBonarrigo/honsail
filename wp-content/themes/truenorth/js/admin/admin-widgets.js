jQuery(document).ready(function($) {
	"use strict";
	var $body = $( 'body' );

	ci_sortable_init();

	// Widget Actions on Save
	$(document).ajaxSuccess(function(e, xhr, options){
		if( options.data.search( 'action=save-widget' ) != -1 ) {
			var widget_id;

			if( ( widget_id = options.data.match( /widget-id=(ci-.*?-\d+)\b/ ) ) !== null ) {
				var widget = $("input[name='widget-id'][value='" + widget_id[1] + "']").parent();
				ci_sortable_init( widget );
			}

		}

	});

	// CI Items widget
	$body.on('change', '.ci-repeating-fields .posttype_dropdown', function(){

		var fieldset = $(this).parent().parent();

		$.ajax({
			type: "post",
			url: ThemeWidget.ajaxurl,
			data: {
				action: fieldset.data( 'ajaxaction' ),
				post_type_name: $(this).val(),
				name_field: fieldset.find('.posts_dropdown').attr('name')
			},
			dataType: 'text',
			beforeSend: function() {
				fieldset.addClass('loading');
				fieldset.find('.posts_dropdown').prop('disabled', 'disabled').css('opacity','0.5');
			},
			success: function(response){
				if(response != '') {
					fieldset.find('select.posts_dropdown').html(response).children('option:eq(1)').prop('selected', 'selected');
					fieldset.find('.posts_dropdown').removeAttr('disabled').css('opacity','1');
				}
				else {
					fieldset.find('select.posts_dropdown').html('').prop('disabled', 'disabled').css('opacity','0.5');
				}

				fieldset.removeClass('loading');

			}
		});//ajax

	});

});
