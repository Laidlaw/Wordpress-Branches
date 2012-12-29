<?php

if ( ! isset( $content_width ) )
  $content_width = 640; /* pixels */
if ( ! function_exists( 'lttlman_setup' ) ) :

/**
 * OptionTree Setup.
 */
add_filter( 'ot_show_pages', '__return_true' );
add_filter( 'ot_show_new_layout', '__return_true' );
add_filter( 'ot_theme_mode', '__return_true' );

include_once(get_template_directory().'/option-tree/ot-loader.php');
// include_once(get_stylesheet_directory(). '/inc/options/skeleton.php' );


// adaptiveImages is an experiment. find out more here: http://adaptive-images.com/
function adaptiveImages() { ?>
    <script>document.cookie='resolution='+Math.max(screen.width,screen.height)+'; path=/';</script>
<?php }
add_action('wp_head', 'adaptiveImages', 0);

function lttlman_setup() {

  //require( get_template_directory() . '/inc/template-tags.php' );
  //require( get_template_directory() . '/inc/extras.php' );

//include dirname(__file__) . '/functions/admin_customizations.php';
//include dirname(__file__) . '/inc/functions/backend/custom_pointer.php';
  //////// Custom Theme Options ////////////
  //require( get_template_directory() . '/inc/theme-options/theme-options.php' );

  add_theme_support( 'automatic-feed-links' );
  add_theme_support( 'post-thumbnails' );
  add_theme_support( 'post-formats', array( 'aside', ) );

  register_nav_menus( array(
    'primary' => __( 'Primary Menu', 'lttlman' ),
  ) );

}

endif; // lttlman_setup
add_action( 'after_setup_theme', 'lttlman_setup' );

/////////// Implement the Custom Header feature ////////////////
//require( get_template_directory() . '/inc/custom-header.php' );


function lttlman_widgets_init() {
  register_sidebar( array(
    'name' => __( 'Sidebar', 'lttlman' ),
    'id' => 'sidebar-1',
    'before_widget' => '<aside id="%1$s" class="widget %2$s">',
    'after_widget' => '</aside>',
    'before_title' => '<h1 class="widget-title">',
    'after_title' => '</h1>',
  ) );
}
add_action( 'widgets_init', 'lttlman_widgets_init' );


/////////////// Enqueue scripts and styles /////////////////

function lttlman_scripts() {
  //wp_enqueue_style( 'style', get_stylesheet_uri() );

  //wp_enqueue_script( 'small-menu', get_template_directory_uri() . '/inc/js/small-menu.js', array( 'jquery' ), '20120206', true );
  wp_enqueue_script( 'js-cookie', get_stylesheet_directory_uri() . '/inc/js/jquery.cookie.js', array( 'jquery' ), '20120206', true );
  wp_enqueue_script( 'modernizr', get_stylesheet_directory_uri() . '/inc/js/modernizr.mq.js', array( 'jquery' ), '20120206', true );
  wp_enqueue_script( 'joyride', get_stylesheet_directory_uri() . '/inc/js/jquery.joyride-2.0.2.js', array( 'jquery' ), '20120206', true );
  wp_enqueue_script( 'jRespond', get_stylesheet_directory_uri() . '/inc/js/jRespond.min.js', array( 'jquery' ), '20120206', true );
  wp_enqueue_script( 'orbit', get_stylesheet_directory_uri() . '/inc/js/orbit.js', array( 'jquery' ), '20120206', true );
  wp_enqueue_script( 'script', get_stylesheet_directory_uri() . '/inc/js/script.js', array( 'jquery' ), '20120206', true );

  if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
    wp_enqueue_script( 'comment-reply' );
  }

  if ( is_singular() && wp_attachment_is_image() ) {
    wp_enqueue_script( 'keyboard-image-navigation', get_template_directory_uri() . '/js/keyboard-image-navigation.js', array( 'jquery' ), '20120202' );
  }

}
add_action( 'wp_enqueue_scripts', 'lttlman_scripts' );


// Call the google CDN version of jQuery for the frontend
// Make sure you use this with wp_enqueue_script('jquery'); in your header
if (!is_admin()) add_action("wp_enqueue_scripts", "my_jquery_enqueue", 11);
function my_jquery_enqueue() {
   wp_deregister_script('jquery');
   wp_register_script('jquery', "http" . ($_SERVER['SERVER_PORT'] == 443 ? "s" : "") . "://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js", false, null);
   wp_enqueue_script('jquery');
}

//////////// FILTERS & HOOKS /////////////
include dirname(__file__) . '/inc/functions/backend/custom_post_types.php';
include dirname(__file__) . '/inc/functions/frontend/image_downsize.php';
include dirname(__file__) . '/inc/functions/frontend/sliderContent.php';
include dirname(__file__) . '/inc/functions/frontend/frontend.php';


?>