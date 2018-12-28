<?php global $ci, $ci_defaults, $load_defaults, $content_width; ?>
<?php if ($load_defaults===TRUE): ?>
<?php
	add_filter('ci_panel_tabs', 'ci_add_tab_display_options', 30);
	if( !function_exists('ci_add_tab_display_options') ):
		function ci_add_tab_display_options($tabs) 
		{ 
			$tabs[sanitize_key(basename(__FILE__, '.php'))] = __('Display Options', 'truenorth'); 
			return $tabs; 
		}
	endif;
	
	// Default values for options go here.
	// $ci_defaults['option_name'] = 'default_value';
	// or
	// load_panel_snippet( 'snippet_name' );
	load_panel_snippet('pagination');
	load_panel_snippet('excerpt');
	load_panel_snippet('comments');

	add_filter( 'ci-read-more-link', 'truenorth_readmore', 10, 3 );
	if( ! function_exists( 'truenorth_readmore' ) ):
	function truenorth_readmore( $html, $text, $link ) {
		return sprintf( '<p class="read-more"><a href="%s">%s</a></p>',
			esc_url( $link ),
			$text
		);
	}
	endif;

?>
<?php else: ?>

	<?php load_panel_snippet( 'pagination' ); ?>

	<?php load_panel_snippet( 'excerpt' ); ?>

	<?php load_panel_snippet( 'comments' ); ?>

<?php endif; ?>