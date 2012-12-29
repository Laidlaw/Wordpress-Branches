<?php function SliderContent(){

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

} ?>