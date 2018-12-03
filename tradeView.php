<!DOCTYPE html>
<html>
<?php

  $db_file = '../myDB/spitting.db';
  $db = new PDO('sqlite:' . $db_file);


  $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $stmt = $db->prepare('SELECT * FROM Trades NATURAL JOIN Card');
  $result = $stmt->execute();
  $result_set = $stmt->fetchAll(PDO::FETCH_ASSOC);
  foreach($result_set as $path) {
  	$initiator = $path['initiator'];
  	$receiver = $path['receiver'];
  	$cardID1 = $path['cardID1'];
  	$cardID2 = $path['cardID2'];

    echo "<form method='POST' action='./tradeAcceptHandler.php'>";
    echo "<h2> <b>$initiator</b> wants to trade $cardID1 to <b>$receiver</b> for $cardID2.</h2>
    ";
    echo "</form>";
  }
  ?>

<!-- attempting to accept a trade from this page should redirect to tradeAcceptHandler.php. it will need to provide 'tradeID' as a post variable
 -h a r p e r wrote this-->
</html>
