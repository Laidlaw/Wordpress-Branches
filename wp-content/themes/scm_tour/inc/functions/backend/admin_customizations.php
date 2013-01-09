<?php
/*
function enable_more_buttons($buttons) {
    $buttons[] = 'hr';
   return $buttons;
  }
  add_filter("mce_buttons", "enable_more_buttons");

  // Adding a styles dropdown to the Wordpress editor

  function themeit_mce_buttons_2( $buttons ) {
    array_unshift( $buttons, 'styleselect' );
    return $buttons;
  }
  add_filter( 'mce_buttons_2', 'themeit_mce_buttons_2' );
  function themeit_tiny_mce_before_init( $settings ) {
    $settings['theme_advanced_blockformats'] = 'p,a,div,span,h1,h2,h3,h4,h5,h6,tr,';
    $style_formats = array(
        array( 'title' => 'Accordion Title', 'block' => 'div',  'classes' => 'subheader' ),
        array( 'title' => 'Subheader', 'inline' => 'span',  'classes' => 'subheader' ),
        array( 'title' => 'image+text', 'block' => 'div',  'classes' => 'blocktext' ),
        array( 'title' => 'Red Text', 'inline' => 'span',  'classes' => 'red' ),
        array( 'title' => 'Yellow Text', 'inline' => 'span',  'classes' => 'yellow' ),


        array( 'title' => 'Button', 'inline' => 'span',  'classes' => 'custom-button' ),
    );
    $settings['style_formats'] = json_encode( $style_formats );
    return $settings;
  }
  add_filter( 'tiny_mce_before_init', 'themeit_tiny_mce_before_init' );


*/
function remove_menus () {
global $menu;
  $restricted = array( __('Media'), __('Links'), __('Settings'), __('Comments'));
  end ($menu);
  while (prev($menu)){
    $value = explode(' ',$menu[key($menu)][0]);
    if(in_array($value[0] != NULL?$value[0]:"" , $restricted)){unset($menu[key($menu)]);}
  }
}
add_action('admin_menu', 'remove_menus');

//////////////////////////  FOR BLOG CALLOUT : PULLS LATESTS POSTS WITH THE CATEGORY OF NEWS


function recent_posts_function($atts){
   extract(shortcode_atts(array(
      'posts' => 1,
   ), $atts));

   $return_string = '<ul>';
   query_posts(array('orderby' => 'date', 'order' => 'DESC' , 'showposts' => $posts));
   if (have_posts()) :
      while (have_posts()) : the_post();
         $return_string .= '<li><a href="'.get_permalink().'">'.get_the_title().'</a></li>';
      endwhile;
   endif;
   $return_string .= '</ul>';

   wp_reset_query();
   return $return_string;
}

function register_shortcodes(){
   add_shortcode('recent-posts', 'recent_posts_function');
}

add_action( 'init', 'register_shortcodes');

?>