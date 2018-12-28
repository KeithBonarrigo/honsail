<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php do_action( 'after_open_body_tag' ); ?>

<div id="page">

	<div id="mobile-bar">
		<a class="menu-trigger" href="#mobilemenu"><i class="fa fa-bars"></i></a>
	</div>

	<header class="header">

		<div class="nav-hold">
			<nav class="main-nav nav">
				<?php wp_nav_menu( array(
					'theme_location' => 'main_menu',
					'fallback_cb'    => '',
					'container'      => '',
					'menu_id'        => '',
					'menu_class'     => 'navigation'
				) ); ?>
			</nav>

			<div id="mobilemenu"></div>
		</div><!-- /.nav-hold -->

		<div class="hero">
			<div class="logo">
				<?php ci_e_logo( '<h1>', '</h1>' ); ?>
				<?php ci_e_slogan( '<p class="site-tagline">', '</p>' ); ?>
			</div><!-- /.logo -->
		</div><!-- /.hero -->

	</header>

  <?php if ( ! is_page_template( 'template-builder.php' ) ): ?>
	<main class="main">
		<div class="container">
			<div class="row">
				<div class="col-md-10 col-md-offset-1">
  <?php endif; ?>				
