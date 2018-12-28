<?php
//
// Uncomment one of the following two. Their functions are in panel/generic.php
//
//add_action('wp_enqueue_scripts', 'ci_enqueue_modernizr');
//add_action('wp_enqueue_scripts', 'ci_print_html5shim');

// This function lives in panel/generic.php
//add_action('wp_footer', 'ci_print_selectivizr', 100);


add_action('init', 'ci_register_theme_scripts');
if ( !function_exists('ci_register_theme_scripts') ) :
function ci_register_theme_scripts() {
	//
	// Register all scripts here, both front-end and admin. 
	// There is no need to register them conditionally, as the enqueueing can be conditional.
	//

	wp_register_script( 'ci-repeating-fields', get_child_or_parent_file_uri( '/js/admin/repeating-fields.js' ), array( 'jquery' ), TRUENORTH_VERSION, true );
	wp_register_script( 'ci-post-edit-screens', get_child_or_parent_file_uri( '/js/admin/post-edit-screens.js' ), array(
		'jquery',
		'ci-repeating-fields',
	), TRUENORTH_VERSION, true );

	wp_register_script( 'ci-admin-widgets', get_child_or_parent_file_uri( '/js/admin/admin-widgets.js' ), array(
		'jquery',
		'ci-repeating-fields',
	), TRUENORTH_VERSION, true );

	$params                   = array();
	$params['no_posts_found'] = __( 'No posts found.', 'truenorth' );
	$params['ajaxurl']        = admin_url( 'admin-ajax.php' );
	wp_localize_script( 'ci-admin-widgets', 'ThemeWidget', $params );

	wp_register_script( 'superfish', get_template_directory_uri() . '/js/superfish.js', array( 'jquery' ), '1.7.5', true );
	wp_register_script( 'mmenu', get_template_directory_uri() . '/js/jquery.mmenu.min.all.js', array( 'jquery' ), '5.2.0', true );
	wp_register_script( 'flexslider', get_template_directory_uri() . '/js/jquery.flexslider.js', array( 'jquery' ), '2.5.0', true );
	wp_register_script( 'magnific', get_template_directory_uri() . '/js/jquery.magnific-popup.js', array( 'jquery' ), '1.0.0', true );
	wp_register_script( 'jquery-isotope', get_template_directory_uri() . '/js/jquery.isotope.min.js', array( 'jquery' ), '2.2.0', true );

	wp_register_script( 'ci-front-scripts', get_template_directory_uri() . '/js/scripts.js', array(
		'jquery',
		'superfish',
		'mmenu',
		'flexslider',
		'jquery-fitVids',
		'magnific',
		'jquery-isotope',
	), TRUENORTH_VERSION, true );

}
endif;



add_action('wp_enqueue_scripts', 'ci_enqueue_theme_scripts');
if( !function_exists('ci_enqueue_theme_scripts') ):
function ci_enqueue_theme_scripts() {
	//
	// Enqueue all (or most) front-end scripts here.
	// They can be also enqueued from within template files.
	//	
	if ( is_singular() && get_option( 'thread_comments' ) )
		wp_enqueue_script( 'comment-reply' );

	wp_enqueue_script( 'ci-front-scripts' );

}
endif;


if( !function_exists('ci_enqueue_admin_theme_scripts') ):
add_action('admin_enqueue_scripts','ci_enqueue_admin_theme_scripts');
function ci_enqueue_admin_theme_scripts() 
{
	global $pagenow;

	//
	// Enqueue here scripts that are to be loaded on all admin pages.
	//

	if(is_admin() and $pagenow=='themes.php' and isset($_GET['page']) and $_GET['page']=='ci_panel.php')
	{
		//
		// Enqueue here scripts that are to be loaded only on CSSIgniter Settings panel.
		//

	}

	if ( in_array( $pagenow, array( 'widgets.php', 'customize.php' ) ) ) {
		wp_enqueue_script( 'ci-admin-widgets' );
	}
}
endif;
