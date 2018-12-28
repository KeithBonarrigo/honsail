<?php
add_filter( 'style_loader_src', 'sdt_remove_ver_css_js', 9999 );
// Remove WP Version From Scripts
add_filter( 'script_loader_src', 'sdt_remove_ver_css_js', 9999 );

// Function to remove version numbers
function sdt_remove_ver_css_js( $src ) {
	if ( strpos( $src, 'ver=' ) )
		$src = remove_query_arg( 'ver', $src );
	return $src;
}

add_action( 'widgets_init', 'homepage_sidebar_init' );
function homepage_sidebar_init() {
    register_sidebar( array(
        'name' => __( 'Homepage Sidebar', 'truenorth' ),
        'id' => 'homepage-sidebar',
        'description' => __( 'Widgets in this area will be shown on homepage.', 'truenorth' ),
        'before_widget' => '<li id="%1$s" class="widget %2$s">',
	'after_widget'  => '</li>',
	'before_title'  => '<h2 class="widgettitle">',
	'after_title'   => '</h2>',
    ) );
}

?>