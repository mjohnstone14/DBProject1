<!DOCTYPE html>
<html>
<head> <?php session_start(); ?> </head>

<body>
   
   <?php
     $trade_user = $_POST['trade_user'];
     $initiator = $_SESSION['username'];

     $db_file = '../myDB/spitting.db';
     $db = new PDO('sqlite:' . $db_file);

      //set errormode to use exceptions
      $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


      $stmt = $db->prepare('SELECT amount,imagePath FROM User NATURAL JOIN Owns NATURAL JOIN Card where username=:username');
      $stmt->bindParam(':username',$initiator);
      $result = $stmt->execute();
      $result_set = $stmt->fetchAll(PDO::FETCH_ASSOC);
      foreach($result_set as $path) {
       echo "<img src = $path[imagePath] height=20% width=20% >";
     ?>

</body>
</html>




