<article class="entry-portfolio-item">
	<a href="<?php the_permalink(); ?>">
		<?php if( has_post_thumbnail() ): ?>
			<figure class="entry-featured">
				<?php the_post_thumbnail(); ?>
			</figure>
		<?php endif; ?>

		<h2 class="entry-portfolio-title"><?php the_title(); ?></h2>
	</a>
</article>
