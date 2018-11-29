<!DOCTYPE html>
<html>
<head> <?php session_start(); ?>  </head>
  <h1> Initiate Trade </h1>
  <body>
   <?php

     //$reciever = $_POST['trade_user'];
     //for now we pretend we are trading with marwan
     $reciever = 'marwan';
     $initiator = $_SESSION['username'];

     


     $db_file = '../myDB/spitting.db';
     $db = new PDO('sqlite:' . $db_file);

      //set errormode to use exceptions
     $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

     //print out initiator's cards
     echo "<h2> $initiator&#34;s cards </h2>";

     $stmt = $db->prepare('SELECT amount,imagePath FROM Owns NATURAL JOIN Card where username=:username');
     $stmt->bindParam(':username',$initiator);
     $result = $stmt->execute();
     $result_set = $stmt->fetchAll(PDO::FETCH_ASSOC);
      foreach($result_set as $path) {
         echo "<img src = $path[imagePath] height=20% width=20% >";
         echo "<h2> Amount = $path[amount] </h2></br>";
    }
     
     //print out reciever
     echo "<h2> $reciever&#34;s cards </h2>";
     $stmt = $db->prepare('SELECT amount,imagePath FROM Owns NATURAL JOIN Card where username=:username');
     $stmt->bindParam(':username',$initiator);
     $result = $stmt->execute();
     $result_set = $stmt->fetchAll(PDO::FETCH_ASSOC);
      foreach($result_set as $path) {
         echo "<img src = $path[imagePath] height=20% width=20% >";
         echo "<h2> Amount = $path[amount] </h2></br>";
    }

     ?>
  </body>
</html>