<?php

	//uploading to the temp directory
	$uploaddir = './lib/temp/';
	$uploadfile = $uploaddir.basename($_FILES['userfile']['name']);
	move_uploaded_file($_FILES['userfile']['tmp_name'],$uploadfile);

	echo "creating image from " . "$uploadfile";
	$im = imagecreatefromjpeg($uploadfile);

	//variables for final edited image
	$string = $_POST['text'];
	$finaldir = "./lib/images/";
	$finalfile = $finaldir.rand().".jpeg";

	//string properties
	$orange = imagecolorallocate($im, 220, 210, 60);
	$px = (imagesx($im) - 7.5 * strlen($string)) / 2;
	imagestring($im, 50, $px, 10, $string, $orange);
	imagejpeg($im,"$finalfile");

	//clean up
	imagedestroy($im);
	unlink($uploadfile);
	header("Location: imageDisplay.php?path=$finalfile");
?>