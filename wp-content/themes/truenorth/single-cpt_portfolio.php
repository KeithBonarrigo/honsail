<?php get_header(); ?>

<?php while( have_posts() ): the_post(); ?>

	<article id="entry-<?php the_ID(); ?>" <?php post_class( 'entry' ); ?>>
		<?php
			$gal       = ci_featgal_get_attachments( get_the_ID() );
			$details   = get_post_meta( get_the_ID(), 'portfolio_details', true );
			$template  = get_post_meta( get_the_ID(), 'portfolio_template', true );
			$video_url = get_post_meta( get_the_ID(), 'portfolio_video_url', true );
		?>

		<?php if( ! empty( $video_url ) ): ?>
			<figure class="entry-featured">
				<?php echo wp_oembed_get( esc_url_raw( $video_url ) ); ?>
			</figure>
		<?php elseif( $gal->have_posts() && 'slideshow' == $template ): ?>
			<figure class="entry-featured">
				<div class="ci-slider portfolio-slider loading">
					<ul class="slides">
						<?php while( $gal->have_posts() ): $gal->the_post(); ?>
							<?php $img_info = wp_prepare_attachment_for_js( get_the_ID() ); ?>
							<li>
								<a class="ci-lightbox" href="<?php echo esc_url( ci_get_image_src( get_the_ID(), 'large' ) ); ?>" title="<?php echo esc_attr( $img_info['caption'] ); ?>">
									<img src="<?php echo esc_url( ci_get_image_src( get_the_ID(), 'post-thumbnail' ) ); ?>" alt="<?php echo esc_attr( $img_info['alt'] ); ?>" />
								</a>
							</li>
						<?php endwhile; ?>
						<?php wp_reset_postdata(); ?>
					</ul>
				</div>
			</figure>
		<?php elseif( has_post_thumbnail() ): ?>
			<figure class="entry-featured">
				<a href="<?php echo ci_get_featured_image_src( 'large' ); ?>" class="ci-lightbox">
					<?php the_post_thumbnail(); ?>
				</a>
			</figure>
		<?php endif; ?>

		<div class="row">

			<div class="col-md-3">
				<dl class="entry-meta group">
					<dt><?php _e('Date:', 'truenorth'); ?></dt>
					<dd><time class="entry-time" datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>"><?php echo esc_html( get_the_date() ); ?></time></dd>

					<?php foreach( $details as $detail ): ?>
						<dt><?php echo esc_html( $detail['title'] ); ?>:</dt>
						<dd><?php echo make_clickable( $detail['description'] ); ?></dd>
					<?php endforeach; ?>

					<?php if( get_the_term_list( get_the_ID(), 'portfolio_category' ) != '' ): ?>
						<dt><?php _e( 'Categories:', 'truenorth' ); ?></dt>
						<dd><?php the_terms( get_the_ID(), 'portfolio_category' ); ?></dd>
					<?php endif; ?>
				</dl><!-- /.entry-meta -->
			</div><!-- /.col-md-3 -->

			<div class="col-md-9">
				<h1 class="entry-title"><?php the_title(); ?></h1>

				<?php if( $gal->have_posts() && 'list' == $template ): ?>
					<figure class="entry-thumb entry-portfolio-images">
						<?php while( $gal->have_posts() ): $gal->the_post(); ?>
							<?php $img_info = wp_prepare_attachment_for_js( get_the_ID() ); ?>
							<a class="ci-lightbox" href="<?php echo esc_url( ci_get_image_src( get_the_ID(), 'large' ) ); ?>" title="<?php echo esc_attr( $img_info['caption'] ); ?>">
								<img src="<?php echo esc_url( ci_get_image_src( get_the_ID(), 'post-thumbnail' ) ); ?>" alt="<?php echo esc_attr( $img_info['alt'] ); ?>" />
							</a>
						<?php endwhile; ?>
						<?php wp_reset_postdata(); ?>
					</figure>
				<?php elseif( ! empty( $video_url ) && $gal->have_posts() && 'slideshow' == $template ): ?>
					<figure class="entry-featured">
						<div class="ci-slider portfolio-slider loading">
							<ul class="slides">
								<?php while( $gal->have_posts() ): $gal->the_post(); ?>
									<?php $img_info = wp_prepare_attachment_for_js( get_the_ID() ); ?>
									<li>
										<a class="ci-lightbox" href="<?php echo esc_url( ci_get_image_src( get_the_ID(), 'large' ) ); ?>" title="<?php echo esc_attr( $img_info['caption'] ); ?>">
											<img src="<?php echo esc_url( ci_get_image_src( get_the_ID(), 'post-thumbnail' ) ); ?>" alt="<?php echo esc_attr( $img_info['alt'] ); ?>" />
										</a>
									</li>
								<?php endwhile; ?>
								<?php wp_reset_postdata(); ?>
							</ul>
						</div>
					</figure>
				<?php endif; ?>

				<div class="entry-content group">
					<?php the_content(); ?>
					<?php wp_link_pages(); ?>
				</div><!-- /.entry-content -->
			</div><!-- /.col-md-9 -->

		</div><!-- /.row -->

	</article><!-- /.entry -->

	<?php get_template_part( 'inc_related', get_post_type() ); ?>

<?php endwhile; ?>

<?php get_footer(); ?>
