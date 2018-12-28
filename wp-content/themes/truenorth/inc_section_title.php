<?php
	$title = ci_setting( 'title_blog' );

	if ( is_home() or is_singular( 'post' ) ) {
		$title = ci_setting( 'title_blog' );
	} elseif ( is_singular() ) {
		$title = single_post_title( '', false );
	} elseif ( is_category() || is_tag() || is_tax() ) {
		$title = single_term_title( '', false );
	} elseif ( is_month() ) {
		$title = single_month_title( '', false );
	} elseif ( is_search() ) {
		$title = ci_setting( 'title_search' );
	} elseif ( is_404() ) {
		$title = ci_setting( 'title_404' );
	}

?>
<h2 class="section-title"><?php echo $title; ?></h2>
