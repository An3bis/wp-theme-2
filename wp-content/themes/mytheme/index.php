<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package mytheme
 */

get_header();
?>

  </div> <!-- /container -->

	<div id="primary" class="content-area">
		<main id="main" class="site-main">

			<main role="main">

				<?php get_template_part( 'inc/head' ); ?>	

				<?php get_template_part( 'inc/filter' ); ?>	

				<?php get_template_part( 'inc/products' ); ?>	

			</main>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_sidebar();
get_footer();
