<?php
/**
 * Template Name: Home Page
 *
 * @package WordPress
 * @subpackage cup-of-tea
 * @since Cup of tea v1
 */

get_header(); ?>

<main id="main" class="site-main" role="main">

<!-- REMONTEE ARTICLE FEATURED -->
<section class="featured shadow">
		<?php
		$args = array(
			'post_type' => 'post',
			'posts_per_page' => 1
			);

	// The Query
	$the_query = new WP_Query( $args );

	// The Loop
	if ( $the_query->have_posts() ) {
		while ( $the_query->have_posts() ) {
			$the_query->the_post();
			get_template_part( 'template-parts/content', 'article' );
		}
		/* Restore original Post Data */
		wp_reset_postdata();
	} else {
		// no posts found
	}
		?>
	</section>
<!-- REMONTEE ARTICLE FEATURED -->

<!-- REMONTEE CATÉGORIES DE THÉ -->
<section class="tea-cat shadow">
	<h2>Choisissez votre thé</h2>
	<div class="categories">

		<?php
		$args = array(
				'hide_empty' => 0,
				'orderby' => 'id',
				'parent' =>0
		);

		$productCats = get_terms('product_cat', $args ); //, 'exclude' => '17,77'
					foreach($productCats as $productCat) :
						$productCat_id = get_woocommerce_term_meta( $productCat->term_id, 'thumbnail_id', true );
						$productCat_image = wp_get_attachment_url( $productCat_id );
						?>
						<a href="<?php echo get_term_link( $productCat->slug, $productCat->taxonomy ); ?>" class="category">
						<?php
						if($productCat_image!=""):?><img src="<?php echo $productCat_image?>">
						<?php
						endif;?>
						<?php echo $productCat->name; ?>
						</a>
						<?php
					endforeach;?>

	</div>
	</section>
<!-- REMONTEE CATÉGORIES DE THÉ -->

<!-- REMONTEE DE PRODUITS FEATURED -->
<section class="products">

<?php
		$args = array(
			'post_type' => 'product',
			'posts_per_page' => 4
			);
		$loop = new WP_Query( $args );

		if ( $loop->have_posts() ) {
			while ( $loop->have_posts() ) : $loop->the_post();
				$product = get_product(get_the_ID()); ?>
				<article class="product hot-new shadow">

						<h2>Nos nouveautés</h2>
					<?php the_post_thumbnail(); ?>
					<div class="product-title"><?php the_title(); ?></div>
					<div class="description"><?php the_excerpt(); ?></div>
					<div><?php echo $product->get_price_html(); ?></div>

				</article>
			<?php	endwhile;
		} else {
			echo __( 'No products found' );
		}
		wp_reset_postdata();
	?>

</section>
<!-- REMONTEE DE PRODUITS FEATURED -->

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
					<?php woocommerce_template_single_price(); ?>
					<?php woocommerce_template_single_rating(); ?>
					<?php woocommerce_template_loop_add_to_cart(); ?>
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


</main><!-- .site-main -->

<?php get_footer(); ?>
