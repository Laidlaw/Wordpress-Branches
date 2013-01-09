<?php


// Alters the default loop for the home page only.
function scm_before_page_content() {
}

//////////// HEADER
function scm_logo_and_nav() { ?>
<div class="header_wrap">
  <div class="row">   
        <h1 class="logo fl"><a href="<?php echo home_url( '/' ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
      <?php wp_nav_menu( array( 'container' => 'false ', 'menu_class' => 'nav nav--block fr', 'theme_location' => 'primary' ) ); ?>
      <?php // Ωget_search_form( $echo ); ?>
  </div>
</div>
<!-- End Header and Nav -->
<?php }

//////////// BODY

function scm_after_nav() {
  if (is_page("home")) {
    echo '<div class="one-whole"><div id="slider">';
    SliderContent();
    echo '</div></div>';
  }
}

function scm_main_class_filter() { echo "row prologue"; }

function scm_should_this_get_sidebar() {
		echo " ";
	     }

function scm_loop_index_content() { ?>

<?php }


// FOOTER //////////////////////////////////////////////////

function scm_before_footer() {
if (is_page("home")) {
  ?>

	<?php } }


function scm_footer() { ?>

<div class="row">
    <?php wp_nav_menu( array( 'container' => 'false ', 'menu_class' => 'nav fl', 'theme_location' => 'primary' ) ); ?>
    <div class="logo fr">
      <h1><a href="#">Logo</a></h1>
    </div>
</div>

	<?php }


function scm_after_footer() {
  if (is_page("home")) {
    // include 'tour_guide.php';
  }
}



// SHORTCODES  /////////////////////////////////////////////////////


?>