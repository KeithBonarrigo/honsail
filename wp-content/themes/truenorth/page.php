<?php get_header(); ?>

<div class="row">
	<div class="col-md-8">

		<?php while( have_posts() ): the_post(); ?>
			<article id="entry-<?php the_ID(); ?>" <?php post_class( 'entry' ); ?>>

				<?php if( has_post_thumbnail() ): ?>
					<figure class="entry-featured">
						<a href="<?php echo ci_get_featured_image_src( 'large' ); ?>" class="ci-lightbox">
							<?php the_post_thumbnail(); ?>
						</a>
					</figure>
				<?php endif; ?>

				<h1 class="entry-title"><?php the_title(); ?></h1>

				<div class="entry-content group">
					<?php the_content(); ?>
					<?php wp_link_pages(); ?>
				</div><!-- /.entry-content -->

				<?php comments_template(); ?>

			</article><!-- /.entry -->
		<?php endwhile; ?>

	</div><!-- /.col-md-8 -->

	<div class="col-md-4">
		<?php get_sidebar(); ?>
	</div><!-- /.col-md-4 -->

</div><!-- /.row -->

<?php get_footer(); ?>