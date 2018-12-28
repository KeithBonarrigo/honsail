<?php
/*
 * Template Name: Portfolio Listing
 */
?>

<?php get_header(); ?>

<?php while ( have_posts() ) : the_post(); ?>

	<?php
		$cpt          = 'cpt_portfolio';
		$cpt_taxonomy = 'portfolio_category';

		$isotope        = get_post_meta( get_the_ID(), 'portfolio_listing_isotope', true );
		$masonry        = get_post_meta( get_the_ID(), 'portfolio_listing_masonry', true );
		$columns        = get_post_meta( get_the_ID(), 'portfolio_listing_columns', true );
		$posts_per_page = get_post_meta( get_the_ID(), 'portfolio_listing_posts_per_page', true );

		$div_class   = '';
		$title_class = '';
		if ( 1 == $isotope || 1 == $masonry ) {
			$div_class = 'list-isotope';
		}

		if ( 1 == $isotope ) {
			$title_class = 'with-subtitle';
		}

		$item_classes = truenorth_get_columns_classes( $columns );

		$args = array(
			'paged'     => ci_get_page_var(),
			'post_type' => $cpt,
		);

		if ( $posts_per_page >= 1 ) {
			$args['posts_per_page'] = $posts_per_page;
		} elseif ( $posts_per_page <= - 1 ) {
			$args['posts_per_page'] = - 1;
		}

		if ( 1 == $isotope ) {
			$args['posts_per_page'] = - 1;
		}

		$q = new WP_Query( $args );
	?>


	<h2 class="section-title <?php echo esc_attr( $title_class ); ?>"><?php the_title(); ?></h2>

	<?php if ( 1 == $isotope ) : ?>
		<ul class="portfolio-filters">
			<li><a href="#" class="selected" data-filter="*"><?php esc_html_e( 'All Items', 'truenorth' ); ?></a></li>
			<?php $cats = get_terms( $cpt_taxonomy, array( 'hide_empty' => 1 ) ); ?>
			<?php foreach ( $cats as $cat ) : ?>
				<li><a href="#" data-filter=".term-<?php echo esc_attr( $cat->term_id ); ?>"><?php echo esc_html( $cat->name ); ?></a></li>
			<?php endforeach; ?>
		</ul>
	<?php endif; ?>

	<div class="row <?php echo esc_attr( $div_class ); ?>">

		<?php while ( $q->have_posts() ): $q->the_post(); ?>
			<?php
				$terms_classes = '';
				if ( 1 == $isotope ) {
					$terms         = get_the_terms( get_the_ID(), $cpt_taxonomy );
					$terms         = ! empty( $terms ) ? $terms : array();
					$terms_classes = implode( ' ', array_map( 'urldecode', wp_list_pluck( $terms, 'slug' ) ) );
					foreach ( wp_list_pluck( $terms, 'term_id' ) as $term_id ) {
						$terms_classes .= ' term-' . $term_id;
					}
				}
			?>
			<div class="<?php echo esc_attr( $item_classes ); ?> <?php echo esc_attr( $terms_classes ); ?>">
				<?php
					if ( 1 == $masonry && 1 != $columns ) {
						get_template_part( 'listing-masonry', get_post_type() );
					} else {
						get_template_part( 'listing', get_post_type() );
					}
				?>
			</div>
		<?php endwhile; ?>
		<?php wp_reset_postdata(); ?>

	</div><!-- /.row -->

	<?php ci_pagination( array(), $q ); ?>

<?php endwhile; ?>

<?php get_footer(); ?>
