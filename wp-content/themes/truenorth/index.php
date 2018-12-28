<?php get_header(); ?>

<?php get_template_part( 'inc_section_title' ); ?>

<?php if( ci_setting( 'blog_layout' ) == 'sidebar' ): ?>
	<div class="row">

		<div class="col-md-8">
<?php endif; ?>

<?php while( have_posts() ): the_post(); ?>
	<article id="entry-<?php the_ID(); ?>" <?php post_class( 'entry' ); ?>>

		<?php if( has_post_thumbnail() ): ?>
			<figure class="entry-featured">
				<a href="<?php the_permalink(); ?>">
					<?php the_post_thumbnail(); ?>
				</a>
			</figure>
		<?php endif; ?>

		<div class="row">
			<div class="col-md-3">
				<dl class="entry-meta group">
					<dt><?php _e( 'Date:', 'truenorth' ); ?></dt>
					<dd><time class="entry-time" datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>"><?php echo esc_html( get_the_date() ); ?></time></dd>
					<?php if( get_the_category_list() != '' ): ?>
						<dt><?php _e( 'Categories:', 'truenorth' ); ?></dt>
						<dd><?php the_category( ', ' ); ?></dd>
					<?php endif; ?>
					<?php if( get_the_tag_list() != '' ): ?>
						<dt><?php _e( 'Tags:', 'truenorth' ); ?></dt>
						<dd><?php the_tags( '' ); ?></dd>
					<?php endif; ?>
					<dt><?php _e( 'Comments:', 'truenorth' ); ?></dt>
					<dd><a href="<?php comments_link(); ?>"><?php comments_number( '0', '1', '%' ); ?></a></dd>
				</dl><!-- /.entry-meta -->
			</div><!-- /.col-md-3 -->

			<div class="col-md-9">
				<h2 class="entry-title">
					<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
				</h2>

				<div class="entry-content group">
					<?php ci_e_content(); ?>
					<?php ci_read_more(); ?>
				</div><!-- /.entry-content -->
			</div><!-- /.col-md-9 -->
		</div><!-- /.row -->
	</article>
<?php endwhile; ?>

<?php ci_pagination(); ?>

<?php if( ci_setting( 'blog_layout' ) == 'sidebar' ): ?>
		</div><!-- /.col-md-8 -->

		<div class="col-md-4">
			<?php get_sidebar(); ?>
		</div><!-- /.col-md-4 -->

	</div><!-- /.row -->
<?php endif; ?>

<?php get_footer(); ?>