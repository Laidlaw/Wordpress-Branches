<?php


// SLIDES ////////////////////

  add_action( 'after_setup_theme', 'custom_post_setup' );

  function custom_post_setup() {

/*
  add_action('init', 'Slides');

  function Slides(){
    $Slides_args = array(
      'label' => __('Slides'),
      'singular_label' => __('Slide'),
      'public'  =>  true,
      'show_ui' =>  true,
      'capability_type' =>  'post',
      'hierarchical'  =>  false,
      'rewrite' =>  true,
      'supports'  =>  array('title', 'editor','page-attributes','thumbnail')
      );
    register_post_type('Slides', $Slides_args);
  }
*/

  // CALLOUTS ////////////////////

  register_post_type('callouts', array( 'label' => 'Callouts','description' => '','public' => true,'show_ui' => true,'show_in_menu' => true,'capability_type' => 'post','hierarchical' => false,'rewrite' => array('slug' => ''),'query_var' => true,'supports' => array('title','editor','excerpt','custom-fields','thumbnail','page-attributes',),'labels' => array (
      'name' => 'Callouts',
      'singular_name' => 'Callout',
      'menu_name' => 'Callouts',
      'add_new' => 'Add Callout',
      'add_new_item' => 'Add New Callout',
      'edit' => 'Edit',
      'edit_item' => 'Edit Callout',
      'new_item' => 'New Callout',
      'view' => 'View Callout',
      'view_item' => 'View Callout',
      'search_items' => 'Search Callouts',
      'not_found' => 'No Callouts Found',
      'not_found_in_trash' => 'No Callouts Found in Trash',
      'parent' => 'Parent Callout',
    ),
  'taxonomies' => array('category', 'post_tag') // this is IMPORTANT
  )

  );
  add_action('init', 'callout_add_default_boxes');

  function callout_add_default_boxes() {
      register_taxonomy_for_object_type('category', 'callouts');
  }
}
?>