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
    $art_w = 604;
    $art_h = 708;
    $crop_x = 
    $crop_y = 

    $resized = imagecreatetruecolor($art_w,$art_h);
    imagecopyresampled($resized,$im,0,0,0,0,$art_w,$art_h,$art_w,$art_h);

    //merge image with template
    $template_w = 800;
    $template_h = 1100;
    $art_x = 98;
    $art_y = 143;

    //$template_merge = imagecreatetruecolor($template_w,$template_h);
    $template_merge = imagecreatefromjpeg('./lib/templates/spittingtemplate.jpeg');
    //did this part work?
    imagecopymerge($template_merge,$resized,$art_x,$art_y,0,0,$art_w,$art_h,100);


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