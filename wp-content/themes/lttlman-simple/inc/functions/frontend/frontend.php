<?php


// Alters the default loop for the home page only.
function scm_before_page_content() {
}

//////////// HEADER
function scm_logo_and_nav() { ?>
<div class="header_wrap">
  <div class="row">   
        <h1 class="menu-link fl"><a href="<?php echo home_url( '/' ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
      <?php wp_nav_menu( array( 'container' => 'false ', 'menu_class' => 'nav nav--block fr', 'theme_location' => 'primary' ) ); ?>
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

<!-- Call to Action Panel -->
<div class="one-whole callout">
  <div class="row">
  	<ul class="gw">
      <li class="g one-third" id="numero1">
        <h3>Content</h3>
        <img src="http://placehold.it/400x300&text=[img]" />
        <p>Bacon ipsum dolor sit amet nulla ham qui sint exercitation eiusmod commodo, chuck duis velit. Aute in reprehenderit, dolore aliqua non est magna in labore pig pork biltong. Eiusmod swine spare ribs reprehenderit culpa. Boudin aliqua adipisicing rump corned beef.</p>
          <a class="fr">Read More</a>
      </li>

      <li class="g one-third" id="numero2">
        <h3>Content</h3>
        <img src="http://placehold.it/400x300&text=[img]" />
        <p>Bacon ipsum dolor sit amet nulla ham qui sint exercitation eiusmod commodo, chuck duis velit. Aute in reprehenderit, dolore aliqua non est magna in labore pig pork biltong. Eiusmod swine spare ribs reprehenderit culpa. Boudin aliqua adipisicing rump corned beef.</p>
      </li>

      <li class="g one-third" id="numero3">

      <?php if(function_exists( 'ot_get_option' )) {
        $scm_email_address = ot_get_option( 'scm_email_address' );
        $scm_phone_number = ot_get_option( 'scm_phone_number' );
        $scm_linkedin = ot_get_option( 'scm_linkedin' );
      }?>

        <h3>Content</h3>
        <img src="http://placehold.it/400x300&text=[img]" />
        <p>Bacon ipsum dolor sit amet nulla ham qui sint exercitation eiusmod commodo, chuck duis velit. Aute in reprehenderit, dolore aliqua non est magna in labore pig pork biltong. Eiusmod swine spare ribs reprehenderit culpa. Boudin aliqua adipisicing rump corned beef.</p>
        <a href="mailto:<?php echo $scm_email_address; ?>" class="email">Email Address</a>
      </li>

    </ul>
  </div><!-- end row -->
</div>
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