<?php
/**
 * Template Name: Contributor Page
 *
 * @package WordPress
 * @subpackage Twenty_Fourteen
 * @since Twenty Fourteen 1.0
 */

get_header(); ?>


<main>

	<!-- TEST FLEX-SLIDER -->
	<section>
		<!-- Place somewhere in the <body> of your page -->
		<div class="flexslider">
			<ul class="slider slides shadow">
				<?php

				// check if the repeater field has rows of data
				if( have_rows('slider') ):

				 	// loop through the rows of data
				    while ( have_rows('slider') ) : the_row();?>

				        // display a sub field value

								<li><img src="<?php the_sub_field('slide'); ?>" /></li>

								<?php
				    endwhile;

				else :

				    // no rows found

				endif;

				?>



			</ul>
		</div>
	</section>
	<!-- TEST FLEX-SLIDER -->

<?php /*

<!-- CONTENU PRINCIPAL -->
			<?php
				// Start the Loop.
				while ( have_posts() ) : the_post();
			?>

			<section class="slider shadow">
				<?php
					the_content();
				?>
			</section>
			<?php	endwhile;	?>
<!-- CONTENU PRINCIPAL -->


<!-- REMONTEE ARTICLES -->
<section>
	<h2>Découvrez <span>nos motos</span></h2>
	<div class="team">
	<?php
	$my_query = new WP_Query( 'cat=3&order=ASC' );
	if ( $my_query->have_posts() ) {
		while ( $my_query->have_posts() ) {
			$my_query->the_post();
			?><article class="product shadow"><?php
			the_content();
			?></article><?php
		}
	}
	wp_reset_postdata();
	?>
	</div>
</section>
<!-- REMONTEE ARTICLES -->

*/ ?>


<!-- REMONTEE PRODUIT -->
<section>
	<h2>Découvrez <span>nos motos</span></h2>
	<div class="team">
<?php
		$args = array(
			'post_type' => 'product',
			'posts_per_page' => 4
			);
		$loop = new WP_Query( $args );
		if ( $loop->have_posts() ) {
			while ( $loop->have_posts() ) : $loop->the_post(); ?>
				<article class="product shadow">
					<?php woocommerce_template_loop_product_thumbnail(); ?>
					<?php woocommerce_template_loop_product_title(); ?>
					<?php woocommerce_template_single_excerpt(); ?>
					<?php

					woocommerce_template_single_price();

					// wc_get_template( 'page-templates/price.php' );

					 ?>
					<?php

					 woocommerce_template_loop_add_to_cart();

					//
					// $x->str_replace("cart","",$x);

					// echo $x;?>
					</article>
			<?php	endwhile;
		} else {
			echo __( 'No products found' );
		}
		wp_reset_postdata();
	?>
</div>
</section>


<!-- REMONTEE PRODUIT -->




<!-- DETAILS -->
<section class="detail">
	<h2>Pour nous connaître <span>plus en détail</span></h2>
	<!-- CONTENU ACF -->
		<?php
			// Contrôler si ACF est actif
			if ( !function_exists('get_field') ) return;
		?>

		<?php the_field('detail_text'); ?>
	<?php /*	<img src="<?php the_field('detail_img'); ?>" /> */ ?>
		<?php the_field('detail_video'); ?>

	<!-- CONTENU ACF -->
</section>
<!-- DETAILS -->
</main>

<?php
get_footer();
