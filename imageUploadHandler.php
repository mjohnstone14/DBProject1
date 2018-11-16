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
    
    //resize uploaded image
    //width and height for cropped upload. should eventually
    //be same size as the white space on the template
    $w = 500;
    $h = 300;

    $resized = imagecreatetruecolor($w,$h);
    imagecopyresampled($resized,$im,0,0,0,0,$w,$h,$w,$h);

    //merge image with template
    $template_w = 800;
    $template_h = 1100;
    //$template_merge = imagecreatetruecolor($template_w,$template_h);
    $template_merge = imagecreatefromjpeg('./lib/templates/spittingtemplate.jpeg');
    //did this part work?
    imagecopymerge($template_merge,$resized,0,0,0,0,$w,$h,100);


	//string properties
	$orange = imagecolorallocate($im, 220, 210, 60);
	$px = (imagesx($im) - 7.5 * strlen($string)) / 2;
	imagestring($im, 50, $px, 10, $string, $orange);

	//puts the final image in the newly created path
	imagejpeg($template_merge,"$finalfile");



	//clean up
	imagedestroy($template_merge);
	imagedestroy($template);
	imagedestroy($im);
	imagedestroy($resized);
	unlink($uploadfile);
	header("Location: imageDisplay.php?path=$finalfile");
?>