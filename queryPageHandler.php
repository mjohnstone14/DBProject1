<?php
if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $first_name = $_POST["first_name"];
    $m_name = $_POST["m_name"];
    $last_name = $_POST["last_name"];
    $ssn = $_POST["ssn"];
    $error = NULL;
    $message = NULL;

    if(empty($first_name) || !is_string($first_name) || preg_match('#[0-9]#', $first_name)) {
        $error = "error=true";
    } else if(empty($last_name) || !is_string($last_name) || preg_match('#[0-9]#', $last_name)) {
        if(isset($error)) {
            $error .= "&error2=true";
        } else {
            $error = "error2=true";
        }
    } else if(empty($ssn)) {
        if(isset($error)) {
            $error .= "&error3=true";
        } else {
            $error = "error3=true";
        }
    }
    else if(strlen($ssn) != 11) {
        if(isset($error)) {
            $error .= "&error4=true";
        } else {
            $error = "error4=true";
        }
    }

    if(isset($error)) {
        header('Location: queryPage.php?'.$error);
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
               $stmt = $db->prepare('SELECT * from  passengers WHERE :statement;');
               //bind to post values
               $stmt->bindParam(":statement",$_POST["statement"]);
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
        $message = "success";
        header("Location: queryPage.php?".$message);

    }
}


?>
