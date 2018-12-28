<?php global $ci, $ci_defaults, $load_defaults; ?>
<?php if ($load_defaults===TRUE): ?>
<?php
	add_filter('ci_panel_tabs', 'ci_add_tab_site_options', 10);
	if( !function_exists('ci_add_tab_site_options') ):
		function ci_add_tab_site_options($tabs)
		{
			$tabs[sanitize_key(basename(__FILE__, '.php'))] = __('Site Options', 'truenorth');
			return $tabs;
		}
	endif;

	// Default values for options go here.
	// $ci_defaults['option_name'] = 'default_value';
	// or
	// load_panel_snippet( 'snippet_name' );

	load_panel_snippet( 'logo' );
	load_panel_snippet( 'favicon' );
	load_panel_snippet( 'touch_favicon' );
	load_panel_snippet( 'footer_text' );
	load_panel_snippet( 'site_other' );

	$ci_defaults['footer_logo_image'] = '';
	$ci_defaults['footer_logo_title'] = get_bloginfo( 'name' );

?>
<?php else: ?>

	<?php load_panel_snippet( 'logo' ); ?>

	<?php load_panel_snippet( 'favicon' ); ?>

	<?php load_panel_snippet( 'touch_favicon' ); ?>

	<fieldset id="ci-panel-footer-logo" class="set">
		<legend><?php _e( 'Footer Logo', 'truenorth' ); ?></legend>

		<p class="guide"><?php _e( "Set your logo on the footer. If only the title is present, it will be displayed prior to the footer text (which you can set on the following section). If an image logo is used, the title will be used as the image's alternative text.", 'truenorth' ); ?></p>
		<?php ci_panel_input( 'footer_logo_title', __( 'Footer logo title:', 'truenorth' ) ); ?>
		<?php ci_panel_upload_image( 'footer_logo_image', __( 'Footer logo image:', 'truenorth' ) ); ?>
	</fieldset>

	<?php load_panel_snippet( 'footer_text' ); ?>

	<?php load_panel_snippet( 'site_other' ); ?>

<?php endif; ?>