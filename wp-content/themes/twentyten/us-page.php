<?php
/**
 * Template Name:Us page
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package WordPress
 * @subpackage Twenty_Ten
 * @since Twenty Ten 1.0
 */

get_header(); ?>

			<div id="content" >
			<?php get_sidebar("other"); ?>

			
	      <div id="rightside">
			<?php
			/* Run the loop to output the page.
			 * If you want to overload this in a child theme then include a file
			 * called loop-page.php and that will be used instead.
			 */
			get_template_part( 'loop', 'page' );
			
			
			?>
			
			
<div id="footer"> 
	&copy; <?php bloginfo( 'name' ); ?>. All rights reserved.
	</div>
			</div>
			
			
			</div><!-- #content -->
			


<script>
$(document).ready(function() {
	$('#sidebar_2').height(($(document).height() - 167 ));
});
</script>

<?php get_footer(); ?>