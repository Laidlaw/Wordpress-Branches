<?php
/*

EMPTY HOOKS
	scm_before_page_content()
	scm_logo_and_nav()
	scm_after_nav()

FILLED HOOKED (that must either be emptied or filtered)
	scm_loop_index_content()

*/

// EMPTY HOOKS
if ( ! function_exists( 'scm_before_page_content' ) ) :
function scm_before_page_content() {}
endif;
do_action('scm_before_page_content');


if ( ! function_exists( 'scm_after_container' ) ) :
function scm_after_container() {}
endif;
do_action('scm_after_container');


if ( ! function_exists( 'scm_after_nav' ) ) :
function scm_after_nav() {}
endif;
do_action('scm_after_nav');


if ( ! function_exists( 'scm_before_footer' ) ) :
function scm_before_footer() {}
endif;
do_action('scm_before_footer');

if ( ! function_exists( 'scm_footer' ) ) :
function scm_footer() {}
endif;
do_action('scm_footer');

if ( ! function_exists( 'scm_after_footer' ) ) :
function scm_after_footer() {}
endif;
do_action('scm_after_footer');



// FILLED HOOKS
if ( ! function_exists( 'scm_logo_and_nav' ) ) :
	function scm_logo_and_nav() { ?>

	    <hgroup id="header">
			<h1><a href="<?php echo site_url(); ?>"><?php bloginfo('title'); ?></a></h1>
			<h4 class="subheader"><?php bloginfo('description'); ?></h4>
		</hgroup>
		<?php wp_nav_menu( array( 'theme_location' => 'header-menu','menu_class' => 'nav-bar', 'container' => 'nav') ); ?>
	<?php }
	endif;
	    do_action('scm_logo_and_nav');
	



if ( ! function_exists( 'scm_main_class_filter' ) ) :
	function scm_main_class_filter() { 
		echo "grid-12";
	     }
	endif;
	    do_action('scm_main_class_filter');




if ( ! function_exists( 'scm_loop_index_content' ) ) :
		function scm_loop_index_content() { ?>
			<!-- Begin the first article -->
		<article>
				
			<!-- Display the Title as a link to the Post's permalink. -->
			<h2>
				<a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a>
			</h2>
			
			<!-- Display the date (November 16th, 2009 format) and a link to other posts by this posts author. -->
			<?php the_time('F jS, Y') ?> by <?php the_author_posts_link() ?>
			
			<!-- Display the Post's Content in a div box. -->
			<div class="entry">
				<?php the_content(); ?>
			</div>
			
			<!-- Display a comma separated list of the Post's Categories. -->
			<p class="postmetadata">Posted in <?php the_category(', '); ?></p>
			
		    <span class="comment-count"><?php comments_popup_link('Leave a comment', '1 Comment', '% Comments'); ?></span>  

		</article>
		<hr> 

		<?php

		}
	endif;
	do_action('scm_loop_index_content');



if ( ! function_exists( 'scm_loop_page_content' ) ) :
		function scm_loop_page_content() { ?>
<div>
				
			<h2>
				<?php the_title(); ?>
			</h2>
			
			<!-- Display the Page's Content in a div box. -->
			<div class="entry">
				<?php the_content(); ?>
			</div>
		
		</div>
		<!-- Closes the first div -->
<?php } 
	endif;
	do_action('scm_loop_page_content');



if ( ! function_exists( 'scm_should_this_get_sidebar' ) ) :
		function scm_should_this_get_sidebar() { 
			get_sidebar();
		 } 
	endif;
	do_action('scm_should_this_get_sidebar');





if ( ! function_exists( 'scm_footer' ) ) :
		function scm_footer() { ?>

	<?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('Footer Sidebar')) : ?>

		<?php endif; ?>
	<?php

		}
	endif;
	do_action('scm_footer');

?>
