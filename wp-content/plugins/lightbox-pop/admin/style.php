<?php require( dirname( __FILE__ ) .'/../../../../wp-load.php'); ?>
<style type="text/css">
#lightbox-pop .plugin-version-author-uri {
	
	background-color: #F4F4F4;
	min-height:16px;
	border-radius:5px;
	margin-bottom: 7px;
	padding: 5px;
	color: #111111;
	
}
#lightbox-pop{
background: #64cfe8; /* Old browsers */

background: -moz-linear-gradient(top,  #ffffff 0%, #64cfe8 100%); /* FF3.6+ */
background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,#ffffff), color-stop(100%,#64cfe8)); /* Chrome,Safari4+ */
background: -webkit-linear-gradient(top,  #ffffff 0%,#64cfe8 100%); /* Chrome10+,Safari5.1+ */
background: -o-linear-gradient(top,  #ffffff 0%,#64cfe8 100%); /* Opera 11.10+ */
background: -ms-linear-gradient(top,  #ffffff 0%,#64cfe8 100%); /* IE10+ */
background: linear-gradient(top,  #ffffff 0%,#64cfe8 100%); /* W3C */

}

.xyz_fbook{
	
	background-image: url('<?php echo plugins_url("images/facebook.png",__FILE__) ?>');
	height:16px;
	background-repeat: no-repeat;
	background-position: left center;
	padding-left: 15px;
	text-decoration: none;
	
	
	
}

.xyz_support{
	
	background-image: url('<?php echo plugins_url("images/support.png",__FILE__) ?>');
	height:16px;
	background-repeat: no-repeat;
	background-position: left center;
	padding-left: 15px;
	
	
	
	
}

.xyz_twitt{
	
	background-image: url('<?php echo plugins_url("images/twitter.png",__FILE__) ?>');
	height:16px;
	background-repeat: no-repeat;
	background-position: left center;
	padding-left: 15px;
	text-decoration: none;
	
	
	
}
.xyz_gplus{
	
	background-image: url('<?php echo plugins_url("images/gplus.png",__FILE__) ?>');
	height:16px;
	background-repeat: no-repeat;
	background-position: left center;
	padding-left: 15px;
	text-decoration: none;
	
	margin-left: 3px;
	
}

#lightbox-pop .plugin-version-author-uri a#xyz_update,
#lightbox-pop .plugin-version-author-uri a#xyz_update:link,
#lightbox-pop .plugin-version-author-uri a#xyz_update:hover,
#lightbox-pop .plugin-version-author-uri a#xyz_update:active,
#lightbox-pop .plugin-version-author-uri a#xyz_update:visited
{

color: red;
font-weight: bold;
text-decoration: blink;
}

#lightbox-pop .plugin-version-author-uri a,
#lightbox-pop .plugin-version-author-uri a:link,
#lightbox-pop .plugin-version-author-uri a:hover,
#lightbox-pop .plugin-version-author-uri a:active,
#lightbox-pop .plugin-version-author-uri a:visited{
	
	
	color: #111111;
	text-decoration: none;
	
}
#lightbox-pop .plugin-version-author-uri a:hover{

color:#cc811a;
}
#lightbox-pop .plugin-title{

background-image: url('<?php echo plugins_url("images/xyz_logo.png",__FILE__) ?>');
background-repeat: no-repeat;
background-position: left  bottom;

}
</style>