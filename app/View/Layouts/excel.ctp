<?php 
	header("Content-Type: application/vnd.ms-excel; charset=UTF-8"); 
	header("Pragma: public"); 
	header("Expires: 0"); 
	header("Cache-Control: must-revalidate, post-check=0, pre-check=0"); 
	header("Content-Type: application/force-download"); 
	header("Content-Type: application/octet-stream"); 
	header("Content-Type: application/download"); 
	header("Content-Disposition: attachment;filename=$output_file_name"); 
	header("Content-Transfer-Encoding: binary "); 
	echo $content_for_layout;
?>