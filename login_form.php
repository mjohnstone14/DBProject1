<?php
echo '<link rel ="stylesheet" type = "text/css" href="templateCSS.css">';
	if(isset($_POST['login'])) {
		$db = new PDO('sqlite:../myDB/spitting.db');
		$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

		$errMsg = '';
		// Get data from FORM
		$username = $_POST['username'];
		$password = $_POST['password'];
		if($username == '')
			$errMsg = 'Enter username';
		if($password == '')
			$errMsg = 'Enter password';
		if($errMsg == '') {
			try {
				$stmt = $db->prepare('SELECT username, password, flag, email, level FROM User WHERE username = :username');
				$stmt->execute(array(
					':username' => $username
					));
				$data = $stmt->fetch(PDO::FETCH_ASSOC);
				if($data == false){
					$errMsg = "User $username not found.";
				}
				else {
					if($password == $data['password']) {
						session_start();
						session_regenerate_id();
						$_SESSION['username'] = $data['username'];
						$_SESSION['email'] = $data['email'];
						$_SESSION['password'] = $data['password'];
						$_SESSION['flag'] = $data['flag'];
						$_SESSION['level'] = $data['level'];
						header('Location: userHome.php');

						echo $_SESSION['username'];
					
			
					}
					else
						$errMsg = 'Password not match.';
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
					<input type="text" name="username" placeholder= "Username" value="<?php if(isset($_POST['username'])) echo $_POST['username'] ?>" autocomplete="off" class="box"/><br /><br />
					<input type="password" name="password" placeholder= "Password " value="<?php if(isset($_POST['password'])) echo $_POST['password'] ?>" autocomplete="off" class="box" /><br/><br />
					<input type="submit" name='login' value="Login" class='submit'/><br />
					<br/><br/>
					<a href="./resetPassword.php" class="button">Forgot password?</a>
				</form>
			</div>
		</div>
	</div>
</body>
</html>