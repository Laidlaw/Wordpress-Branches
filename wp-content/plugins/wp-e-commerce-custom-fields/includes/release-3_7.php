<?php
if( is_admin() ) {

	function wpsc_cf_add_modules_admin_pages($page_hooks, $base_page) {

		$page_hooks[] = add_submenu_page( $base_page,__('Custom Fields for WP e-Commerce','wpsc_cf' ),__('Custom Fields','wpsc_cf'),7,'wpsc_cf','wpsc_cf_html_page' );
		return $page_hooks;

	}
	add_filter( 'wpsc_additional_pages','wpsc_cf_add_modules_admin_pages',10,2 );

	function wpsc_cf_init_meta_box() {

		$pagename = 'store_page_wpsc-edit-products';
		add_meta_box( 'wpsc_cf_meta_box',__( 'Custom Fields','wpsc_cf' ),'wpsc_cf_meta_box',$pagename,'normal','high' );

	}
	add_action( 'admin_menu','wpsc_cf_init_meta_box' );

	function wpsc_cf_add_to_product_form( $order ) {

		if( array_search( 'wpsc_cf_meta_box',(array)$order ) === false )
			$order[] = 'wpsc_cf_meta_box';
		return $order;

	}
	add_filter( 'wpsc_products_page_forms','wpsc_cf_add_to_product_form' );

	function wpsc_cf_meta_box( $product_data = array() ) {

		global $wpdb, $closed_postboxes;

		$wpsc_cf_data = unserialize( get_option( 'wpsc_cf_data' ) ); ?>
<div id="wpsc_product_custom_fields" class="postbox <?php echo ( ( array_search('wpsc_cf_meta_box', (array)$product_data['closed_postboxes']) !== false) ? 'closed"' : '' ); ?>" <?php echo ( ( array_search( 'wpsc_cf_meta_box',(array)$product_data['hidden_postboxes'] ) !== false ) ? ' style="display: none;"' : '' ); ?>>
	<h3 class="hndle"><?php _e( 'Custom Fields','wpsc_cf' ); ?></h3>
	<div class="inside">
		<div>
			<p><span class="howto"><?php _e( 'Custom Fields','wpsc_cf' ); ?></span></p>
<?php
		if( $wpsc_cf_data ) {
			$i = 0;
			foreach( $wpsc_cf_data as $wpsc_cf_field ) { ?>
			<label><?php echo $wpsc_cf_field['name']; ?>:</label><br />
<?php
				switch( $wpsc_cf_field['type'] ) {

					case 'input':
						$output = '
						<input type="text" id="wpsc_cf_product_' . $i . '" name="productmeta_values[' . $wpsc_cf_field['slug'] . ']" value="' . get_product_meta( $product_data['id'],$wpsc_cf_field["slug"],true ) . '" size="32" />
						<span class="howto">&lt;?php echo get_product_meta( wpsc_the_product_id(),\'' . $wpsc_cf_field["slug"] . '\',true ); ?&gt;</span>';
						break;

					case 'textarea':
						$output = '
						<textarea id="wpsc_cf_product_' . $i . '" name="productmeta_values[' . $wpsc_cf_field['slug'] . ']" rows="3" cols="30">' . get_product_meta( $product_data['id'],$wpsc_cf_field["slug"],true ) . '</textarea>
						<span class="howto">&lt;?php echo wpautop( get_product_meta( wpsc_the_product_id(),\'' . $wpsc_cf_field["slug"] . '\',true ) ); ?&gt;</span>';
						break;

				}
				echo $output; ?>
			<br />
<?php
				$i++;
			}
		} ?>
		</div>
	</div>
</div>
<?php
	}

}
?>