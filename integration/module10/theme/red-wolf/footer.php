<?php
/**
 * The template for displaying the footer
 *
 * Contains footer content and the closing of the #main and #page div elements.
 *
 * @package WordPress
 * @subpackage Twenty_Fourteen
 * @since Twenty Fourteen 1.0
 */
?>

<!--</div> #main -->

		<footer>
			<p>Proident esse aliquip officia nostrud cillum eiusmod consequat esse.</p>
			<?php $menuParameters = array(
						'container'       => false,
						'echo'            => false,
						'items_wrap'      => '%3$s',
						'depth'           => 0,
					);

echo strip_tags(wp_nav_menu( $menuParameters ), '<a>' ); ?>
<p>2016 - 3WA - Module 10 : Red Wolf</p>

		</footer><!-- #colophon -->
	</div><!-- #page -->

	<?php wp_footer(); ?>
</body>
</html>
