<!DOCTYPE html>
<html>
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
  foreach($result_set as $path) {
    echo "<form action='buildDeckHandler.php'>
    <input type='checkbox' name=$path[cardID]>
    <img src = $path[imagePath] height=30% width=30% >
    </form>";
  }
  
?>
</html>
