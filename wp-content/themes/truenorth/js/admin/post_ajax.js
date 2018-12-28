jQuery( function( $ ) {
	elementor.hooks.addAction( 'panel/open_editor/widget/post_type_widget', function( panel, model, view ) {

		$('[data-setting="post_types"]').on('change', function(){

			var fieldset = $('#elementor-controls');
			var pt = $(this).val();
			$.ajax({
				type: 'post',
				url: ElementWidget.ajaxurl,
				data: {
					action: 'truenorth_get_posts',
					truenorth_post_nonce : ElementWidget.truenorth_post_nonce,
					post_type: pt,
				},
				dataType: 'text',
				beforeSend: function() {
					fieldset.addClass('loading');
					fieldset.find('[data-setting="selected_post"]').prop('disabled', 'disabled').css('opacity','0.5');
				},
				success: function(response){
					if(response !== '' && pt != 0 ) {
						fieldset.find('[data-setting="selected_post"]').html(response);
						fieldset.find('[data-setting="selected_post"]').removeAttr('disabled').css('opacity','1');
					} else {
						fieldset.find('[data-setting="selected_post"]').html('').prop('disabled', 'disabled').css('opacity','0.5');
					}

					fieldset.removeClass('loading');

				}
			});//ajax

		});

	} );

	elementor.hooks.addAction( 'panel/open_editor/widget/post_type_widget', function( panel, model, view ) {

		var fieldset = $('#elementor-controls');

		var pt = fieldset.find('[data-setting="post_types"]').val();
		if ( pt !== null ) {
			$.ajax( {
				type: 'post',
				url: ElementWidget.ajaxurl,
				data: {
					action: 'truenorth_get_posts',
					truenorth_post_nonce: ElementWidget.truenorth_post_nonce,
					post_type: pt,
				},
				dataType: 'text',
				beforeSend: function () {
					fieldset.addClass( 'loading' );
					fieldset.find( '[data-setting="selected_post"]' ).prop( 'disabled', 'disabled' ).css( 'opacity', '0.5' );
				},
				success: function ( response ) {
					if ( response !== '' && pt != 0 ) {
						fieldset.find( '[data-setting="selected_post"]' ).html( response );
						fieldset.find( '[data-setting="selected_post"]' ).removeAttr( 'disabled' ).css( 'opacity', '1' );
					} else {
						fieldset.find( '[data-setting="selected_post"]' ).html( '' ).prop( 'disabled', 'disabled' ).css( 'opacity', '0.5' );
					}

					fieldset.removeClass( 'loading' );

				}
			} );//ajax
		}
		
	} );

});