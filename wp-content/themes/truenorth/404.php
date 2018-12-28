<?php get_header(); ?>

<?php get_template_part( 'inc_section_title' ); ?>

<div class="row">
	<div class="col-md-8">

		<article class="entry">

			<div class="entry-content group">
				<p><?php _e( 'Oh, no! The page you requested could not be found. Perhaps searching will help...', 'truenorth' ); ?></p>
				<?php get_search_form(); ?>
			</div><!-- /.entry-content -->

		</article><!-- /.entry -->

	</div><!-- /.col-md-8 -->

	<div class="col-md-4">
		<?php get_sidebar(); ?>
	</div><!-- /.col-md-4 -->

</div><!-- /.row -->

<?php get_footer(); ?>