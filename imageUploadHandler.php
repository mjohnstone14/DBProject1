<head> <?php session_start(); ?> </head>

<?php	
    /*
    set_error_handler('myErrorHandler');
	register_shutdown_function('fatalErrorShutdownHandler');
	function myErrorHandler($code, $message, $file, $line) {
  			   unlink($uploadfile);
               header("Location: imageUploader.php?error=true");
               exit;
	}
	function fatalErrorShutdownHandler()
	{
  		$last_error = error_get_last();
  		if ($last_error['type'] === E_ERROR) {
    // fatal error
    	myErrorHandler(E_ERROR, $last_error['message'], $last_error['file'], $last_error['line']);
  		}
	}*/

    //saving the user's data
    //$_SESSION['title'] = $_POST['title'];
	//$_SESSION['desc'] = $_POST['desc'];

	//uploading to the temp directory
	$uploaddir = './lib/temp/';
	$uploadfile = $uploaddir.basename($_FILES['userfile']['name']);
	move_uploaded_file($_FILES['userfile']['tmp_name'],$uploadfile);

	echo "creating image from " . "$uploadfile";
	//upload and grab the dimensions
	$dimensions = getimagesize($uploadfile);
	$im = imagecreatefromjpeg($uploadfile);
	

	
    
    /**
	try{
		$im = imagecreatefromjpeg($uploadfile);
	} catch (Exception $e){
		try{
			$im = imagecreatefrompng($uploadfile);
		} catch (Exception $e){
			try{
				$im = imagecreatefromgif($uploadfile);
			} catch (Exception $e){
			   unlink($uploadfile);
               header("Location: imageUploader.php?error=true");
               exit;
			}
		}
	}
	**/
	

	//variables for final edited image
	$currUser = $_SESSION['username'];
	$finaldir = "./lib/images/";
	$time = time();
	$finalfile = $finaldir.$time.".jpeg";
    
    //resize uploaded image
    //width and height for cropped upload. should eventually
    //be same size as the white space on the template
    $art_w = 453; $art_h = 531;
    $midX = ($dimensions[0])/2; $midY = ($dimensions[1])/2;
    $crop_x = $midX-($art_w/2); $crop_y = $midY-($art_h/2);


    $resized = imagecreatetruecolor($art_w,$art_h);
    imagecopyresampled($resized,$im,0,0,$crop_x,$crop_y,$art_w,$art_h,$art_w,$art_h);

    //merge image with template
    $template_w = 600;
    $template_h = 825;
    $art_x = 73.5;
    $art_y = 107.25;

    $template_merge = imagecreatefromjpeg('./lib/templates/spittingtemplate.jpeg');
    //doing the merge
    imagecopymerge($template_merge,$resized,$art_x,$art_y,0,0,$art_w,$art_h,100);


	//string properties
	$title_start_x = 81; $title_start_y = 45;
	$desc_start_x = 81; $desc_start_y = 675;
	$font1 = imageloadfont('./lib/card-fonts/Man+_I_12x24_LE.gdf');
	$font2 = imageloadfont('./lib/card-fonts/Script_8x16_LE.gdf');
	$text_color = imagecolorallocate($template_merge, 0, 0, 0);
    //UNTIL FREETYPE IS INSTALLED, FONT WILL BE DUMB.
	//imagettftext($template_merge, $font_size, 0, $text_start_x, $text_start_y, $text_color, './arial.ttf', $string);

	//DRAW TITLE
	imagestring($template_merge, $font1, $title_start_x, $title_start_y, $title, $text_color);

	//DRAW DESCRIPTION
	imagestring($template_merge, $font2, $desc_start_x, $desc_start_y, $desc, $text_color);


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