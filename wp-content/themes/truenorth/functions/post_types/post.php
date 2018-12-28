<?php
	//
	// Page Post Type related functions.
	//
	add_action( 'admin_init', 'ci_add_post_meta' );
	add_action( 'save_post', 'ci_update_post_meta' );


	function ci_add_post_meta() {
		add_meta_box( 'ci-header-bg-box', __( 'Header background', 'truenorth' ), 'ci_add_cpt_header_bg_meta_box', 'post', 'normal', 'high' );
	}

	function ci_update_post_meta( $post_id ) {

		if ( ! ci_can_save_meta( 'post' ) ) return;

		update_post_meta( $post_id, 'header_image', esc_url_raw( $_POST['header_image'] ) );
		update_post_meta( $post_id, 'header_image_id', intval( $_POST['header_image_id'] ) );
	}
