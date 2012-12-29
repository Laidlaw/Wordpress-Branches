<?php
/*

Plugin Name: Get Permalink
Plugin URI: http://justintadlock.com/archives/2008/09/19/get-permalink-wordpress-plugin
Description: Shortcode for making a link to permalinks within your blog to prevent future changes leaving you with broken links.
Version: 0.1
Author: Justin Tadlock
Author URI: http://justintadlock.com
License: GPL
*/

/**
* jt_permalink_shortcode()
* Returns formatted link to a permalink
*
* @since 0.1
*/
function jt_permalink_shortcode($atts, $content = null) {

	extract(shortcode_atts(array(
		'href' => 0,
		'rel' => 'bookmark',
		'title' => false,
		'class' => false,
	), $atts));

// Begin link
	$link = '<a href="' . get_permalink($href) . '"';

// Check for title
	if($title) $link .= ' title="' . $title . '"';
	else $link .= ' title="' . get_the_title($href) . '"';

// Check for rel
// Defaults to bookmark
	if($rel) $link .= ' rel="' . $rel . '"';

// Check for rel
// Defaults to bookmark

// Check for class
// No default
	if($class) $link .= ' class="' . $class . '"';

// Close beginning of link
	$link .= '>';

// Get link content
// Can put anything between shortcode tags
// If nothing, default to the post/page title
	if($content) $link .= $content;
	else $link .= get_the_title($href);

// Close link
	$link .= '</a>';

// Return the link
	return $link;
}

/**
* Add the permalink shortcode
*/
add_shortcode('permalink', 'jt_permalink_shortcode');

?>