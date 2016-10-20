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

<!-- REMONTEE DE PRODUITS -->
<section class="products">

 <!-- LE DERNIER PRODUIT QUI N'EST PAS FEATURED -->
<?php
		$args = array(
			'post_type' => 'product',
			'orderby' => 'date',
			'posts_per_page' => 1,
			'meta_query' => array(
						array(
							'key'     => '_featured',
							'value'   => 'no',
						),
					),
			);

		$loop = new WP_Query( $args );

		if ( $loop->have_posts() ) {
			while ( $loop->have_posts() ) : $loop->the_post();
				$product = get_product(get_the_ID()); ?>

				<article class="product hot-new shadow woocommerce">
					<h2>Nos nouveautés</h2>
					<a href="<?php the_permalink();?>">
					<?php the_post_thumbnail(); ?>
					<div class="product-title"><?php the_title(); ?></div>
					</a>
					<div class="product-description"><?php the_excerpt(); ?></div>
					<div><?php echo $product->get_price_html(); ?></div>
					<?php echo $product->get_rating_html(); ?><br />
					<?php woocommerce_template_loop_add_to_cart(); ?>


				</article>
			<?php	endwhile;
		} else {
			echo __( 'No products found' );
		}
		wp_reset_postdata();
?>
<!-- LE DERNIER PRODUIT QUI N'EST PAS FEATURED -->

 <!-- LE BEST SELLER NON FEATURES -->
<?php
		$args = array(
			'post_type' => 'product',
			'posts_per_page' => 1,
			'meta_query' => array(
						array(
							'key'     => 'total_sales',
							'orderby' => 'meta_value_num',
						),
						array(
							'key'     => '_featured',
							'value'   => 'no',
						),
					),
			);

		$loop = new WP_Query( $args );

		if ( $loop->have_posts() ) {
			while ( $loop->have_posts() ) : $loop->the_post();
				$product = get_product(get_the_ID()); ?>

				<article class="product best-sellers shadow woocommerce">
					<h2>Notre best-seller</h2>
					<a href="<?php the_permalink();?>">
					<?php the_post_thumbnail(); ?>
					<div class="product-title"><?php the_title(); ?></div>
					</a>
					<div class="product-description"><?php the_excerpt(); ?></div>
					<div><?php echo $product->get_price_html(); ?></div>
					<?php echo $product->get_rating_html(); ?><br />
					<?php woocommerce_template_loop_add_to_cart(); ?>


				</article>
			<?php	endwhile;
		} else {
			echo __( 'No products found' );
		}
		wp_reset_postdata();
?>
<!-- LE BEST SELLER -->

<!-- DERNIER PRODUIT FEATURED -->
<?php
$args = array(
    'post_type' => 'product',
    'meta_key' => '_featured',
    'meta_value' => 'yes',
		'orderby' => 'date',
    'posts_per_page' => 1
);

$featured_query = new WP_Query( $args );

if ($featured_query->have_posts()) :

    while ($featured_query->have_posts()) :

        $featured_query->the_post();

        $product = get_product( $featured_query->post->ID );?>

				<article class="product our-favorite shadow woocommerce">
					<h2>Notre coup de coeur</h2>
					<a href="<?php the_permalink();?>">
					<?php the_post_thumbnail(); ?>
					<div class="product-title"><?php the_title(); ?></div>
					</a>
					<div class="product-description"><?php the_excerpt(); ?></div>
					<div><?php echo $product->get_price_html(); ?></div>
					<?php echo $product->get_rating_html(); ?><br />
					<?php woocommerce_template_loop_add_to_cart(); ?>


				</article>

  <?php  endwhile;

endif;

wp_reset_query(); // Remember to reset
?>

</section>
<!-- DERNIER PRODUIT FEATURED -->
<!-- REMONTEE DE PRODUITS -->




</main><!-- .site-main -->
<div>


<?php get_footer(); ?>
