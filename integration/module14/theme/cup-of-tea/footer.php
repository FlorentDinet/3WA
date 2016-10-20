<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after
 *
 * @package WordPress
 * @subpackage Twenty_Sixteen
 * @since Twenty Sixteen 1.0
 */
?>



		<footer>
			<ul class="features">
				<?php

				// check if the repeater field has rows of data
				if( have_rows('features') ):

					// loop through the rows of data
						while ( have_rows('features') ) : the_row();?>

								<!-- display a sub field value -->

								<li class="feature"><?php the_sub_field('font_awesome'); ?><?php the_sub_field('feature'); ?>
								</li>

								<?php
						endwhile;

				else :

						// no rows found

				endif;

				?>
		</ul>
			<?php

			// check if the repeater field has rows of data
			if( have_rows('linklist') ):

				// loop through the rows of data
					while ( have_rows('linklist') ) : the_row();?>
					<ul class="side-infos">
							<!-- display a sub field value -->

							<a href=""><h4><?php the_sub_field('titre'); ?></h4></a>
							<?php while ( have_rows('list') ) : the_row();?>

							<li><a href="<?php the_sub_field('link');?>"><?php the_sub_field('link-title');?></a></li>


							<?php
						endwhile;?>
					</ul>
				<?php	endwhile;

			else :

					// no rows found

			endif;

			?>
		</footer><!-- .site-footer -->

<?php wp_footer(); ?>






<?php

// SCRIPT POUR AFFICHER LES FICHIERS TEMPLATES UTILISES

$mon_tableau=get_included_files();
$string_to_find="/wp-content/themes";
$string_to_find2="woocommerce/templates";

foreach($mon_tableau as $element)
{
	$pos = strpos($element,$string_to_find);
	$pos2 = strpos($element,$string_to_find2);

	if(($pos === false) && ($pos2 === false)) {

	} else {
		echo $element . '<br />';
	}

}
?>


</body>
</html>
