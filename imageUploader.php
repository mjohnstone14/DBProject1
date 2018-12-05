<html>
<title>Create Card</title>
<head>
	<?php session_start(); ?>
	<link rel ="stylesheet" type = "text/css" href="templateCSS.css">
	<form method="get" action="userHome.php">
	<button type="submit">Home Page</button>
	</form>
</head>
<body style=background-color:DarkGrey>

	<?php
	//display error
	if(isset($_GET['error'])){
		echo "<p>Please submit a jpeg, png, or gif file.</p></br>";
	}
	//dump session variables in case we were redirected here from an error
	if(isset($_SESSION['title']) && isset($_SESSION['desc'])){
		$title = $_SESSION['title'];
		$desc = $_SESSION['desc'];
		unset($_SESSION['title']);
		unset($_SESSION['desc']); 
	} else {
		$title = '';
		$desc = '';
	}
?>
	<h1> CREATE YOUR CARD </h1>
		<form action="imageUploadHandler.php?user='user'" method="POST" enctype="multipart/form-data">

			<p>Image File</p>
			<input type="file" name="userfile" accept="image/*"></br>

			<p>Card Title</p>
			<input type="text" name="title">

			<p>Card Description</p>
			<input type="text" name="desc">

			<input type="submit">
		</form>
</body>
<html>
