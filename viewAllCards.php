<!DOCTYPE html>
<html>
  <?php
  session_start();
   ?>
<head>
  <form method="get" action="userHome.php">
    <button type="submit">Home Page</button>
  </form>
</head>
<title>Spitting Image</title>
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
    <p class="w3-left">All Users Cards</p>
  </header>
  <div class="w3-container w3-black w3-padding-32">
  <div class="w3-container w3-text-grey" id="Other Users">
    <p>All items</p>
  </div>
  <?php
  $db_file = '../myDB/spitting.db';
  $db = new PDO('sqlite:' . $db_file);

  //set errormode to use exceptions
  $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $stmt = $db->prepare('SELECT imagePath FROM Card');
  $result = $stmt->execute();
  $result_set = $stmt->fetchAll(PDO::FETCH_ASSOC);
  foreach($result_set as $path) {
    echo "<div class = 'w3-row-w3'>";
    echo "<div class = 'w3-col l3 s6'>";
    echo "<div class = 'w3-container'>";
    echo "<form method='get' action='./tradeForm.php'>";
    echo "<img src = $path[imagePath] height=90% width=90%><button class='w3-button w3-black'>Trade Now</button></img>";
    echo "</form>";
    echo "</div>";
    echo "</div>";
    echo "</div>";

  }
  ?>
</div>
