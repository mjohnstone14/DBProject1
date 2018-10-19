<!DOCTYPE html>
<html>
    <head>
        <link rel ="stylesheet" type = "text/css" href="core.css">
        <h1>Query Form</h1>
    </head>
    <body>
    <div class="content">
        <form action="showPassengers.php" method="get">
            SSN: <input name="passenger_ssn" type="text" size="25" />

            <input name="mySubmit" type="submit" value="submit" />
        </form>
    </div>
    <?php
    try {
        //path to the SQLite database file
        $db_file = './myDB/airport.db';

        $db = new PDO('sqlite:' . $db_file);
        //set errormode to use exceptions
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $stmt = $db->prepare("SELECT * FROM PASSENGERS where ssn = ?");
      
    } catch(PDOException $e) {
        die('Exception : '.$e->getMessage());
    }
    ?>
    </body>
</html>
