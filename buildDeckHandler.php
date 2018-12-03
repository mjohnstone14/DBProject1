<?php
	session_start();
	$user = $_SESSION['username'];
	//for now just insert 1 card each
    $amount = 1;

    //we need to know how many cards the user has created


    $db_file = '../myDB/spitting.db';
    $db = new PDO('sqlite:' . $db_file);

    $stmt = $db->prepare('SELECT count(*) as count FROM Card where creator=:creator');
    $stmt->bindParam(':creator',$user);
    $stmt->execute();
    $result_set = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $created_amount = null;
    foreach($result_set as $count){
    	$created_amount = $count['count'];
    }

    //set errormode to use exceptions
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $num=0;
    //loop through all POST card variables to insert each 
    //selected card into the owns table
    while($num<count;){
    	if(isset($_POST['card'.$num])){
   		$cardID = $_POST['card'.$num];
    	echo "cardID is now $cardID";
    	$stmt = $db->prepare("INSERT into Owns VALUES(:username,:cardID,:amount)");
    	$stmt->bindParam(':username', $user);
    	$stmt->bindParam(':cardID', $cardID);
    	$stmt->bindParam(':amount', $amount);
    	$stmt->execute();
    }
    	$num+=1;

    }

    header("Location: userHome.php");




?>