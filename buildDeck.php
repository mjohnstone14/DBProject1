<!DOCTYPE html>
<html>
<head>
  <form method="get" action="userHome.php">
  <button type="submit">Home Page</button>
  </form>
</head>
<title> Build Deck</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<body style=background-color:DarkGrey>
<h1> Build Your Deck </h1>
<p> Select up to 10 cards to add to your deck. </p>
<?php
  session_start();
  $creator = $_SESSION['username'];
  $db_file = '../myDB/spitting.db';
  $db = new PDO('sqlite:' . $db_file);

  //set errormode to use exceptions
  $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $stmt = $db->prepare('SELECT imagePath,cardID FROM Card where creator=:creator');
  $stmt->bindParam(':creator', $creator);
  $result = $stmt->execute();
  $result_set = $stmt->fetchAll(PDO::FETCH_ASSOC);

  //start the form
  echo "<form action='buildDeckHandler.php' method='post'>";
  //an incrementer
  $inc = 0;
  //loop through each image that the user has created,
  //give them a checkbox to select whether they want to add it to their deck or not.
  foreach($result_set as $path) {
    echo "<div class = 'w3-row-w3'>";
    echo "<div class = 'w3-col l3 s6'>";
    echo "<div class = 'w3-container'>";
    echo "<input type='checkbox' name='card".$inc."' value=$path[cardID]><img src = $path[imagePath] height=100% width=100% ></input>";
    echo "</div>";
    echo "</div>";
    echo "</div>";
    $inc+=1;
  }
?>
  <input type="submit"\>
  </form>
</body>
</html>
