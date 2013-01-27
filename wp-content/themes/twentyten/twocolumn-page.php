<?php
/**
 * Template Name: Two column, with right sidebar
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

			

			
<div id="content" role="main">
    <div class="wrapper-center" >
        <div id="left-side" style="width: 1000px;">
           <?php
           /* Run the loop to output the page.
            * If you want to overload this in a child theme then include a file
            * called loop-page.php and that will be used instead.
            */
            get_template_part( 'loop', 'page' );
           ?>
        </div>
<div id="bottom-side" style="margin-bottom:20px; width: 1000px;">
        <?php get_sidebar("bottom"); ?>
                </div>
        

    </div>
</div>


<?php get_footer(); ?>