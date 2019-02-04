<?php 
/**
 * Template Name: Side Gallery Template
 *
 * 
 */
get_header(); ?>
<style>
	#rl-gallery-container-1 .rl-basicgrid-gallery .rl-gallery-item {
    	width: calc(100% - 2px) !important;
	}
	.entry-featured { display:none; }
</style>
<div class="row">
	<div class="col-md-12 gallery-split">
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
        
	</div><!-- /.col-md-12 -->
</div><!-- /.row -->
<script>
	jQuery('img[class*=wp-image-]').each(function(){
		jQuery(this).click(function(){
			var mySource = this.src;
			console.log(this.src);
			jQuery(".rl-gallery-link:first").click();
			
  		});
	});
</script>
<?php get_footer(); ?>