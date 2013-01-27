<?php
/*
Plugin Name: Custom Fields for WP e-Commerce
Plugin URI: http://www.visser.com.au/wp-ecommerce/plugins/custom-fields/
Description: Add and manage custom Product meta details within WP e-Commerce.
Version: 1.1
Author: Visser Labs
Author URI: http://www.visser.com.au/about/
Contributor: Ryan Waggoner
Contributor URI: http://ryanwaggoner.com/
License: GPL2
*/

load_plugin_textdomain( 'wpsc_cf',false,dirname( plugin_basename(__FILE__) ) . '/languages' );

include_once( 'includes/functions.php' );

switch( wpsc_get_major_version() ) {

	case '3.7':
		include_once( 'includes/release-3_7.php' );
		break;

	case '3.8':
		include_once( 'includes/release-3_8.php' );
		break;

}

if( is_admin() ) {

	function wpsc_cf_admin_init() {

		global $wpsc_cf_pluginname, $wpsc_cf_menuname, $wpsc_cf_plugindir, $wpsc_cf_localversion;

		$wpsc_cf_pluginname = 'Custom Fields for WP e-Commerce';
		$wpsc_cf_menuname = 'Custom Fields';
		$wpsc_cf_plugindir = basename( dirname( __FILE__ ) );
		$wpsc_cf_localversion = '1.1';

	}
	add_action( 'admin_init','wpsc_cf_admin_init' );

	function wpsc_cf_check_plugin_version( $plugin ) {

		global $wpsc_cf_pluginname, $wpsc_cf_plugindir, $wpsc_cf_localversion;
		if( strpos( $wpsc_cf_plugindir . '/custom-fields.php',$plugin ) !== false ) {
			$check = wp_remote_fopen( 'http://www.visser.com.au/?plugin_sku=CFWPE' );
			if( $check ) {
				$status = explode( '@',$check );
				if( ( version_compare( strval( $status[0] ),strval( $wpsc_cf_localversion ),'>' ) == 1 ) ) {
					echo '<td colspan="5" class="plugin-update" style="line-height:1.2em; font-size:11px; padding:1px;"><div style="color:#000; font-weight:bold; margin:4px; padding:6px 5px; background-color:#fffbe4; border-color:#dfdfdf; border-width:1px; border-style:solid; -moz-border-radius:5px; -khtml-border-radius:5px; -webkit-border-radius:5px; border-radius:5px;">' . __( "There is a new version of " . $wpsc_cf_pluginname . " available.","wpsc_cf" ) . ' <a href="' . $status[1] . '">' . __( "View version ","wpsc_cf" ) . $status[0] . __( " details","wpsc_cf" ) . '</a>.</div></td>';
				} else {
					return;
				}
			}
		}

	}
	add_action( 'after_plugin_row','wpsc_cf_check_plugin_version' );

	function wpsc_cf_html_page() {

		global $wpdb, $wpsc_cf_menuname;

		$action = $_GET['action'];
		if( !$action )
			$action = $_POST['action']; ?>
<div class="wrap">
	<div id="icon-tools" class="icon32"><br /></div>
	<h2><?php echo $wpsc_cf_menuname; ?>
		<a href="admin.php?page=wpsc_cf&action=new" class="button add-new-h2"><?php _e( 'Add New','wpsc_cf' ); ?></a>
	</h2>
<?php
		switch( $action ) {

			case 'delete':
				$wpsc_cf_id = $_GET['id'];
				$wpsc_cf_data = unserialize( get_option( 'wpsc_cf_data' ) );
				unset( $wpsc_cf_data[$wpsc_cf_id] );
				$wpsc_cf_data = serialize( $wpsc_cf_data );
				update_option( 'wpsc_cf_data',$wpsc_cf_data );
				unset( $wpsc_cf_data );
				$message = __( 'Custom field deleted','wpsc_cf' );
				$output = '<div class="updated settings-error"><p><strong>' . $message . '.</strong></p></div>';
				echo $output;
				wpsc_cf_manage_form();
				break;

			case 'edit-confirm':
				$wpsc_cf_id = $_POST['custom-field-id'];
				$wpsc_cf_name = $_POST['custom-field-name'];
				$wpsc_cf_slug = $_POST['custom-field-slug'];
				$wpsc_cf_type = $_POST['custom-field-type'];
				if( isset( $wpsc_cf_id ) && $wpsc_cf_name && $wpsc_cf_slug && $wpsc_cf_type ) {
					$wpsc_cf_description = $_POST['custom-field-description'];
					$wpsc_cf_field = array();
					$wpsc_cf_field[] = array(
						'name' => $wpsc_cf_name,
						'slug' => $wpsc_cf_slug,
						'type' => $wpsc_cf_type,
						'description' => $wpsc_cf_description
					);
					$wpsc_cf_data = unserialize( get_option( 'wpsc_cf_data' ) );
					$wpsc_cf_data[$wpsc_cf_id]['name'] = $wpsc_cf_name;
					$wpsc_cf_data[$wpsc_cf_id]['slug'] = $wpsc_cf_slug;
					$wpsc_cf_data[$wpsc_cf_id]['type'] = $wpsc_cf_type;
					$wpsc_cf_data[$wpsc_cf_id]['description'] = $wpsc_cf_description;
					$wpsc_cf_data = serialize( $wpsc_cf_data );
					update_option( 'wpsc_cf_data',$wpsc_cf_data );
					unset( $wpsc_cf_data );
					$message = __( 'Custom field updated','wpsc_cf' );
					$output = '<div class="updated settings-error"><p><strong>' . $message . '.</strong></p></div>';
				} else {
					$message = '<strong>' . __( "ERROR","wpsc_cf" ) . '</strong>: ' . __( "A required field was not filled. Please ensure required fields are filled.","wpsc_cf" );
					$output = '<div class="error settings-error"><p>' . $message . '</strong></p></div>';
				}
				echo $output;
				wpsc_cf_manage_form();
				break;

			case 'new-confirm':
				$wpsc_cf_name = $_POST['custom-field-name'];
				$wpsc_cf_slug = $_POST['custom-field-slug'];
				$wpsc_cf_type = $_POST['custom-field-type'];
				if( $wpsc_cf_name && $wpsc_cf_slug && $wpsc_cf_type ) {
					$wpsc_cf_description = $_POST['custom-field-description'];
					if( get_option( 'wpsc_cf_data' ) ) {
						$wpsc_cf_data = unserialize( get_option( 'wpsc_cf_data' ) );
						$wpsc_cf_field = array(
							'name' => $wpsc_cf_name,
							'slug' => $wpsc_cf_slug,
							'type' => $wpsc_cf_type,
							'description' => $wpsc_cf_description
						);
						$wpsc_cf_data[] = $wpsc_cf_field;
						$wpsc_cf_data = serialize( $wpsc_cf_data );
						update_option( 'wpsc_cf_data',$wpsc_cf_data );
					} else {
						$wpsc_cf_data = array();
						$wpsc_cf_data[] = array(
							'name' => $wpsc_cf_name,
							'slug' => $wpsc_cf_slug,
							'type' => $wpsc_cf_type,
							'description' => $wpsc_cf_description
						);
						$wpsc_cf_data = serialize( $wpsc_cf_data );
						update_option( 'wpsc_cf_data',$wpsc_cf_data );
					}
					unset( $wpsc_cf_data );
					$message = __( 'Custom field saved','wpsc_cf' );
					$output = '<div class="updated settings-error"><p><strong>' . $message . '.</strong></p></div>';
				} else {
					$message = '<strong>' . __( "ERROR","wpsc_cf" ) . '</strong>: ' . __( "A required field was not filled. Please ensure required fields are filled.","wpsc_cf" ) . '.</strong>';
					$output = '<div class="error settings-error"><p>' . $message . '</p></div>';
				}
				echo $output;
				wpsc_cf_manage_form();
				break;

			case 'edit':
			case 'new':
				if( $action == 'edit' ) {
					$wpsc_cf_id = $_GET['id'];
					$wpsc_cf_data = unserialize( get_option( 'wpsc_cf_data' ) );
					$wpsc_cf_field = $wpsc_cf_data[$wpsc_cf_id];
				} ?>
	<div id="col-container">
		<div id="col-left">
			<div class="col-wrap">
				<div class="form-wrap">
<?php
				if( $action == 'edit' )
					$title = __( 'Edit Custom Field','wpsc_cf' );
				else
					$title = __( 'Add New Custom Field','wpsc_cf' );
				$output = '<h3>' . $title . '</h3>';
				$options = array();
				$options[] = array( 'name' => 'input', 'label' => 'Input' );
				$options[] = array( 'name' => 'textarea', 'label' => 'Textarea' );
				echo $output; ?>
					<form method="post" action="admin.php?page=wpsc_cf" class="validate" >
						<div class="form-field form-required">
							<label><?php _e( 'Name','wpsc_cf' ); ?><span class="description"> (<?php _e( 'required','wpsc_cf' ); ?>)</span></label>
							<input type="text" name="custom-field-name" value="<?php echo $wpsc_cf_field['name']; ?>" />
							<p><?php _e( 'The name is how it appears on your site','wpsc_cf' ); ?>.</p>
						</div>
						<div class="form-field form-required">
							<label><?php _e( 'Slug','wpsc_cf' ); ?><span class="description"> (<?php _e( 'required','wpsc_cf' ); ?>)</span></label>
							<input type="text" name="custom-field-slug" value="<?php echo $wpsc_cf_field['slug']; ?>" />
							<p><?php _e( 'The "slug" is the URL-friendly version of the name. It is usually all lowercase and contains only letters, numbers, and hyphens','wpsc_cf' ); ?>.</p>
						</div>
						<div class="form-field form-required">
							<label><?php _e( 'Field Type','wpsc_cf' ); ?><span class="description"> (<?php _e( 'required','wpsc_cf' ); ?>)</span></label>
							<select name="custom-field-type">
<?php foreach( $options as $option ) { ?>
								<option value="<?php echo $option['name']; ?>"<?php if( $option['name'] == $wpsc_cf_field['slug'] ) echo ' selected="selected"'; ?>><?php echo $option['label']; ?></option>
<?php } ?>
							</select>
						</div>
						<div class="form-field">
							<label><?php _e( 'Description','wpsc_cf' ); ?></label>
							<textarea name="custom-field-description" rows="5" cols="40"><?php echo $wpsc_cf_field['description']; ?></textarea>
							<p><?php _e( 'The description is not prominent by default; however, some themes may show it','wpsc_cf' ); ?>.</p>
						</div>
<?php
				if( $action == 'new' ) { ?>
						<p class="submit">
							<input type="submit" id="submit" value="<?php _e( 'Add New Custom Field','wpsc_cf' ); ?>" class="button" />
						</p>
						<input type="hidden" name="action" value="new-confirm" />
<?php
				} else { ?>
						<p class="submit">
							<input type="submit" id="submit" value="<?php _e( 'Update','wpsc_cf' ); ?>" class="button-primary" />
						</p>
						<input type="hidden" name="action" value="edit-confirm" />
						<input type="hidden" name="custom-field-id" value="<?php echo $wpsc_cf_id; ?>" />
<?php
				} ?>
					</form>
				</div>
			</div>
		</div>
	</div>
<?php
				break;

			default:
				wpsc_cf_manage_form();
				break;

		} ?>
</div>
<?php
	}

	function wpsc_cf_manage_form() {

		$wpsc_cf_data = get_option( 'wpsc_cf_data' ); ?>
	<table class="widefat">
		<thead>
			<tr>
				<th class="manage-column column-name"><?php _e( 'Name','wpsc_cf' ); ?></th>
				<th class="manage-column column-name"><?php _e( 'Type','wpsc_cf' ); ?></th>
				<th class="manage-column column-name"><?php _e( 'Description','wpsc_cf' ); ?></th>
				<th class="manage-column column-name"><?php _e( 'Slug','wpsc_cf' ); ?></th>
			</tr>
		</thead>
		<tbody>
<?php
		if( $wpsc_cf_data ) {
			if( wpsc_cf_is_serialized( $wpsc_cf_data ) )
				$wpsc_cf_data = unserialize( $wpsc_cf_data );
			$i = 0;
			foreach( $wpsc_cf_data as $wpsc_cf_id => $wpsc_cf_field ) { ?>
			<tr id="custom-field-<?php echo $wpsc_cf_id; ?>">
				<td class="name column-name">
					<a href="admin.php?page=wpsc_cf&action=edit&id=<?php echo $wpsc_cf_id; ?>" class="row-title"><strong><?php echo $wpsc_cf_field['name']; ?></strong></a>
					<div class="row-actions">
						<span class="edit"><a href="admin.php?page=wpsc_cf&action=edit&id=<?php echo $wpsc_cf_id; ?>"><?php _e( 'Edit','wpsc_cf' ); ?></a></span> | 
						<span class="submitdelete"><a href="admin.php?page=wpsc_cf&action=delete&id=<?php echo $wpsc_cf_id; ?>"><?php _e( 'Delete','wpsc_cf' ); ?></a></span>
					</div>
				</td>
				<td class="name column-name"><?php echo $wpsc_cf_field['type']; ?></td>
				<td class="name column-name"><?php echo $wpsc_cf_field['description']; ?></td>
				<td class="name column-name"><?php echo $wpsc_cf_field['slug']; ?></td>
			</tr>
<?php
				$i++;
			}
		}
		if( $i == 0 ) { ?>
			<tr>
				<td colspan="3">
					<?php _e( 'No Custom Fields have been created.','vl_wpsccf' ); ?>
				</td>
			</tr>
<?php
		} ?>
		</tbody>
	</table>
<?php
	}

}
?>