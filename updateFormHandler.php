<?php
if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $first_name = $_POST["first_name"];
    $m_name = $_POST["m_name"];
    $last_name = $_POST["last_name"];
    $ssn = $_POST["ssn"];
    $oldssn =$_POST["oldssn"];
    $error = NULL;

    if(empty($first_name) || !is_string($first_name) || preg_match('#[0-9]#', $first_name)) {
        $error = "error=true";
    } else if(empty($last_name) || !is_string($first_name) || preg_match('#[0-9]#', $last_name)) {
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
        header('Location: updateForm.php?' . $error);
    } else {

        //echo $first_name;
        //some possible code
        try{
        $db = new PDO('sqlite:./myDB/airport.db');
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $stmt = $db->prepare("UPDATE passengers set f_name=:f_name,m_name=:m_name,l_name=:l_name,ssn=:ssn where ssn=:oldssn");
        //bind to post values
        $stmt->bindParam(':f_name', $first_name);
        $stmt->bindParam(':m_name', $m_name);
        $stmt->bindParam(':l_name', $last_name);
        $stmt->bindParam(':ssn',$ssn);
        $stmt->bindParam(':oldssn',$oldssn);
        $stmt->execute();
        //disconnect
        $db = null;
        } catch(PDOException $e) {
         die('Exception : '.$e->getMessage());
         }
        $message = "success";
        header("Location: showPassengers.php?".$message);

    }
}

