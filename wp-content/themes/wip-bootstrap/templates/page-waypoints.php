<?php
/**
 * The template for displaying all pages.
 * Template Name: Page_waypoints
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package lttlman
 * @since lttlman 1.0
 */

get_header(); 
//echo do_shortcode('[js script="waypoints"]');

?>

<?php
 
/*
*  View array data (for debugging)
*/
 

//var_dump( get_field('lttl_selected_posts') );
 
/*
*  Loop through post objects ( setup postdata )
*  Using this method, you can use all the normal WP functions as the $post object is temporarily initialized within the loop
*  Read more: http://codex.wordpress.org/Template_Tags/get_posts#Reset_after_Postlists_with_offset
*/
 
$posts = get_field('lttl_selected_posts');
if( $posts ): ?>	
<div class="sidebar">
	<nav id="section-nav">
		<ul >
		<?php foreach( $posts as $post): // variable must be called $post (IMPORTANT) ?>
			<?php setup_postdata($post); ?>
		    <li>
		    	<a href="#<?php echo( basename(get_permalink()) ); ?>" class="selected"><?php the_title(); ?></a>
		    </li>
		<?php endforeach; ?>
		</ul>
	</nav>
</div>

	<?php wp_reset_postdata(); // IMPORTANT - reset the $post object so the rest of the page works correctly ?>
<?php endif;

if( $posts ): ?>
<div id="primary" class="content-area">
	<div id="content" class="site-content" role="main">
	<?php foreach( $posts as $post): // variable must be called $post (IMPORTANT) ?>
		<?php setup_postdata($post); ?>
	    <section id="<?php echo( basename(get_permalink()) ); ?>">
	    	<!--<a href="<?php the_permalink(); ?>"  class=" <?php the_field('masthead_color'); ?>"><?php the_title(); ?></a>-->
	    	
	    	
	    	<?php // Gets the POST FORMAT of the entry for layout
	    		$format = get_post_format($post); 
				if ( false === $format )
				$format = 'standard';
	    	?>

	    	<article class="<?php echo $format; ?>"><?php the_content(); ?></article>
	    </section>
	<?php endforeach; ?>

	<?php wp_reset_postdata(); // IMPORTANT - reset the $post object so the rest of the page works correctly ?>
<?php endif;
 
 
?>



					<?php get_template_part( 'content', 'page' ); ?>

					<?php // comments_template( '', true ); ?>

			

			</div><!-- #content .site-content -->
		</div><!-- #primary .content-area -->

<div class="footnotes"></div>
<nav>
	<ul>
		<li><a class="top" href="#" title="Back to top">Top</a></li>
	</ul>
</nav>
<?php //get_sidebar(); ?>
<?php get_footer(); ?>