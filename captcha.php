<?php 
	session_start(); 
	$text = mt_rand(10000,99999); 
	$_SESSION["ttcapt"] = $text; 
	$height = 35; 
	$width = 54; 
	$tt_image = imagecreate($width, $height); 
	$color = imagecolorallocate($tt_image, rand(0, 200), rand(0, 200), rand(0, 200)); 
	$white = imagecolorallocate($tt_image, 255, 255, 255); 
	$font_size = 5; 
	imagestring($tt_image, $font_size, 5, 8, $text, $white);
	header( "Content-type: image/png" );
	header("Cache-Control: no-store, no-cache, must-revalidate");
	header("Cache-Control: post-check=0, pre-check=0", false);
	imagepng($tt_image);
	imagedestroy($tt_image );
?>