<?php if ( ! is_page_template( 'template-builder.php' ) ): ?>
			</div><!-- /.col-md-10 .col-md-offset-1 -->
		</div><!-- /.row -->
	</div><!-- /.container -->
</main>
<?php endif; ?>

<footer class="footer">

	<div class="container">
		<div class="row">
			<div class="col-md-10 col-md-offset-1">

				<?php if( is_active_sidebar( 'footer' ) ): ?>
					<div class="footer-widgets">
						<?php dynamic_sidebar( 'footer' ); ?>
					</div><!-- /.widget-area -->
				<?php endif; ?>

				<nav class="nav">
					<?php wp_nav_menu( array(
						'theme_location' => 'footer_menu',
						'fallback_cb'    => '',
						'container'      => '',
						'menu_id'        => '',
						'menu_class'     => 'navigation'
					) ); ?>
				</nav><!-- .nav -->

				<div class="logo footer-logo">
					<?php if( ci_setting( 'footer_logo_image' ) != '' ): ?>
						<h1><a href="<?php the_permalink(); ?>"><img src="<?php echo esc_url( ci_setting( 'footer_logo_image' ) ); ?>" alt="<?php echo esc_attr( ci_setting( 'footer_logo_title' ) ); ?>" /></a></h1>
					<?php else: ?>
						<h1><a href="<?php the_permalink(); ?>"><?php echo ci_setting( 'footer_logo_title' ); ?></a></h1>
					<?php endif; ?>
					<p class="site-tagline"><?php echo ci_footer(); ?></p>
				</div><!-- /.footer-logo -->

			</div><!-- /.col-md-10 .col-md-offset-1 -->
		</div><!-- /.row -->
	</div><!-- /.container -->

	<div class="left sticky-area"></div>
	<div class="right sticky-area"></div>
	<div class="bottom sticky-area"></div>

</footer>

</div><!-- /#page -->
</body><!-- /.home -->

<?php wp_footer(); ?>

</body>
</html>
