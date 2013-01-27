<?php
/**
 * Template Name:Splash page
 *
 * A custom page template without sidebar.
 *
 * The "Template Name:" bit above allows this to be selectable
 * from a dropdown menu on the edit page screen.
 *
 * @package WordPress
 * @subpackage Twenty_Ten
 * @since Twenty Ten 1.0
 */

get_header("home"); ?>

<div id="content">

			
<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>

				

					
						<?php the_content(); ?>
						
				

<?php endwhile; // end of the loop. ?>

			</div><!-- #content -->

<?php get_footer(); ?>