<!DOCTYPE html>
<html>
<head> <?php session_start(); ?>  </head>
  <link rel ="stylesheet" type = "text/css" href="templateCSS.css">
  <h1> Initiate Trade </h1>
  <body style="background-color:Darkgrey;">
  <div class = "row">
   <?php

     //$reciever = $_POST['trade_user'];
     //for now we pretend we are trading with marwan
     $receiver = $_POST['receiver'];
     $initiator = $_SESSION['username'];




     $db_file = '../myDB/spitting.db';
     $db = new PDO('sqlite:' . $db_file);

      //set errormode to use exceptions
     $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

     //print out initiator's cards
     echo "<div class='column' style='width: 25%'>";
     echo "<h2> $initiator's cards </h2>";

     $stmt = $db->prepare('SELECT amount,imagePath,cardID FROM Owns NATURAL JOIN Card where username=:username');
     $stmt->bindParam(':username',$initiator);
     $result = $stmt->execute();
     $result_set1 = $stmt->fetchAll(PDO::FETCH_ASSOC);
      foreach($result_set1 as $path) {
         echo "<img src = $path[imagePath] height=20% width=20% >
               <p> Amount = $path[amount] <p>
               <p> ID = $path[cardID] <p>";
    }
    echo "</div>";

     //print out reciever
     echo "<div class='column' style='width: 25%'>";
     echo "<h2> $receiver's cards </h2>";
     $stmt = $db->prepare('SELECT amount,imagePath,cardID FROM Owns NATURAL JOIN Card where username=:username');
     $stmt->bindParam(':username',$receiver);
     $result = $stmt->execute();
     $result_set2 = $stmt->fetchAll(PDO::FETCH_ASSOC);
      foreach($result_set2 as $path) {
         echo "<img src = $path[imagePath] height=20% width=20%>
               <p> Amount = $path[amount] <p>
               <p> ID = $path[cardID] <p>";
    }
    echo "</div>
    <div class='column' style='width: 50%'>
     <form action='tradeRequestHandler.php' method='POST'>
      <input type='hidden' name='receiver' value=$receiver\>

      <p>Card1 ID</p>
      <input type='text' name='card1'\>
      <p>Card2 ID</p>
      <input type='text' name='card2'\>
      <input type='submit'>
     </form>
     </div>";

     ?>


   </div>
  </body>
</html>
