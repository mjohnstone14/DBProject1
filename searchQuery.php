<?php
session_start();
$username = $_POST['username'];

  $db_file = '../myDB/spitting.db';
  $db = new PDO('sqlite:' . $db_file);


  $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $stmt = $db->prepare('SELECT * FROM Owns NATURAL JOIN Card where username = :username');
  $stmt->bindParam(':username',$username);
  $result = $stmt->execute();
  $result_set = $stmt->fetchAll(PDO::FETCH_ASSOC);
  echo "<h1> $username's deck</h1>";
  foreach($result_set as $path) {
    $imagePath = $path['imagePath'];
    $cardName = $path['cardName'];
    "echo "<img src = $path[imagePath] height=100% width=100%</img>";
  }
  ?>

<!-- attempting to accept a trade from this page should redirect to tradeAcceptHandler.php. it will need to provide 'tradeID' as a post variable
 -h a r p e r wrote this-->
</html>
