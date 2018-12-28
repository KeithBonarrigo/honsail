<?php
add_filter( 'ci_footer_credits', 'truenorth_footer_credits' );
if ( ! function_exists( 'truenorth_footer_credits' ) ):
function truenorth_footer_credits( $string ) {
	return get_bloginfo( 'description' );
}
endif;


add_action( 'template_redirect', 'ci_content_width' );
if ( ! function_exists( 'ci_content_width' ) ):
function ci_content_width() {
	if ( is_home() ||
	     ( is_singular( 'post' ) && ci_setting( 'blog_layout' ) == 'fullwidth' ) ||
	     is_page_template( 'template-fullwidth.php' ) ) {
		global $content_width;
		$content_width = 945;
	}
}
endif;

add_filter( 'body_class', 'truenorth_add_inner_body_class' );
if( ! function_exists( 'truenorth_add_inner_body_class' ) ):
function truenorth_add_inner_body_class( $classes ) {
	if( ! is_page_template( 'template-homepage.php' ) ) {
		$classes[] = 'inner';
	}
	return $classes;
}
endif;

add_action( 'wp_enqueue_scripts', 'truenorth_enqueue_header_css' );
if ( ! function_exists( 'truenorth_enqueue_header_css' ) ) :
function truenorth_enqueue_header_css() {
	$css = '';

	$image = ci_setting('default_header_bg');
	$color = ci_setting('default_header_color');

	$custom_image = '';
	if( is_singular() ) {
		$custom_image = get_post_meta( get_queried_object_id(), 'header_image', true );
	}

	if( ! empty( $color ) ) {
		$css .= sprintf( 'background-color: %s; ', $color );
	}

	if ( ! empty( $custom_image ) ) {
		$image = $custom_image;
	}

	if ( ! empty( $image ) ) {
		$css .= sprintf( 'background-image: url(%s); ', esc_url( $image ) );
	}

	if ( ! empty( $css ) ) {
		$css = '.hero { ' . $css . ' }' . PHP_EOL;
		wp_add_inline_style( 'ci-style', $css );
	}

}
endif;

add_filter( 'ci_setting', 'truenorth_blog_layout_setting_request', 10, 2 );
function truenorth_blog_layout_setting_request( $value, $setting ) {
	if( ! is_admin() && 'blog_layout' == $setting ) {
		if( isset( $_GET['layout'] ) && in_array( $_GET['layout'], array( 'sidebar', 'fullwidth' ) ) ) {
			$value = $_GET['layout'];
		}
	}

	return $value;
}
