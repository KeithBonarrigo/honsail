<?php
	//
	// Page Post Type related functions.
	//
	add_action( 'admin_init', 'ci_add_page_meta' );
	add_action( 'save_post', 'ci_update_page_meta' );


	function ci_add_page_meta() {
		add_meta_box( 'ci-page-portfolio-listing-box', __( 'Portfolio Listing Options', 'truenorth' ), 'ci_add_page_portfolio_listing_meta_box', 'page', 'normal', 'high' );
		add_meta_box( 'ci-header-bg-box', __( 'Header background', 'truenorth' ), 'ci_add_cpt_header_bg_meta_box', 'page', 'normal', 'high' );
	}

	function ci_update_page_meta( $post_id ) {

		if ( ! ci_can_save_meta( 'page' ) ) return;

		update_post_meta( $post_id, 'header_image', esc_url_raw( $_POST['header_image'] ) );
		update_post_meta( $post_id, 'header_image_id', intval( $_POST['header_image_id'] ) );

		update_post_meta( $post_id, 'portfolio_listing_columns', intval( $_POST['portfolio_listing_columns'] ) );
		update_post_meta( $post_id, 'portfolio_listing_posts_per_page', intval( $_POST['portfolio_listing_posts_per_page'] ) );
		update_post_meta( $post_id, 'portfolio_listing_isotope', truenorth_sanitize_checkbox( $_POST['portfolio_listing_isotope'] ) );
		update_post_meta( $post_id, 'portfolio_listing_masonry', truenorth_sanitize_checkbox( $_POST['portfolio_listing_masonry'] ) );

	}

	function ci_add_page_portfolio_listing_meta_box( $object, $box ) {
		ci_prepare_metabox( 'page' );

		?><div class="ci-cf-wrap"><?php
			ci_metabox_open_tab( '' );
				$options = array();
				for ( $i = 1; $i <= 4; $i ++ ) {
					$options[ $i ] = sprintf( _n( '1 Column', '%s Columns', $i, 'truenorth' ), $i );
				}
				ci_metabox_dropdown( 'portfolio_listing_columns', $options, __( 'Number of columns to display the items in:', 'truenorth' ), array( 'default' => 2 ) );

				ci_metabox_guide( sprintf( __( 'Set the number of items per page that you want to display. Setting this to <strong>-1</strong> will show <em>all items</em>, while setting it to zero or leaving it empty, will follow the global option set from <em>Settings -> Reading</em>, currently set to <strong>%s items per page</strong>.', 'truenorth' ), get_option( 'posts_per_page' ) ) );
				ci_metabox_input( 'portfolio_listing_posts_per_page', __( 'Items per page:', 'truenorth' ) );
				ci_metabox_checkbox( 'portfolio_listing_isotope', 1, __( 'Isotope effect (ignores <em>Items per page</em> setting).', 'truenorth' ) );
				ci_metabox_checkbox( 'portfolio_listing_masonry', 1, __( 'Masonry effect (not applicable to 1 column layout).', 'truenorth' ) );
			ci_metabox_close_tab();
		?></div><?php

		ci_bind_metabox_to_page_template( 'ci-page-portfolio-listing-box', 'template-listing-cpt_portfolio.php', 'tpl_portfolio_listing' );
	}
