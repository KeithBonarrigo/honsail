<?php if ( ci_setting( 'related_portfolios_enable' ) == 'on' ): ?>
	<?php $related = ci_get_related_posts( get_the_ID(), 3 ); ?>
	<?php if ( $related->have_posts() ): ?>

		<section class="related-items">

			<h2 class="section-title"><?php ci_e_setting( 'related_portfolios_text' ); ?></h2>

			<div class="row">

				<?php while ( $related->have_posts() ): $related->the_post(); ?>
					<div class="col-md-4">
						<?php get_template_part( 'listing', get_post_type() ); ?>
					</div><!-- /.col-md-4 -->
				<?php endwhile; ?>
				<?php wp_reset_postdata(); ?>

			</div><!-- /.row -->

		</section><!-- /.related-items -->

	<?php endif; ?>
<?php endif; ?>
