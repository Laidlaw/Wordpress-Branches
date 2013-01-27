<?php

function lbx_admin_notice()
{
	$xyz_lbx_repeat_interval_timing=get_option('xyz_lbx_repeat_interval_timing');
	if($xyz_lbx_repeat_interval_timing=='')
	{
			echo '<div class="error">
			   <p>It seems you have upgraded the Lightbox Pop Plugin. Please deactivate and then reactivate the plugin to upgrade the database.</p>
			</div>';
	}
}

add_action('admin_notices', 'lbx_admin_notice');

?>