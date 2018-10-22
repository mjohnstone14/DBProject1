<?php
if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $statement=$_POST["statement"];
    $error = NULL;
    $message = NULL;

    if(empty($statement)) {
        $error = "error=true";
      }

    if(isset($error)) {
        header("Location: queryPage.php?".$error);
        exit;
    } else {

        //echo $first_name;
        //some possible code
        if(isset($_POST["statement"])){
           try {
               //path to the SQLite database file
               $db_file = './myDB/airport.db';

               $db = new PDO('sqlite:' . $db_file);
               //set errormode to use exceptions
               $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
               $stmt = $db->prepare("SELECT * from  passengers WHERE :statement;");
               //bind to post values
               $stmt->bindParam(':statement',$statement);
               $stmt->execute();
               //disconnect
               $result_set = $stmt->fetchAll(PDO::FETCH_ASSOC);
               //foreach($result_set as $tuple) {
                 //       echo "<font color='blue'>$tuple[ssn]</font> $tuple[f_name] $tuple[m_name] $tuple[l_name]";
               //}
               $db = null;
           } catch(PDOException $e) {
               die('Exception : '.$e->getMessage());
           }
        }
        $message = "success";
        header("Location: queryPage.php?results=$result_set&statement=$statement");

    }
}


?>
