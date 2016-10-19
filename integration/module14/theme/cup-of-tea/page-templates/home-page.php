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
		echo '<ul>';
		while ( $the_query->have_posts() ) {
			$the_query->the_post();
			get_template_part( 'template-parts/content', 'article' );
		}
		echo '</ul>';
		/* Restore original Post Data */
		wp_reset_postdata();
	} else {
		// no posts found
	}
		?>
	</section>


</main><!-- .site-main -->

<?php get_footer(); ?>
