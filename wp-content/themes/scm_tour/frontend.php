<?php


// Alters the default loop for the home page only.
function scm_before_page_content() {
}

//////////// HEADER
function scm_logo_and_nav() { ?>

<div class="row">
    <div class="logo fl">
      <h1 class="text-center"><a href="<?php echo site_url(); ?>">Logo</a></h1>
    </div>
    <?php wp_nav_menu( array( 'container' => 'false ', 'menu_class' => 'nav nav--block fr', 'theme_location' => 'primary' ) ); ?>
</div>
<!-- End Header and Nav -->
<?php }

//////////// BODY

function scm_after_nav() {
  if (is_page("home")) {
    echo '<div class="one-whole">';
    SliderContent();
    echo '</div>';
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
if (is_page("home")) { ?>
<?php
//var_dump( get_field('wp_callout_order') );

$posts = get_field('wp_callout_order');
if( $posts ): ?>
<div class="one-whole callout">
  <div class="row">
    <ul class="gw">
      <?php foreach( $posts as $post): // variable must be called $post (IMPORTANT) ?>
        <?php setup_postdata($post);
          $callout_title = get_the_title($post->ID); // must include $post->ID get_the_title();
          $callout_thumb = get_the_post_thumbnail($post->ID, 'callout_thumb'); ?>
        <li class="g one-third">
          <h3 class="text-center"> <?php echo $callout_title; ?></h3>
          <article>
            <?php echo $callout_thumb; ?>
            <?php the_content(); ?>
          </article>
        </li>
        <?php endforeach; ?>

      <li class="g one-third">

      <?php if(function_exists( 'ot_get_option' )) {
        $scm_email_address = ot_get_option( 'scm_email_address' );
        $scm_phone_number = ot_get_option( 'scm_phone_number' );
        $scm_linkedin = ot_get_option( 'scm_linkedin' );
        $scm_street_address = ot_get_option( 'scm_street_address' );
        $scm_google_map = ot_get_option( 'google_static_map');
      }?>

        <h3 class="text-center" >Contact</h3>
        <img src="<?php echo $scm_google_map; ?>" />
        <p><?php echo $scm_street_address; ?></p>
        <a href="mailto:<?php echo $scm_email_address; ?>" class="email">Email Address</a>
      </li>

    <?php wp_reset_postdata(); // IMPORTANT - reset the $post object so the rest of the page works correctly ?>
    <?php endif; ?>
    </ul>
  </div>
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
    include dirname(__file__) . '/inc/functions/frontend/tour_guide.php';
  }
}



// SHORTCODES  /////////////////////////////////////////////////////


?>