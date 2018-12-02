<?php
echo '<link rel ="stylesheet" type = "text/css" href="templateCSS.css">';
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
				

                        echo $_SESSION['username'];
                        echo $_SESSION['password'];
					
			
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