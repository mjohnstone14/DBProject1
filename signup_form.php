<?php
echo '<link rel ="stylesheet" type = "text/css" href="templateCSS.css">';
    if(isset($_POST['register'])) {
 
      $db = new PDO('sqlite:../myDB/spitting.db');
      $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

      $errMsg = '';
      // Get data from FORM
      $username = $_POST['username'];
      $password = $_POST['password'];
      $email = $_POST['email'];
      $flag = 0;
      $level = 1;

      if($username == '')
        $errMsg = 'Please enter username';
      if($password == '')
        $errMsg = 'Please enter password';
     
      if($errMsg == ''){
        try {          
          $stmt = $db->prepare("INSERT INTO User VALUES(:username, :password, :flag, :email, :level)");
          $stmt->bindParam(':username', $username);
          $stmt->bindParam(':password', $password);
          $stmt->bindParam(':email', $email);
          $stmt->bindParam(':flag', $flag);
          $stmt->bindParam(':level', $level);
          $stmt->execute();
          header('Location: signup_form.php?action=joined');
          exit;
        }
        catch(PDOException $e) {
          echo $e->getMessage();
        }
      }
    }
    if(isset($_GET['action']) && $_GET['action'] == 'joined') {
      $errMsg = 'Registration successful. Now you can <a href="login_form.php">login</a>';
    }
?>
<html>
<head><title>Sign Up</title></head>
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
			<div style="background-color:#782121; color:#ffffff; padding:10px;"><b>Sign Up</b></div>
			<div style="margin: 15px">
				<form action="" method="post">
				  <input type="text" name="username" placeholder="Username" value="<?php if(isset($_POST['username'])) echo $_POST['username'] ?>" autocomplete="off" class="box"/><br /><br />
					<input type="text" name="email" placeholder="Email" value="<?php if(isset($_POST['email'])) echo $_POST['email'] ?>" class="box" /><br/><br />
					<input type="password" name="password" placeholder="Password" value="<?php if(isset($_POST['password'])) echo $_POST['password'] ?>" class="box" /><br/><br />
          <input type="submit" name='register' value="Register" class='submit'/><br />
				</form>
			</div>
		</div>
	</div>
</body>
</html>


