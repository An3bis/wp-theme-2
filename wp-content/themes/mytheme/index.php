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

<!--
have_posts() - bool
the_post() - 
get_template_part( 'template-parts/content', get_post_type() );
the_posts_navigation()
-->

  </div> <!-- /container -->

	<div id="primary" class="content-area">
		<main id="main" class="site-main">

			<main role="main">
				<!-- Main jumbotron for a primary marketing message or call to action -->
				<div class="jumbotron">
					<div class="container">
						<h1 class="display-3"><?php bloginfo('name'); ?></h1>
						<p><?php bloginfo('description'); ?></p>
					</div>
				</div>

				<div class="container">
				    <!-- Example row of columns -->
				    <div class="row">

					    <?php 
					    $products = new Products;
					    $loop = $products->getProducts();

					    /*
					    	the_title();
					    	the_content();
					    	<?php echo the_permalink(); ?>
					    */

					    if($loop->have_posts()):
					    	while($loop->have_posts()): 
					    		$loop->the_post(); ?>
								<div class="col-md-3">
											
								</div>
					    	<?php endwhile;	?>
					    <?php endif; ?>				    	

					    <?php 
					    $taxes = new Taxes;

					    ?>


					</div>
				</div>  

			</main>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_sidebar();
get_footer();
