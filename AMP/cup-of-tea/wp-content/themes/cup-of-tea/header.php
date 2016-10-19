<?php
/**
 * The template for displaying the header
 *
 * Displays all of the head element and everything up until the "site-content" div.
 *
 * @package WordPress
 * @subpackage Twenty_Sixteen
 * @since Twenty Sixteen 1.0
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<?php if ( is_singular() && pings_open( get_queried_object() ) ) : ?>
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<?php endif; ?>


<?php
	/*
	<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/style.css" type="text/css" />
*/ ?>

	<link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/css/normalize.css" type="text/css" />
	<link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/css/styles.css" type="text/css" />
	<link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/fonts/font-awesome/css/font-awesome.min.css" type="text/css" />
	<link href="https://fonts.googleapis.com/css?family=Amaranth:400,700" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Open+Sans:400,700" rel="stylesheet">
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
		<header id="masthead" class="site-header" role="banner">
			<div class="banner">Livraison offerte à partir de 65€ d'achat !</div>
			<section>
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="" id="logo">
							<img src="<?php echo get_stylesheet_directory_uri(); ?>/images/logo.png" alt="Cup of tea" />
					</a>
					<a id="cart" class="cart-contents" href="<?php echo wc_get_cart_url(); ?>" title="<?php _e( 'View your shopping cart' );  ?>"><p>Mon panier<span><?php echo WC()->cart->get_cart_total(); ?></span></p>
					<i class="fa fa-shopping-cart" aria-hidden="true"></i>
				<?php /* <?php echo WC()->cart->get_cart_contents_count(); ?>  */?></a>

					<?php if ( has_nav_menu( 'primary' ) ) : ?>

						<button id="menu-toggle" class="menu-toggle mobileMenu"><i class="fa fa-bars" aria-hidden="true"></i></button>

						<nav id="site-navigation" class="main-navigation" role="navigation" aria-label="<?php esc_attr_e( 'Primary Menu', 'twentysixteen' ); ?>">
						<?php $menuParameters = array(
									'container'       => false,
									'echo'            => false,
									'items_wrap'      => '%3$s',
									'depth'           => 0,
								);

						echo strip_tags(wp_nav_menu( $menuParameters ), '<a>' ); ?>
						</nav><!-- .main-navigation -->
					<?php endif; ?>
				</section>
		</header><!-- .site-header -->
