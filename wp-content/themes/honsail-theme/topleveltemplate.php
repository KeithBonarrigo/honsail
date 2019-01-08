<?php 
/**
 * Template Name: Top Level Template
 *
 * 
 */
get_header(); ?>
<style>
	#rl-gallery-container-1 .rl-basicgrid-gallery .rl-gallery-item {
    	width: calc(100% - 2px) !important;
	}
</style>
<div class="row">
	<div class="col-md-12 gallery-split">
    
        <style>
            .top-level-thumb { float:left; width:150px; vertical-align:top; margin:0px 10px 20px 50px; }
            .top-level-more-info, .top-level-link { color: #CE0000; }
            .top-level-link { font-weight:bold; lettert-spacing:1px; }
            .top-level-child { clear:both; margin-bottom:20px; }
            .entry-featured { display:none }
        </style>

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
                <?php 
                    $args = array(
	                'post_parent' => get_the_ID(),
	                'post_type'   => 'any', 
	                'numberposts' => 99,
                    'post_status' => 'publish',
                    'orderby' => 'menu_order',
                    'order' => 'ASC'
                    );
                    $children = get_children( $args );
                
                foreach($children as $child=>$childInfo){
                    $thumb = ''; //placeholder for the image

                    if (has_post_thumbnail( $childInfo->ID ) ){
                        $image = wp_get_attachment_image_src( get_post_thumbnail_id( $childInfo->ID ), 'single-post-thumbnail' );
                        $thumb = $image[0];
                    }
                    $my_blurb = get_post_meta( $childInfo->ID,'cf_blurb', true );
                  ?>
                  <div class='top-level-child'>
                  <?php
                   if(strlen($thumb)>0) echo "<img class='top-level-thumb' src =\"".$thumb."\" alt=\"".$childInfo->post_name."\">";
                   echo "<a class='top-level-link' href='".$childInfo->post_name."/'>".$childInfo->post_title."</a>";
                   echo "<br />";
                   echo $my_blurb;
                   echo "<br />";
                   ?>
                   <a class='top-level-more-info' href='<?php echo $childInfo->post_name."/" ?>'>More info / photos</a>
                   </div>
                   <?php
                }
                ?>
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