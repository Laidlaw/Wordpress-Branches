<?php
// Custom CSS for the login page
// Create wp-login.css in your theme folder
  function LoginCSS() {
    echo '<link rel="stylesheet" type="text/css" href="'.get_bloginfo('stylesheet_directory').'/wp-login.css"/>';
  }
  add_action('login_head', 'LoginCSS');

?>