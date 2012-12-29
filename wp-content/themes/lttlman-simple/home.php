<?php
/*
Template Name: Home

*/
get_header(); ?>
<div class="row">
    <div class="gw">
      <div class="two-thirds g" id="content">

            <?php query_posts('post_type=post&post_status=publish&posts_per_page=10&paged='. get_query_var('paged')); ?>

      <?php if( have_posts() ): ?>

            <?php while( have_posts() ): the_post(); ?>

          <div id="post-<?php get_the_ID(); ?>" <?php post_class(); ?>>

              <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail(); ?></a>

                    <h1><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>



        <?php the_excerpt(__('Continue reading »','example')); ?>

                </div><!-- /#post-<?php get_the_ID(); ?> -->

            <?php endwhile; ?>

        <div class="navigation">
          <span class="newer"><?php previous_posts_link(__('« Newer','example')) ?></span> <span class="older"><?php next_posts_link(__('Older »','example')) ?></span>
        </div><!-- /.navigation -->

      <?php else: ?>

        <div id="post-404" class="noposts">

            <p><?php _e('None found.','example'); ?></p>

          </div><!-- /#post-404 -->

      <?php endif; wp_reset_query(); ?>

      </div><!-- /#content -->
    <div class="one-third g sidebar"> <!-- .block-list -->

         <?php dynamic_sidebar( 'Right Sidebar' ); ?>

    </div>
  </div>
</div><!-- row -->
<?php get_footer() ?>