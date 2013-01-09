<?php
if(function_exists('add_theme_support')) {
    /** Now Set some image sizes */
    /** #1 for our featured content slider */
    //add_image_size( $name = 'itg_featured', $width = 500, $height = 300, $crop = true );

    /** #2 for post thumbnail */
    add_image_size( 'callout_thumb', 280, 130, true );

    /** Set default post thumbnail size */
    set_post_thumbnail_size($width = 280, $height = 130, $crop = true);
}
?>