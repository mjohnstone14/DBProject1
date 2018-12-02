<?php
	session_start();
	$creator = $_SESSION['username'];
    $db_file = '../myDB/spitting.db';
    $db = new PDO('sqlite:' . $db_file);

    //set errormode to use exceptions
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $num=0;
    //loop through all POST card variables to insert each 
    //selected card into the owns table
    while(isset($_POST['card'.$num])){
    $cardID = $_POST['card'.$num];
    $stmt = $db->prepare('INSERT into Owns (username,cardID,amount) values');

    }




?>