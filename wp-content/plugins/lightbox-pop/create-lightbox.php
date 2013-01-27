<?php

add_action ( 'get_footer', 'lbx_lightbox_create');//, [priority], [accepted_args] );


function lbx_lightbox_create()
{
	$page_option=get_option('xyz_lbx_page_option');
	
	if($page_option==3)
	{

		return false;
	}
	lbx_lightbox_display();
}

function lbx_lightbox_display()
{
	$imgpath=plugins_url()."/lightbox-pop/images/";
	$closeimage=$imgpath."close.png";

$color=get_option('xyz_lbx_color');
	$html=get_option('xyz_lbx_html');
	$top=get_option('xyz_lbx_top');
	$width=get_option('xyz_lbx_width');
	$height=get_option('xyz_lbx_height');
	$left=get_option('xyz_lbx_left');
	$delay=get_option('xyz_lbx_delay');
	$page_count=get_option('xyz_lbx_page_count');
	if($page_count==0) $page_count=1;
	$mode=get_option('xyz_lbx_mode');
	$repeat_interval=get_option('xyz_lbx_repeat_interval');
	$repeat_interval_timing=get_option('xyz_lbx_repeat_interval_timing');
	if($repeat_interval_timing==1)
	{
		$repeat_interval=$repeat_interval*60;
	}
$z_index=get_option('xyz_lbx_z_index');
$corner_radius=get_option('xyz_lbx_corner_radius');
$top_dim=get_option('xyz_lbx_top_dim');
$left_dim=get_option('xyz_lbx_left_dim');
$height_dim=get_option('xyz_lbx_height_dim');
$width_dim=get_option('xyz_lbx_width_dim');
$border_color=get_option('xyz_lbx_border_color');
$bg_color=get_option('xyz_lbx_bg_color');
$opacity=get_option('xyz_lbx_opacity');
$border_width=get_option('xyz_lbx_border_width');
$close_button_option=get_option('xyz_lbx_close_button_option');
$iframe_option=get_option('xyz_lbx_iframe');
	?>
	<style type="text/css">

	.lbx_overlay{
	display: none;
	position: fixed;
	_position: fixed;
	top: 0%;
	left: 0%;
	width: 100%;
	height: 100%;
	background-color:<?php echo $color?>;
	z-index:<?php echo $z_index;?>;
	-moz-opacity: <?php echo ($opacity/100);?>;
	opacity:<?php echo ($opacity/100);?>;
	filter: alpha(opacity=<?php echo $opacity;?>);
}
.lbx_content {
display: none;
position: fixed;
_position: fixed;
top: <?php echo $top; echo $top_dim;?>;
left: <?php echo $left; echo $left_dim;?>;
width: <?php echo $width; echo $width_dim;?>;
height: <?php echo $height; echo $height_dim;?>;
padding: 0;
margin:0;
border: <?php echo $border_width; ?>px solid <?php echo $border_color;?>;
background-color: <?php echo $bg_color;?>;
z-index:<?php echo $z_index+1;?>;
overflow: hidden;
border-radius:<?php echo $corner_radius;?>px;

}
.lbx_iframe{

width:100%;
height:100%;
border:0;


}
#closediv{
position:absolute;
cursor:pointer;
top: 0px;
right: 0px;
}
</style>

<div id="lbx_fade" class="lbx_overlay"  <?php if($close_button_option==0) { ?> onclick = "javascript:lbx_hide_lightbox()"<?php }?>></div>
<div id="lbx_light" class="lbx_content">
<?php if($close_button_option==1) { ?><img id="closediv"  src="<?php  echo $closeimage;?>" onclick = "javascript:lbx_hide_lightbox()"><?php }?>
<!-- <div width="100%" height="20px" style="text-align:right;padding:0px;margin:0px;"><a href = "javascript:void(0)" onclick = "javascript:lbx_hide_lightbox()">CLOSE</a></div> -->
<?php if($iframe_option==1) { ?><iframe  src="<?php echo  plugins_url();?>/lightbox-pop/iframe.php" class="lbx_iframe" scrolling="no"></iframe><?php }else{ echo do_shortcode($html);}?>
</div>

<script type="text/javascript">

var xyz_lbx_tracking_cookie_name="_xyz_lbx_until";
var xyz_lbx_pc_cookie_name="_xyz_lbx_pc";
var xyz_lbx_tracking_cookie_val=xyz_lbx_get_cookie(xyz_lbx_tracking_cookie_name);
var xyz_lbx_pc_cookie_val=xyz_lbx_get_cookie(xyz_lbx_pc_cookie_name);
var xyz_lbx_today = new Date();

if(xyz_lbx_pc_cookie_val==null)
xyz_lbx_pc_cookie_val = 1;
else
xyz_lbx_pc_cookie_val = (xyz_lbx_pc_cookie_val % <?php echo $page_count;?> ) +1;

expires_date = new Date( xyz_lbx_today.getTime() + (24 * 60 * 60 * 1000) );
document.cookie = xyz_lbx_pc_cookie_name + "=" + xyz_lbx_pc_cookie_val + ";expires=" + expires_date.toGMTString() + ";path=/";


function xyz_lbx_get_cookie( name )
{
var start = document.cookie.indexOf( name + "=" );
//alert(document.cookie);
var len = start + name.length + 1;
if ( ( !start ) && ( name != document.cookie.substring( 0, name.length ) ) )
{
return null;
}
if ( start == -1 ) return null;
var end = document.cookie.indexOf( ";", len );
if ( end == -1 ) end = document.cookie.length;
return unescape( document.cookie.substring( len, end ) );
}


function lbx_hide_lightbox()
{
document.getElementById("lbx_light").style.display="none";
document.getElementById("lbx_light").innerHTML="";
document.getElementById("lbx_fade").style.display="none";
}

function lbx_show_lightbox()
{

//alert(lbx_tracking_cookie_val);

if(xyz_lbx_tracking_cookie_val==1)
return;

if( "<?php echo $mode;?>" == "page_count_only"  || "<?php echo $mode;?>" == "both" )
{
if(xyz_lbx_pc_cookie_val != <?php echo $page_count;?>)
return;
}


document.getElementById("lbx_light").style.display="block";
document.getElementById("lbx_fade").style.display="block";
//expires_date = new Date( xyz_lbx_today.getTime() + (24 * 60 * 60 * 1000) );
//alert(xyz_lbx_today.toGMTString());
	expires_date = new Date(xyz_lbx_today.getTime() + (<?php echo $repeat_interval;?> * 60 * 1000));
document.cookie = xyz_lbx_tracking_cookie_name + "=1;expires=" + expires_date.toGMTString() + ";path=/";


}

if("<?php echo $mode;?>" == "page_count_only")
lbx_show_lightbox();
else
setTimeout("lbx_show_lightbox()",<?php echo $delay*1000;?>);

</script>





<?php 


}


?>