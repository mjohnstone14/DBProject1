<head> <?php session_start(); ?>

<?php
    
	//uploading to the temp directory
	$uploaddir = './lib/temp/';
	$uploadfile = $uploaddir.basename($_FILES['userfile']['name']);
	move_uploaded_file($_FILES['userfile']['tmp_name'],$uploadfile);

	echo "creating image from " . "$uploadfile";
	$im = imagecreatefromjpeg($uploadfile);

	//variables for final edited image
	$title = $_POST['title'];
	$desc = $_POST['desc'];
	$currUser = $_SESSION['username'];
	$finaldir = "./lib/images/";
	$time = time();
	$finalfile = $finaldir.$time.".jpeg";
    
    //resize uploaded image
    //width and height for cropped upload. should eventually
    //be same size as the white space on the template
    $art_w = 604;
    $art_h = 708;
    //$crop_x = 
    //$crop_y = 

    $resized = imagecreatetruecolor($art_w,$art_h);
    imagecopyresampled($resized,$im,0,0,0,0,$art_w,$art_h,$art_w,$art_h);

    //merge image with template
    $template_w = 800;
    $template_h = 1100;
    $art_x = 98;
    $art_y = 143;

    $template_merge = imagecreatefromjpeg('./lib/templates/spittingtemplate.jpeg');
    //doing the merge
    imagecopymerge($template_merge,$resized,$art_x,$art_y,0,0,$art_w,$art_h,100);


	//string properties
	$font_size = 20; $title_start_x = 108; $title_start_y = 101;
	$desc_start_x = 108; $desc_start_y = 950;
	$font = 10;
	$text_color = imagecolorallocate($template_merge, 0, 0, 0);
    //UNTIL FREETYPE IS INSTALLED, FONT WILL BE DUMB.
	//imagettftext($template_merge, $font_size, 0, $text_start_x, $text_start_y, $text_color, './arial.ttf', $string);

	//DRAW TITLE
	imagestring($template_merge, $font, $title_start_x, $title_start_y, $title, $text_color);

	//DRAW DESCRIPTION
	imagestring($template_merge, $font, $desc_start_x, $desc_start_y, $desc, $text_color);


	//DO THE INSERT INTO THE DATABASE
	
    $db = new PDO('sqlite:../myDB/spitting.db');
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $stmt = $db->prepare("INSERT INTO Card (cardID,cardName,imagePath,creator) VALUES (:cardID,:cardName,:imagePath,:creator)");
    $stmt->bindParam(':cardID', $time);
    $stmt->bindParam(':cardName', $title);
    $stmt->bindParam(':imagePath', $finalfile);
    $stmt->bindParam(':creator', $currUser);
    $stmt->execute();
   



	//PUTS the final image in the newly created path
	imagejpeg($template_merge,"$finalfile");



	//CLEAN up
	imagedestroy($template_merge);
	imagedestroy($im);
	imagedestroy($resized);
	unlink($uploadfile);
    header("Location: imageDisplay.php?path=$finalfile");
?>