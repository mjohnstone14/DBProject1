<!DOCTYPE html>
<html>
    <head>
        <link rel ="stylesheet" type = "text/css" href="core.css">
        <h1>Query Form</h1>
    </head>
    <body>
    <div class="content">
        <form action="queryPage.php" method="POST">
            select from passengers where  <input name="statement" type="text" size="75" />
          <input name="submit" type="submit">
        </form>
    </div>
    <?php
    if(isset($_POST["statement"])){
       try {
           //path to the SQLite database file
           $db_file = './myDB/airport.db';

           $db = new PDO('sqlite:' . $db_file);
           //set errormode to use exceptions
           $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
           $stmt = $db->prepare('SELECT * from  passengers  where :statement');
           //bind to post values
           $stmt->bindParam(':statement',$_POST["statement"]);
           $stmt->execute();
           //disconnect
           $result_set = $stmt->fetchAll(PDO::FETCH_ASSOC);
           var_dump($result_set);
           foreach($result_set as $tuple) {
                    echo "<font color='blue'>$tuple[ssn]</font> $tuple[f_name] $tuple[m_name] $tuple[l_name]";
           }
           $db = null;
       } catch(PDOException $e) {
           die('Exception : '.$e->getMessage());
       }
    }
    ?>
    </body>
</html>
