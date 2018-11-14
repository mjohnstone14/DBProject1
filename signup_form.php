<?php
     $db_file = '../myDB/user.db';
     $db = new PDO('sqlite:' . $db_file);
    if(isset($_POST['register'])) {
      $errMsg = '';
      // Get data from FROM
      $username = $_POST['username'];
      $password = $_POST['password'];
      $level = 1;

      if($username == '')
        $errMsg = 'Please enter username';
      if($password == '')
        $errMsg = 'Please enter password';
     
      if($errMsg == ''){
        try {
          $stmt = $db->prepare('INSERT INTO pdo (username, password, level) VALUES (:username, :password, :level)');
          $stmt->execute(array(
            ':username' => $username,
            ':password' => $password,
            ));
          header('Location: signup_form.php?action=joined');
          exit;
        }
        catch(PDOException $e) {
          echo $e->getMessage();
        }
      }
    }
    if(isset($_GET['action']) && $_GET['action'] == 'joined') {
      $errMsg = 'Registration successful. Now you can <a href="login.php">login</a>';
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
		<div style=" border: solid 1px #006D9C; " align="left">
			<?php
				if(isset($errMsg)){
					echo '<div style="color:#FF0000;text-align:center;font-size:17px;">'.$errMsg.'</div>';
				}
			?>
			<div style="background-color:#006D9C; color:#FFFFFF; padding:10px;"><b>Sign Up</b></div>
			<div style="margin: 15px">
				<form action="" method="post">
				  <input type="text" name="username" placeholder="Username" value="<?php if(isset($_POST['username'])) echo $_POST['username'] ?>" autocomplete="off" class="box"/><br /><br />
					<input type="password" name="password" placeholder="Password" value="<?php if(isset($_POST['password'])) echo $_POST['password'] ?>" class="box" /><br/><br />
					<input type="submit" name='register' value="Register" class='submit'/><br />
				</form>
			</div>
		</div>
	</div>
</body>
</html>


