<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @package WordPress
 * @subpackage Twenty_Ten
 * @since Twenty Ten 1.0
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>><head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<title>
<?php
	/*
	 * Print the <title> tag based on what is being viewed.
	 */
	global $page, $paged;

	wp_title( '|', true, 'right' );

	// Add the blog name.
	bloginfo( 'name' );

	// Add the blog description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		echo " | $site_description";

	// Add a page number if necessary:
	if ( $paged >= 2 || $page >= 2 )
		echo ' | ' . sprintf( __( 'Page %s', 'twentyten' ), max( $paged, $page ) );

	?>
</title>
<link rel="stylesheet" href="http://digitalkickoff.com/parisgordon.com/wp-content/themes/pg/style.css" type="text/css" media="all" />
<link rel="stylesheet" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.16/themes/base/jquery-ui.css" type="text/css" media="all" />
<link rel="stylesheet" href="http://static.jquery.com/ui/css/demo-docs-theme/ui.theme.css" type="text/css" media="all" />
<script src="<?php bloginfo( 'template_url' ); ?>/js/jquery-1.6.2.min.js" type="text/javascript"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.16/jquery-ui.min.js" type="text/javascript"></script>

<!--jQuery Library
<script type="text/javascript" src="<?php bloginfo( 'template_url' ); ?>/js/jquery-1.4.2.min.js" ></script>-->
<!--Dropdown Menu-->
<script type="text/javascript" src="<?php bloginfo( 'template_url' ); ?>/js/superfish.js"></script> 
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<script type="text/javascript" src="<?php bloginfo( 'template_url' ); ?>/js/cloud-zoom.1.0.2.js"></script> 
<script type="text/javascript" src="<?php bloginfo( 'template_url' ); ?>/js/cloud-zoom.1.0.2.min.js"></script> 
<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'template_url' ); ?>/js/cloud-zoom.css " />



<?php
	/* We add some JavaScript to pages with the comment form
	 * to support sites with threaded comments (when in use).
	 */
	if ( is_singular() && get_option( 'thread_comments' ) )
		wp_enqueue_script( 'comment-reply' );

	/* Always have wp_head() just before the closing </head>
	 * tag of your theme, or you will break many plugins, which
	 * generally use this hook to add elements to <head> such
	 * as styles, scripts, and meta tags.
	 */
	wp_head();
?>

<script> 
$(document).ready(function(){
  $("#top-menu li a").wrapInner("<span><span>" + "</span></span>");
});
</script>
</head>
<body  <?php $bg_class="";  if(is_front_page() || is_page("8") || is_page("188") || is_page("96")) $bg_class="home-bg"; elseif (is_page("120") || is_page("127") || is_page("133")) $bg_class="inner-bg"; elseif (is_page("133")) $bg_class="blue-bg"; else $bg_class="inner-bg2"; ?>  class="<?php  echo $bg_class; ?>" >
<div id="main-container">
<div id="header">
<div id="header_inner" >
  <div id="logo"> <a href="<?php echo home_url( '/' ); ?>/?page_id=8" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"> <img src="<?php bloginfo( 'template_url' ); ?>/image/logo.png" alt="site Logo" /> </a></div> </div>
  <div class="wrapper-center">
    <div id="top-menu">
      <?php wp_nav_menu( array( 'container_class' => 'menu-header','menu_class' =>'sf-menu', 'theme_location' => 'primary' ) ); ?>
    </div>
  </div>
  <div class="clear"></div>
</div>