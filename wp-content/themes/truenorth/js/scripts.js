( function( $ ) {
	'use strict';

	/* -----------------------------------------
	Responsive Menus Init with mmenu
	----------------------------------------- */
	var $mainNav   = $( '.navigation' );
	var $mobileNav = $( '#mobilemenu' );

	$mainNav.clone().removeAttr( 'id' ).removeClass().appendTo( $mobileNav );
	$mobileNav.find( 'li' ).removeAttr( 'id' );

	$mobileNav.mmenu({
		offCanvas: {
			position: 'top',
			zposition: 'front'
		},
		"autoHeight": true,
		"navbars": [
			{
				"position": "top",
				"content": [
					"prev",
					"title",
					"close"
				]
			}
		]
	});

	/* -----------------------------------------
	Main Navigation Init
	----------------------------------------- */
	$mainNav.superfish({
		delay: 300,
		animation: { opacity: 'show', height: 'show' },
		speed: 'fast',
		dropShadows: false
	});

	/* -----------------------------------------
	Responsive Videos with fitVids
	----------------------------------------- */
	$( 'body' ).fitVids();

	/* -----------------------------------------
	Image Lightbox
	----------------------------------------- */
	$( '.ci-lightbox' ).magnificPopup({
		type: 'image',
		mainClass: 'mfp-with-zoom',
		gallery: {
			enabled: true
		},
		zoom: {
			enabled: true
		}
	} );


	$( window ).on( 'load', function() {

		/* -----------------------------------------
		FlexSlider Init
		----------------------------------------- */
		var portfolioSlider = $( '.portfolio-slider' );

		if ( portfolioSlider.length ) {
			portfolioSlider.flexslider({
				animation     : 'fade',
				slideshow     : true,
				controlNav: false,
				namespace: 'ci-',
				prevText: '',
				nextText: '',
				start: function( slider ) {
					slider.removeClass( 'loading' );
				}
			});
		}

		/* -----------------------------------------
		Isotope / Masonry
		----------------------------------------- */
		var $container = $( '.list-isotope' ),
				$filters = $( '.portfolio-filters' );
		$container.isotope();

		if ( $filters.length ) {
			$filters.find( 'a' ).on( 'click', function(e) {
				var $that     = $( this ),
						$selector = $that.attr('data-filter');

				$that.parent().siblings().find( 'a' ).removeClass( 'selected' );
				$that.addClass( 'selected' );

				$container.isotope( {
					filter: $selector,
					animationOptions: {
						duration: 750,
						easing  : 'linear',
						queue   : false
					}
				} );

				e.preventDefault();
			});
		}
	});

})( jQuery );
