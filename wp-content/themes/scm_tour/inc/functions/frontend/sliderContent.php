<?php function SliderContent(){
/*
  $args = array( 'post_type' => 'Slides');
  $loop = new WP_Query( $args );

    while ( $loop->have_posts() ) : $loop->the_post();

      if(has_post_thumbnail()) {

        the_post_thumbnail('full', array('data-caption'=>''));

        echo '<span class="orbit-caption"><div class="caption-inner" id="htmlCaption">';

          the_content();

        echo '</div></span>';

      } else {

      }

    endwhile;
*/

  if ( function_exists( 'ot_get_option' ) ) {
    /* get the slider array */
    $slides = ot_get_option( 'super_slider', array() );
    if ( ! empty( $slides ) ) {
      echo '<div id="slider">';
      $i = 0;

        foreach( $slides as $slide ) {
          $i++;
          echo '<img src="' . $slide['image'] . '" data-caption="#slide' . $i . '"/>';
        }
      unset($slide);
      echo '</div>';
      $i = 0;
        foreach( $slides as $slide ) {
          $i++;
          echo '<span class="orbit-caption" id="slide' . $i . '">';
          echo '<div class="caption-inner row"><h3>' . $slide['title'] . '</h3></div>';
          echo '</span>';
        }
    }
  }
 } ?>