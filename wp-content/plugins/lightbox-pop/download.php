<?php 
require( dirname( __FILE__ ) . '../../../../wp-load.php' );

$listName = $_GET['fileName'];



$fullPath = realpath(dirname(__FILE__) )."/XYZ Lightbox Pop - User Guide.pdf";



if ($fd = fopen ($fullPath, "r")) {
	$fsize = filesize($fullPath);
	$path_parts = pathinfo($fullPath);


	$ext = strtolower($path_parts["extension"]);

	header("Content-Type: application/force-download");
	header("Content-Type: application/octet-stream");
	header("Content-Type: application/download");
	
	header("Content-type: text/csv"); // add here more headers for diff. extensions
	header("Content-Disposition: attachment; filename=\"".$path_parts["basename"]."\""); // use 'attachment' to force a download

	header("Content-length: $fsize");
	header("Cache-control: private"); //use this to open files directly
	while(!feof($fd)) {
		$buffer = fread($fd, 2048);
		echo $buffer;
	}

	

}
	fclose ($fd);

?>