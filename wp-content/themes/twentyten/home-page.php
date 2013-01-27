<?php
/**
 * Template Name:Home page
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

get_header(); ?>

<div id="content">
<div class="wrapper-center" >
			
<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>

				

					
						<?php the_content(); ?>
						
				

<?php endwhile; // end of the loop. ?>


<div class="clearboth"></div>

<div id="footer"> 
	&copy; <?php bloginfo( 'name' ); ?>. All rights reserved.
	</div>
			</div><!-- #content -->
			
</div>

<?php get_footer(); ?>