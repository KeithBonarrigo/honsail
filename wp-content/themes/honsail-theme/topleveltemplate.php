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
            .entry-featured { display:none }
        </style>
		<?php $url = get_permalink();
		$url_broke = explode("/", $url);
		$last_slug = count($url_broke)-2;
		$this_page_category = $url_broke[$last_slug];
		$page_cats = array(
			'choose-a-yacht'=>'See these vessels',
			'itineraries'=>'View trips / info for this location',
			'learn-to-sail'=>'More info on this course',
			'oahu'=>'View more info on this trip',
			'maui-and-lenai' => 'View more info on this trip',
			'north-shore-molokai' => 'View more info on this trip',
			'kauai' => 'View more info on this trip',
			'big-island-of-hawaii' => 'View more info on this trip',

		);
		if(array_key_exists($this_page_category, $page_cats)){ 
			$more_info_link = $page_cats[$this_page_category];
		}else{
			$more_info_link = 'More info / photos';
		}
		
			while( have_posts() ): the_post(); ?>
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
                
                ?>
				<div class="entry-content group" style="padding-top:18px">
					<?php
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
					echo "<div class='top-level-title'><a class='top-level-link' href='".$childInfo->post_name."/'>".$childInfo->post_title."</a></div>";
					echo "<div class='content-top-template'>".$my_blurb."</div>";
					?>
					<div class='top-level-more-info'><a class='top-level-more-info' href='<?php echo $childInfo->post_name."/" ?>'><?php echo $more_info_link ?></a></div>
					</div>
					<div style='clear:both'></div>
					<hr>
					<?php
					}
					?>
					<?php //the_content(); ?>
					<?php //wp_link_pages(); ?>
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