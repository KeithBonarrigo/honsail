<?php get_header(); ?>

<?php get_template_part( 'inc_section_title' ); ?>

<?php if( ci_setting( 'blog_layout' ) == 'sidebar' ): ?>
	<div class="row">

		<div class="col-md-8">
<?php endif; ?>

<?php
	global $wp_query;

	$found = $wp_query->found_posts;
	$none  = __( 'No results found. Please broaden your terms and search again.', 'truenorth' );
	$one   = __( 'Just one result found. We either nailed it, or you might want to broaden your terms and search again.', 'truenorth' );
	$many  = sprintf( _n( '%d result found.', '%d results found.', $found, 'truenorth' ), $found );
?>

<article class="entry">
	<div class="entry-content group">
		<p><?php ci_e_inflect( $found, $none, $one, $many ); ?></p>
		<?php if ( $found < 2 ) : ?>
			<?php get_search_form(); ?>
		<?php endif; ?>
	</div>
</article>

<?php while( have_posts() ): the_post(); ?>
	<article id="entry-<?php the_ID(); ?>" <?php post_class( 'entry' ); ?>>

		<?php if( has_post_thumbnail() ): ?>
			<figure class="entry-featured">
				<a href="<?php the_permalink(); ?>">
					<?php the_post_thumbnail(); ?>
				</a>
			</figure>
		<?php endif; ?>

		<h2 class="entry-title">
			<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
		</h2>

		<div class="entry-content group">
			<?php ci_e_content(); ?>
			<?php ci_read_more(); ?>
		</div><!-- /.entry-content -->
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