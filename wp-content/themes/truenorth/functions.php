<?php
	get_template_part('panel/constants');

	load_theme_textdomain( 'truenorth', get_template_directory() . '/lang' );

	// This is the main options array. Can be accessed as a global in order to reduce function calls.
	$ci = get_option(THEME_OPTIONS);
	$ci_defaults = array();

	// The $content_width needs to be before the inclusion of the rest of the files, as it is used inside of some of them.
	if ( ! isset( $content_width ) ) $content_width = 705;

	//
	// Common theme features.
	//
	require_once get_theme_file_path( '/common/common.php' );

	//
	// Let's bootstrap the theme.
	//
	get_template_part('panel/bootstrap');

	//
	// Let WordPress manage the title.
	//
	add_theme_support( 'title-tag' );

	//
	// Use HTML5 on galleries
	//
	add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption' ) );

	//
	// Define our various image sizes.
	// Notice: Changing the values below requires running a thumbnail regeneration
	// plugin such as "Regenerate Thumbnails" (http://wordpress.org/plugins/regenerate-thumbnails/)
	// in order for the new dimensions to take effect.
	//
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 945, 680, true );
	add_image_size( 'ci_header', 2000, 500, true );
	add_image_size( 'ci_full_height', 945 );


	// Enable the automatic video thumbnails.
	add_filter( 'ci_automatic_video_thumbnail_field', 'truenorth_add_auto_thumb_video_field' );
	if ( !function_exists( 'truenorth_add_auto_thumb_video_field' ) ):
	function truenorth_add_auto_thumb_video_field( $field ) {
		return 'portfolio_video_url';
	}
	endif;


	function truenorth_get_columns_classes( $columns ) {
		switch ( $columns ) {
			case 1:
				$classes = 'col-md-12';
				break;
			case 4:
				$classes = 'col-md-3';
				break;
			case 3:
				$classes = 'col-md-4';
				break;
			case 2:
			default:
				$classes = 'col-md-6';
				break;
		}

		return $classes;
	}


	function ci_add_cpt_header_bg_meta_box( $post ) {
		ci_prepare_metabox( get_post_type( $post ) );

		$image_sizes = ci_get_image_sizes();
		$size = $image_sizes['ci_header']['width'] . 'x' . $image_sizes['ci_header']['height'];

		?><div class="ci-cf-wrap"><?php
			ci_metabox_open_tab( '' );
				ci_metabox_guide( array(
					__( 'You can replace the default header image if you want, by uploading and / or selecting an already uploaded image. This applies to the current page only.', 'truenorth' ),
					sprintf( __( 'For best results, use a high resolution image, at least %s pixels in size. Make sure you select the desired image size before pressing <em>Use this file</em>.', 'truenorth' ), $size ),
				), array( 'type' => 'ul' ) );

				?>
				<p>
					<?php
						ci_metabox_input( 'header_image', '', array(
							'input_type'  => 'hidden',
							'esc_func'    => 'esc_url',
							'input_class' => 'uploaded',
							'before'      => '',
							'after'       => ''
						) );

						ci_metabox_input( 'header_image_id', '', array(
							'input_type'  => 'hidden',
							'input_class' => 'uploaded-id',
							'before'      => '',
							'after'       => ''
						) );
					?>
					<span class="selected_image" style="display: block;">
						<?php
							$image_url = ci_get_image_src( get_post_meta( $post->ID, 'header_image_id', true ), 'thumbnail' );
							if( !empty( $image_url ) ) {
								echo sprintf( '<img src="%s" /><a href="#" class="close media-modal-icon"></a>', $image_url );
							}
						?>
					</span>
					<a href="#" class="button ci-upload"><?php _e( 'Upload / Select Image', 'truenorth' ); ?></a>
				</p>
				<?php

			ci_metabox_close_tab();
		?></div><?php
	}


	function truenorth_sanitize_checkbox( &$input ) {
		if ( $input == 1 ) {
			return 1;
		}

		return '';
	}


	add_action( 'wp_ajax_truenorth_widget_get_selected_image_preview', 'truenorth_widget_get_selected_image_preview' );
	function truenorth_widget_get_selected_image_preview() {
		$image_id   = intval( $_POST['image_id'] );
		$image_size = 'thumbnail';

		if ( ! empty( $image_id ) ) {
			$image_url = ci_get_image_src( $image_id, $image_size );
			if ( ! empty( $image_url ) ) {
				echo sprintf( '<img src="%s" /><a href="#" class="close media-modal-icon"></a>', $image_url );
			}
		}
		die;
	}

	/**
	 * Theme Elements
	 */
	if ( defined( 'ELEMENTOR_VERSION' ) && version_compare( PHP_VERSION, '5.4', '>=' ) ) {
		require_once( 'functions/elements.php' );
	}

	function truenorth_post_types() {
		$post_types_available = get_post_types( array( 'public' => true ), 'objects' );
		unset( $post_types_available['attachment'] );
		if ( post_type_exists( 'elementor_library' ) ) {
			unset( $post_types_available['elementor_library'] );
		}

		$truenorth_pt[] = '';

		foreach ( $post_types_available as $key => $pt ) {
			$truenorth_pt[ $key ] = $pt->label;
		}

		return $truenorth_pt;
	}

	add_action( 'wp_ajax_truenorth_get_posts', 'ajax_truenorth_posts' );
	function ajax_truenorth_posts() {

		// Verify nonce
		if ( ! isset( $_POST['truenorth_post_nonce'] ) || ! wp_verify_nonce( $_POST['truenorth_post_nonce'], 'truenorth_post_nonce' ) ) {
			die( 'Permission denied' );
		}

		$post_type = $_POST['post_type'];

		$q = new WP_Query( array(
			'post_type' => $post_type,
			'posts_per_page' => -1,
		) );
		?>

		<option><?php esc_html_e( 'Select an item', 'truenorth' ); ?></option>

		<?php while ( $q->have_posts() ) : $q->the_post(); ?>
			<option value="<?php echo esc_attr( get_the_ID() ); ?>"><?php the_title(); ?></option>
			<?php
		endwhile;
		wp_reset_postdata();
		wp_die();
	}


	if ( ! defined( 'TRUENORTH_WHITELABEL' ) || false === (bool) TRUENORTH_WHITELABEL ) {
		add_filter( 'pt-ocdi/import_files', 'truenorth_ocdi_import_files' );
		add_action( 'pt-ocdi/after_import', 'truenorth_ocdi_after_import_setup' );
	}

	function truenorth_ocdi_import_files( $files ) {
		if ( ! defined( 'TRUENORTH_NAME' ) ) {
			define( 'TRUENORTH_NAME', 'truenorth' );
		}

		$demo_dir_url = untrailingslashit( apply_filters( 'truenorth_ocdi_demo_dir_url', 'https://www.cssigniter.com/sample_content/' . TRUENORTH_NAME ) );

		// When having more that one predefined imports, set a preview image, preview URL, and categories for isotope-style filtering.
		$new_files = array(
			array(
				'import_file_name'           => esc_html__( 'Demo Import', 'truenorth' ),
				'import_file_url'            => $demo_dir_url . '/content.xml',
				'import_widget_file_url'     => $demo_dir_url . '/widgets.wie',
				'import_customizer_file_url' => $demo_dir_url . '/customizer.dat',
			),
		);

		return array_merge( $files, $new_files );
	}

	function truenorth_ocdi_after_import_setup() {
		// Set up nav menus.
		$main_menu      = get_term_by( 'name', 'Main Menu', 'nav_menu' );
		$secondary_menu = get_term_by( 'name', 'Footer Menu', 'nav_menu' );

		set_theme_mod( 'nav_menu_locations', array(
			'main_menu'   => $main_menu->term_id,
			'footer_menu' => $secondary_menu->term_id,
		) );

		// Set up home and blog pages.
		$front_page_id = get_page_by_title( 'Home' );
		$blog_page_id  = get_page_by_title( 'Blog' );

		update_option( 'show_on_front', 'page' );
		update_option( 'page_on_front', $front_page_id->ID );
		update_option( 'page_for_posts', $blog_page_id->ID );
	}

