<?php

$page_option=get_option('xyz_lbx_page_option');
if($page_option==3)
{

add_shortcode( 'xyz_lbx_default_code', 'lbx_lightbox_display' );
}

?>