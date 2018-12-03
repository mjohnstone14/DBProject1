<!DOCTYPE html>
<html>
  <?php
  session_start();
  $username = $_SESSION['username'];
   ?>
</head>
<title>Trades For You</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<div class="w3-hide-large" style="margin-top:83px"></div>

<!-- Top header -->
<header class="w3-container w3-xlarge">
  <p class="w3-left">Trades For You</p>
</header>

<div class="w3-container w3-text-grey" id="Trades For You">
  <p>All items</p>
</div>
<?php
$db_file = '../myDB/spitting.db';
$db = new PDO('sqlite:' . $db_file);

//set errormode to use exceptions
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
echo "<h1> Trades Proposed by You</h1>";
$stmt = $db->prepare('SELECT * FROM (SELECT * from Trades where initiator = :username) NATURAL JOIN Card where cardID1 = cardID');
$stmt->bindParam(':username',$username);
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
echo "<h1> Trades Proposed to You</h1>";
$stmt = $db->prepare('SELECT * FROM (SELECT * from Trades where reciever = :username) NATURAL JOIN Card where cardID1 = cardID');
$stmt->bindParam(':username',$username);
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


?>
</html>
