<?php global $ci, $ci_defaults, $load_defaults, $content_width; ?>
<?php if ($load_defaults===TRUE): ?>
<?php
	add_filter('ci_panel_tabs', 'ci_add_tab_titles_options', 70);
	if( !function_exists('ci_add_tab_titles_options') ):
		function ci_add_tab_titles_options($tabs)
		{
			$tabs[sanitize_key(basename(__FILE__, '.php'))] = __('Section titles', 'truenorth');
			return $tabs;
		}
	endif;

	// Default values for options go here.
	// $ci_defaults['option_name'] = 'default_value';
	// or
	// load_panel_snippet( 'snippet_name' );
	$ci_defaults['title_blog']   = _x( 'From the blog', 'section title', 'truenorth' );
	$ci_defaults['title_search'] = _x( 'Search Results', 'section title', 'truenorth' );
	$ci_defaults['title_404']    = _x( 'Not Found!', 'section title', 'truenorth' );

	$ci_defaults['related_portfolios_enable'] = 'on';
	$ci_defaults['related_portfolios_text']   = __( 'Related Projects', 'truenorth' );

?>
<?php else: ?>

	<fieldset class="set">
		<legend><?php _e( 'Section titles', 'truenorth' ); ?></legend>

		<p class="guide"><?php _e( 'Set the title for various sections of your website. These titles appear on automatically generated pages.', 'truenorth' ); ?></p>
		<?php
			ci_panel_input( 'title_blog', __( 'Blog section title:', 'truenorth' ) );
			ci_panel_input( 'title_search', __( 'Search page section title:', 'truenorth' ) );
			ci_panel_input( 'title_404', __( 'Not Found (404) page section title:', 'truenorth' ) );
		?>
	</fieldset>

	<fieldset class="set">
		<legend><?php _e( 'Related Projects', 'truenorth' ); ?></legend>
		<p class="guide"><?php _e( 'You can show / hide the related projects section that appear beneath portfolio items.', 'truenorth' ); ?></p>
		<fieldset class="mb10">
			<?php
				ci_panel_checkbox( 'related_portfolios_enable', 'on', __( 'Show related projects.', 'truenorth' ) );
				ci_panel_input( 'related_portfolios_text', __( 'Related projects title:', 'truenorth' ) );
			?>
		</fieldset>
	</fieldset>

<?php endif; ?>