<?php
/**
 * The Header for our theme
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @package WordPress
 * @subpackage Twenty_Fourteen
 * @since Twenty Fourteen 1.0
 */
?><!DOCTYPE html>
<!--[if IE 7]>
<html class="ie ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html class="ie ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 7) & !(IE 8)]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width">
	<title><?php wp_title( '|', true, 'right' ); ?></title>
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/normalize.css" type="text/css" />
	<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/flexslider.css" type="text/css">
	<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/styles.css" type="text/css" />
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"></script>
	<script src="<?php echo get_template_directory_uri(); ?>/js/jquery.flexslider.js"></script>
	<script src="<?php echo get_template_directory_uri(); ?>/js/jquery.lettering-0.6.1.min.js"></script>
	<!--[if lt IE 9]>
	<script src="<?php echo get_template_directory_uri(); ?>/js/html5.js"></script>
	<![endif]-->

	<!-- Place in the <head>, after the three links -->
	<script type="text/javascript" charset="utf-8">
	  $(window).load(function() {
	    $('.flexslider').flexslider({
				slideshow: true,
				directionNav: false
			});
	  });
	</script>
	<script>
      $(document).ready(function() {
        $(".woocommerce-Price-amount").lettering();


    var elements = document.getElementsByClassName('add_to_cart_button');
        i = elements.length;

    	while(i--) {
        	elements[i].innerHTML = "Ajouter au panier";
    	}


		});
	</script>



	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
	<header class="shadow">
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" title="Page d'accueil" id="logo"><img src="<?php echo get_template_directory_uri(); ?>/images/logo.png" alt="Red Wolf" /></a>
			<nav>
				<?php $menuParameters = array(
						'container'       => false,
						'echo'            => false,
						'items_wrap'      => '%3$s',
						'depth'           => 0,
					);

echo strip_tags(wp_nav_menu( $menuParameters ), '<a>' ); ?>
	<a class="cart-contents" href="<?php echo wc_get_cart_url(); ?>" title="<?php _e( 'View your shopping cart' ); ?>"><i class="fa fa-shopping-cart" aria-hidden="true"></i><?php echo WC()->cart->get_cart_contents_count(); ?>
<?php /* - <?php echo WC()->cart->get_cart_total(); ?> */?></a>
			</nav>
	</header>
<!-- <div id="page" class="hfeed site">



	<div id="main" class="site-main"> -->
