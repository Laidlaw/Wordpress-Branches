<?php
/*

Copyright 2008 MagicToolbox (email : support@magictoolbox.com)

Plugin Name: Magic Zoom Plus for WP e-Commerce
Plugin URI: http://www.magictoolbox.com/magiczoomplus/
Description: Magic Zoom Plus for WP e-Commerce<sup>&#8482;</sup> lets you add a zoom and enlarge effect to your images. Try out some <a target="_blank" href="http://www.magictoolbox.com/magiczoomplus_integration/">customisation options</a>.
Version: 5.7.19
Author: MagicToolbox
Author URI: http://www.magictoolbox.com/

*/

/*
    WARNING: DO NOT MODIFY THIS FILE!

    NOTE: If you want change Magic Zoom Plus settings
            please go to plugin page
            and click 'Magic Zoom Plus Configuration' link in top navigation sub-menu.
*/

if(!function_exists('magictoolbox_WPEcommerce_MagicZoomPlus_init')) {
    /* Include MagicToolbox plugins core funtions */
    require_once(dirname(__FILE__)."/magiczoomplus-wpecommerce/plugin.php");
}

//MagicToolboxPluginInit_WPEcommerce_MagicZoomPlus ();
register_activation_hook( __FILE__, 'WPEcommerce_MagicZoomPlus_activate');

register_deactivation_hook( __FILE__, 'WPEcommerce_MagicZoomPlus_deactivate');

magictoolbox_WPEcommerce_MagicZoomPlus_init();
?>