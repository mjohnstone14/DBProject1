<?php
	session_start();
	$user = $_SESSION['username'];
	//for now just insert 1 card each
    $amount = 1;

    $db_file = '../myDB/spitting.db';
    $db = new PDO('sqlite:' . $db_file);

    //set errormode to use exceptions
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $num=0;
    //loop through all POST card variables to insert each 
    //selected card into the owns table
    while(isset($_POST['card'.$num])){
    $cardID = $_POST['card'.$num];
    echo "cardID is now $cardID";
    $stmt = $db->prepare("INSERT into Owns VALUES(:username,:cardID,:amount)");
    $stmt->bindParam(':username', $user);
    $stmt->bindParam(':cardID', $cardID);
    $stmt->bindParam(':amount', $amount);
    $stmt->execute();
    }

    //header("Location: userHome.php");




?>