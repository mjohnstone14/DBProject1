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
<<<<<<< HEAD
    } else if(empty($last_name) || !is_string($last_name) || preg_match('#[0-9]#', $last_name)) {
=======
    } else if(empty($last_name) || !is_string($last_name) || preg_match('#[0-9]#', $last_name$
>>>>>>> 33cfbd13f176d1700381c62a06597c142c86b1da
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
<<<<<<< HEAD
    } 
=======
    }
>>>>>>> 33cfbd13f176d1700381c62a06597c142c86b1da

    if(isset($error)) {
        header('Location: passengerForm.php?'.$error);
        exit;
    } else {

        //echo $first_name;
        //some possible code
        try{
        $db = new PDO('sqlite:./myDB/airport.db');
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $stmt = $db->prepare("INSERT INTO passengers (f_name,m_name,l_name,ssn) VALUES (f_name,:m_name,:l_name,:ssn)");

        //bind to post values

        $stmt->bindParam(':f_name', $first_name);
        $stmt->bindParam(':m_name', $m_name);
        $stmt->bindParam(':l_name', $last_name);
<<<<<<< HEAD
        $stmt->bindParam(':ssn',$ssn); 
=======
        $stmt->bindParam(':ssn',$ssn);
>>>>>>> 33cfbd13f176d1700381c62a06597c142c86b1da
        $stmt->execute();
        //disconnect
        $db = null;
        } catch(PDOException $e) {
         die('Exception : '.$e->getMessage());
         }
        $message = "success";
        header("Location: showPassengers.php?".$message);
<<<<<<< HEAD
        
=======

>>>>>>> 33cfbd13f176d1700381c62a06597c142c86b1da
    }
}


?>
