<!DOCTYPE html>
<html>
<body>
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
    echo "<input type='checkbox' name='card".$inc." value=$path[cardID]>
    <img src = $path[imagePath] height=30% width=30% >
    </input>
    ";
    $inc+=1;
  }
?>
  <input type="submit"\>
  </form>
</body>
</html>
