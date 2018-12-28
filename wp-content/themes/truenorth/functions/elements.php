<?php
	namespace Elementor;

	if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

	add_action( 'elementor/init','Elementor\truenorth_elements_init' );
	function truenorth_elements_init() {
		Plugin::instance()->elements_manager->add_category(
			'truenorth-elements',
			[
				'title'  => __( 'True North Elements', 'truenorth' ),
				'icon' => 'font',
			],
			1
		);
	}

	add_action( 'elementor/widgets/widgets_registered', 'Elementor\add_truenorth_elements' );
	function add_truenorth_elements() {
		class Widget_Post_Type extends Widget_Base {

			public function get_name() {
				return 'post_type_widget';
			}

			public function get_title() {
				return __( 'True North Post Type', 'truenorth' );
			}

			public function get_icon() {
				return 'fa fa-window-maximize';
			}

			public function get_categories() {
				return [ 'truenorth-elements' ];
			}

			protected function _register_controls() {
				$this->start_controls_section(
					'section_title',
					[
						'label' => __( 'True North Post Type', 'truenorth' ),
					]
				);

				$this->add_control(
					'html_msg',
					[
						'type'    => Controls_Manager::RAW_HTML,
						'raw' => __( 'Display any post type item from True North by first selecting the post type, e.g. "Rooms" and then the item itself.', 'truenorth' ),
						'content_classes' => 'ci-description',
					]
				);

				$this->add_control(
					'post_types',
					[
						'label'       => __( 'Post Type', 'truenorth' ),
						'type' => Controls_Manager::SELECT,
						'default' => '',
						'options' => truenorth_post_types(),
					]
				);

				$this->add_control(
					'selected_post',
					[
						'label'       => __( 'Post', 'truenorth' ),
						'type' => Controls_Manager::SELECT,
						'default' => '',
						'options' => '',
					]
				);

				$this->add_control(
					'view',
					[
						'label' => __( 'View', 'truenorth' ),
						'type' => Controls_Manager::HIDDEN,
						'default' => 'traditional',
					]
				);

				$this->end_controls_section();

			}

			protected function render() {
				$settings = $this->get_settings();

				if ( empty( $settings['selected_post'] ) )
					return;

				$post_id = $settings['selected_post'];

				$q = new \WP_Query( array(
					'post_type' => get_post_type( $post_id ),
					'p'         => $post_id,
				) );

				while ( $q->have_posts() ) : $q->the_post(); ?>
					<?php get_template_part( 'listing', get_post_type() ); ?>
				<?php endwhile;

				wp_reset_postdata();

			}

		}
		Plugin::instance()->widgets_manager->register_widget_type( new Widget_Post_Type() );
	}

	add_action( 'elementor/editor/before_enqueue_scripts', 'Elementor\truenorth_ajax_posts' );
	function truenorth_ajax_posts() {

		if ( ! defined( 'ELEMENTOR_VERSION' ) ) {
			return;
		}

		wp_enqueue_script( 'ajax-script', get_template_directory_uri() . '/js/admin/post_ajax.js' );

		$params['no_posts_found'] = __( 'No posts found.', 'truenorth' );
		$params['ajaxurl']        = admin_url( 'admin-ajax.php' );
		$params['truenorth_post_nonce']  = wp_create_nonce( 'truenorth_post_nonce' );

		wp_localize_script( 'ajax-script', 'ElementWidget', $params );
	}

