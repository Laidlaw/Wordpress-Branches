<?php
/**
 * The template used for displaying page content in page.php
 *
 * @package big_whoop
 * @since big_whoop 1.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<h1 class="entry-title"><?php the_title(); ?></h1>
	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php the_content(); ?>
		<?php wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:', 'big_whoop' ), 'after' => '</div>' ) ); ?>
		<?php edit_post_link( __( 'Edit', 'big_whoop' ), '<span class="edit-link">', '</span>' ); ?>
	</div><!-- .entry-content -->
</article><!-- #post-<?php the_ID(); ?> -->
