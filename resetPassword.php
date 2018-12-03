<?php
echo '<link rel ="stylesheet" type = "text/css" href="templateCSS.css">';
	function randomPassword() {
		$alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
		$pass = array(); //remember to declare $pass as an array
		$alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
		for ($i = 0; $i < 8; $i++) {
			$n = rand(0, $alphaLength);
			$pass[] = $alphabet[$n];
		}
		return implode($pass); //turn the array into a string
	}

	if(isset($_POST['login'])) {
		$db = new PDO('sqlite:../myDB/spitting.db');
		$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

		$errMsg = '';
		// Get data from FORM
		$email = $_POST['email'];
		if($email == '')
			$errMsg = 'Sorry, please enter a valid email';
		if($errMsg == '') {
			try {
				$stmt = $db->prepare('SELECT * from User WHERE email = :email');
				$stmt->execute(array(
					':email' => $email
					));
				$data = $stmt->fetch(PDO::FETCH_ASSOC);
				if($data == false){
					$errMsg = "Email $email not found.";
				}
				else {
					if($email == $data['email']) {
						session_start();
						$_SESSION['username'] = $data['username'];
						$_SESSION['email'] = $data['email'];
						$_SESSION['password'] = $data['password'];
						$_SESSION['flag'] = $data['flag'];
						$_SESSION['level'] = $data['level'];
						

						$password = randomPassword();
		
						// Create a url which we will direct them to reset their password
						$pwrurl = "http://18.212.30.53/~ubuntu/DBProject1/login_form.php";
						// Mail them their key
						$mailbody = "Dear user,\n\nIf this e-mail does not apply to you please ignore it. 
						It appears that you have requested a password reset at our Spitting Images\n\n
						To reset your password, please click the link and use the password provided.\n\n" . $password . " If you cannot click it, please paste it into your web browser's
						 address bar.\n\n" . $pwrurl . "\n\nThanks,\nThe Administration";
						mail($email, "Spitting Images - Password Reset", $mailbody);
						echo "Your password recovery key has been sent to your e-mail address.";
						
					
						$sql = 'UPDATE user SET password=? WHERE email=:email';
						$query= $dpo->prepare($sql);
						$query->execute();
					
					}
				}
			}
			catch(PDOException $e) {
				$errMsg = $e->getMessage();
			}
		}
	}

	
?>

<html>
<head><title>Login</title></head>
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
					<input type="text" name="email" placeholder= "Email" value="<?php if(isset($_POST['email'])) echo $_POST['email'] ?>" autocomplete="off" class="box"/><br />
					<input type="submit" name='login' value="Login" class='submit'/><br />
				</form>
			</div>
		</div>
	</div>
</body>
</html>