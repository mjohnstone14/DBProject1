<?php
echo '<link rel ="stylesheet" type = "text/css" href="templateCSS.css">';
	if(isset($_POST['reset'])) {
		$db = new PDO('sqlite:../myDB/spitting.db');
		$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

		$errMsg = '';
		// Get data from FORM
        $email = $_POST['username'];
        $password = $_POST['password'];

        $info = [':username' => username, ':password' => $password];
        $sql = 'UPDATE user SET password=:password WHERE email=:email';
        $query= $db->prepare($sql);
        $query->execute($info);

        echo "Your information was updated successfully! $email with password: $password";

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
			<div style="background-color:#782121; color:#ffffff; padding:10px;"><b>Login</b></div>
			<div style="margin: 15px">
				<form action="" method="post">
                    <input type="text" name="email" placeholder= "Reset email?" value="<?php if(isset($_POST['email'])) echo $_POST['email'] ?>" autocomplete="off" class="box"/><br />
                    <input type="text" name="email" placeholder= "Reset password?" value="<?php if(isset($_POST['password'])) echo $_POST['password'] ?>" autocomplete="off" class="box"/><br />
					<input type="submit" name='reset' value="reset" class='submit'/><br />
				</form>
			</div>
		</div>
	</div>
</body>
</html>
