<?php

function add_post_type($name, $args = array()) {
	add_action('init', function() use($name, $args) {
		$upper = ucwords($name);
		$name = strtolower(str_replace(' ', '_', $name));
		
		$args = array_merge(
				array(
					'public' => true,
					'label' => "$upper" . 's',
					'labels' => array('add_new_item' => "Add New $upper"),
					'supports' => array('title', 'editor', 'comments', 'thumbnail')
						
					),
					$args
			);


		register_post_type($name, $args );

	});	

}

function add_taxonomy($name, $post_type, $args = array() ) {
	add_action('init', function() use($name, $post_type, $args) {
		$upper = ucwords($name);
		$name = strtolower(str_replace(' ', '_', $name));
		
		$args = array_merge(
				array(
					
					'label' => "$upper"	
					),
					$args
			);


		register_taxonomy($name, $post_type, $args);

	});	
	
}
/*
add_action('add_meta_boxes', function() {
	add_meta_box(
			'awl_snippet_info',
			'Snippet Info',
			'awl_snippet_info_cb',
			'snippet',
			'normal',
			'high'
			#$args
		);
});
function awl_snippet_info_cb() {
	global $post;
	//$url = get_post_custom($post->ID);
	$url = get_post_meta($post->ID, 'awl_associated_url', true);
	wp_nonce_field(__FILE__, 'awl_nonce');
	?>

	<label for="awl_associated_url">Associated URL:</label>
	<input type="text" name="awl_associated_url" id="" value="<?php echo $url; ?>" class="widefat">
	<?php
}

add_action('save_post', function() {
	global $post;
	if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ) return;
	// Security Check NONCE
	if ( $_POST && !wp_verify_nonce($_POST['awl_nonce'], __FILE__) ) {
		return;
	}
	if ( isset($_POST['awl_associated_url']) ) {
			update_post_meta($post->ID, 'awl_associated_url', $_POST['awl_associated_url']);
	}
	
});
*/

?>