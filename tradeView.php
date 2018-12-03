<!DOCTYPE html>
<html>
<head>
  <form method="get" action="userHome.php">
    <button type="submit">Home Page</button>
  </form>
</head>
<title>All Trades</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<div class="w3-main" style="margin-left:250px">
  <!-- Push down content on small screens -->
  <div class="w3-hide-large" style="margin-top:83px"></div>

  <!-- Top header -->
  <header class="w3-container w3-xlarge">
    <p class="w3-left">All Trades</p>
  </header>
  <div class="w3-container w3-black w3-padding-32">
  <div class="w3-container w3-text-grey" id="Other Users">
    <p>All items</p>
  </div>

<?php

  $db_file = '../myDB/spitting.db';
  $db = new PDO('sqlite:' . $db_file);


  $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $stmt = $db->prepare('SELECT * from Trades INNER JOIN Card on (cardID1=cardID);');
  $result = $stmt->execute();
  $result_set = $stmt->fetchAll(PDO::FETCH_ASSOC);
  foreach($result_set as $path) {
  	$initiator = $path['initiator'];
  	$receiver = $path['receiver'];
  	$cardID1 = $path['cardID1'];
    $mainCardName = $path['cardName'];
    $imagePath = $path['imagePath'];
    echo "<div class = 'w3-row-w3'>";
    echo "<div class = 'w3-col l3 s6'>";
    echo "<div class = 'w3-container'>";
    echo "<form method='POST' action='./tradeForm.php'>";
    echo "<h2> <b>$initiator</b> wants to trade $mainCardName to <b>$receiver</b>.</h2>";
    echo "<img src=$imagePath height=50% width=50%><input type='submit' name='receiver' value=$path[username] class='w3-button w3-black'>Trade Now</button></input></img>";
    echo "</form>";
    echo "</div>";
    echo "</div>";
    echo "</div>";
  }
  ?>

<!-- attempting to accept a trade from this page should redirect to tradeAcceptHandler.php. it will need to provide 'tradeID' as a post variable
 -h a r p e r wrote this-->
</html>
