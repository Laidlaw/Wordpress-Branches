<?php
if( is_admin() ) {

	function wpsc_cf_admin_menu() {

		add_options_page( __( 'Custom Fields for WP e-Commerce','wpsc_cf' ),__( 'Custom Fields','wpsc_cf' ),'manage_options','wpsc_cf','wpsc_cf_html_page' );

	}
	add_action( 'admin_menu','wpsc_cf_admin_menu' );

	function wpsc_cf_init_meta_box() {

		$pagename = 'wpsc-product';
		add_meta_box( 'wpsc_cf_meta_box',__( 'Custom Fields','wpsc_cf' ),'wpsc_cf_meta_box',$pagename,'normal','high' );

	}
	add_action( 'admin_menu','wpsc_cf_init_meta_box' );

	function wpsc_cf_add_to_product_form( $order ) {

		if( array_search( 'wpsc_cf_meta_box',(array)$order ) === false )
			$order[] = 'wpsc_cf_meta_box';
		return $order;

	}
	add_filter( 'wpsc_products_page_forms','wpsc_cf_add_to_product_form' );

	function wpsc_cf_meta_box() {

		global $post, $wpdb, $closed_postboxes;

		$product_data = get_post_custom( $post->ID );
		$product_data['meta'] = maybe_unserialize( $product_data );
		foreach( $product_data['meta'] as $meta_key => $meta_value )
			$product_data['meta'][$meta_key] = $meta_value[0];
		$product_meta = maybe_unserialize( $product_data["_wpsc_product_metadata"][0] );

		$wpsc_cf_data = unserialize( get_option( 'wpsc_cf_data' ) );
		if( $wpsc_cf_data ) {
			$i = 0;
			foreach( $wpsc_cf_data as $wpsc_cf_field ) { ?>
			<label><?php echo $wpsc_cf_field['name']; ?>:</label><br />
<?php
				switch( $wpsc_cf_field['type'] ) {

					case 'input':
						$output = '
						<input type="text" id="wpsc_cf_product_' . $i . '" name="meta[' . WPSC_META_PREFIX . $wpsc_cf_field['slug'] . ']" value="' . get_product_meta( $post->ID,$wpsc_cf_field["slug"],true ) . '" size="32" />
						<span class="howto">&lt;?php echo get_product_meta( wpsc_the_product_id(),\'' . $wpsc_cf_field["slug"] . '\',true ); ?&gt;</span>';
						break;

					case 'textarea':
						$output = '
						<textarea id="wpsc_cf_product_' . $i . '" name="meta[' . WPSC_META_PREFIX . $wpsc_cf_field['slug'] . ']" rows="3" cols="30">' . get_product_meta( $post->ID,$wpsc_cf_field["slug"],true ) . '</textarea>
						<span class="howto">&lt;?php echo wpautop( get_product_meta( wpsc_the_product_id(),\'' . $wpsc_cf_field["slug"] . '\',true ) ); ?&gt;</span>';
						break;

				}
				echo $output; ?>
			<br />
<?php
				$i++;
			}
		}
	}

}
?>