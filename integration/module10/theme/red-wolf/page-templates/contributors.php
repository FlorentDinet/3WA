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
<section>
	<h2>Découvrez <span>nos motos</span></h2>
	<div class="team">

	<?php wp_reset_query(); ?>
	<?php query_posts('category_name=product&posts_per_page=4&order=ASC'); ?>
	<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
		<article class="product">
  <?php the_content(); ?>
		</article>
	<?php endwhile; endif; ?>
	</div>
</section>
</main>

<?php
get_footer();
