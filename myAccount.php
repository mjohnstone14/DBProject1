<?php
echo '<link rel ="stylesheet" type = "text/css" href="templateCSS.css">';
	if(isset($_POST['reset'])) {
		$db = new PDO('sqlite:../myDB/spitting.db');
		$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

		$errMsg = '';
		// Get data from FORM
        $username = $_POST['username'];
        $password = $_POST['password'];

        $info = [':username' => $username, ':password' => $password];
        $sql = 'UPDATE user SET password=:password WHERE username=:username';
        $query= $db->prepare($sql);
        $query->execute($info);

        echo "Your information was updated successfully!";

        header("Location: login_form.php");
        exit;

    }
?>

<html>
<head>
	<title>My Account</title>
	<form method="get" action="userHome.php">
	<button type="submit">Home Page</button>
	</form>
</head>
	<style>
	html, body {
		margin: 1px;
		border: 0;
	}
	</style>
<body>
	<div align="center">
		<div style=" border: solid 1px #782121; " align="left">
			<?php
				if(isset($errMsg)){
					echo '<div style="color:#FF0000;text-align:center;font-size:17px;">'.$errMsg.'</div>';
				}
			?>
			<div style="background-color:#782121; color:#ffffff; padding:10px;"><b>Account Management (Use page to change password if desired)</b></div>
			<div style="margin: 15px">
				<form action="" method="post">
                    <input type="text" name="username" placeholder= "Please enter your username" value="<?php if(isset($_POST['username'])) echo $_POST['username'] ?>" autocomplete="off" class="box"/><br />
                    <input type="text" name="password" placeholder= "Please enter your new password" value="<?php if(isset($_POST['password'])) echo $_POST['password'] ?>" autocomplete="off" class="box"/><br />
					<input type="submit" name='reset' value="reset" class='submit'/><br />
				</form>
			</div>
		</div>
	</div>
</body>
</html>
