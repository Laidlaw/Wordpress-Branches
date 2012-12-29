<?php
/**
 * Custom functions that act independently of the theme templates
 *
 * Eventually, some of the functionality here could be replaced by core features
 *
 * @package lttlman
 * @since lttlman 1.0
 */

/**
 * Get our wp_nav_menu() fallback, wp_page_menu(), to show a home link.
 *
 * @since lttlman 1.0
 */
function lttlman_page_menu_args( $args ) {
	$args['show_home'] = true;
	return $args;
}
add_filter( 'wp_page_menu_args', 'lttlman_page_menu_args' );

/**
 * Adds custom classes to the array of body classes.
 *
 * @since lttlman 1.0
 */
function lttlman_body_classes( $classes ) {
	// Adds a class of group-blog to blogs with more than 1 published author
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}

	return $classes;
}
add_filter( 'body_class', 'lttlman_body_classes' );

/**
 * Filter in a link to a content ID attribute for the next/previous image links on image attachment pages
 *
 * @since lttlman 1.0
 */
function lttlman_enhanced_image_navigation( $url, $id ) {
	if ( ! is_attachment() && ! wp_attachment_is_image( $id ) )
		return $url;

	$image = get_post( $id );
	if ( ! empty( $image->post_parent ) && $image->post_parent != $id )
		$url .= '#main';

	return $url;
}
add_filter( 'attachment_link', 'lttlman_enhanced_image_navigation', 10, 2 );

/**
 * Load custom script libraries based on tags they use? not not be possible
 *
 * @since lttlman 1.0
 */
 
function lttlman_load_custom_scripts($atts) {
	extract(shortcode_atts(array('script' => 'test'), $atts));
	wp_enqueue_script('my-script', get_template_directory_uri() . '/js/lib/' .$script.'.min.js', array( 'jquery' ), '20120206', 1 );

}
add_shortcode('js', 'lttlman_load_custom_scripts');

function ajaxify() {
    $post_id = $_POST['post_id'];
    $post_data = get_post($post_id);
    echo json_encode($post_data);
}
