<?php
/**
 * The template part for displaying single posts
 *
 * @package WordPress
 * @subpackage Twenty_Sixteen
 * @since Twenty Sixteen 1.0
 */
?>

<a href="<?php echo get_permalink();?>">
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="featured-caption">
		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
		<?php the_excerpt(); ?>
	</div>
	<?php twentysixteen_post_thumbnail(); ?>

	<?php if ( !is_front_page() ) {
		echo '<div class="entry-content">';
		the_content();
		wp_link_pages( array(
					'before'      => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'twentysixteen' ) . '</span>',
					'after'       => '</div>',
					'link_before' => '<span>',
					'link_after'  => '</span>',
					'pagelink'    => '<span class="screen-reader-text">' . __( 'Page', 'twentysixteen' ) . ' </span>%',
					'separator'   => '<span class="screen-reader-text">, </span>',
				) );

		if ( '' !== get_the_author_meta( 'description' ) ) {
					get_template_part( 'template-parts/biography' );
		}

		echo '</div>'; // entry-content

		echo '<footer class="entry-footer">';
		twentysixteen_entry_meta();
		echo '</footer>';// entry-footer
	}; // end if is front ou is home
	?>
</article><!-- #post-## -->
</a>
