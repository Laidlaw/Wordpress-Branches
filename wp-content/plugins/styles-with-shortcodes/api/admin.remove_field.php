<?php

/**
 * 
 *
 * @version $Id$
 * @copyright 2003 
 **/
require_once("../api.php");

function send_error_die($msg){
	die(json_encode(array('R'=>'ERR','MSG'=>$msg)));
}

$post_id = intval($_REQUEST['ID']);

if($post_id==0){
	send_error_die('Post ID is not valid.');
}

//-----------
if ( !wp_verify_nonce( $_REQUEST['nonce'], 'csshortcode-css-nonce' )) {
	send_error_die('Settings error, no access.');
}

if ( !current_user_can( 'edit_post', $post_id ) ){
	send_error_die('No access.');
} 
//-------------

$name = $_REQUEST['name'];
if(trim($name)==''){
	send_error_die('Property name is not valid');
}

$fields = get_post_meta($post_id,'sc_fields',true);
$fields = is_array($fields)?$fields:array();

if(isset($fields[$name])){
	unset($fields[$name]);
}

update_post_meta($post_id,'sc_fields',$fields);

$ret = array(
	'R'=>'OK',
	'MSG'=>''
);
die(json_encode($ret));
?>