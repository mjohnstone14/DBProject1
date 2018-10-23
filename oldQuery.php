<!DOCTYPE html>
<html>
    <head>
        <link rel ="stylesheet" type = "text/css" href="core.css">
        <h1>Query Form</h1>
    </head>
    <body>
    <div class="content">
        <form action="oldQuery.php" method="POST">
            select from passengers where  <input id="statement" name="statement" type="text" size="75" />
          <input name="submit" type="submit">
        </form>
    </div>
    <?php
    if(isset($_POST["statement"])){
       try {
           //path to the SQLite database file
           $db_file = './myDB/airport.db';
           $inputStatement = $_POST["statement"];
           echo $inputStatement; echo "</br>";
           $db = new PDO('sqlite:' . $db_file);
           //set errormode to use exceptions
           $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
           $stmt = $db->prepare("SELECT * FROM passengers WHERE ? ;");
           //bind to post values
           //$stmt->bindParam('s',$inputStatement);
           $stmt->execute(array($inputStatement));
           var_dump($stmt->errorInfo);
           //disconnect
           //$result_set = $stmt->fetchAll(PDO::FETCH_ASSOC);
           while ($row = $stmt->fetch()){
            echo $row; echo "</br>";
           }
           var_dump($result_set);
           foreach($result_set as $tuple) {
                    echo "<font color='white'>$tuple[ssn] $tuple[f_name] $tuple[m_name] $tuple[l_name]</font>";
           }
           $db = null;
       } catch(PDOException $e) {
           die('Exception : '.$e->getMessage());
       }
    }
    ?>
    </body>
</html>
