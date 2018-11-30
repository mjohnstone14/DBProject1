<?php 
session_start();

    $tradeID = $_POST['tradeID'];
    $initiator = null;
    $receiver = null;
    $cardID1 = null;
    $cardID2 = null;

    
    //find the trade
    $db = new PDO('sqlite:../myDB/spitting.db');
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $stmt = $db->prepare("SELECT * FROM Trades WHERE tradeID=:tradeID");
    $stmt->bindParam(':tradeID', $tradeID);
    $stmt->bindParam(':initiator', $initiator);
    $stmt->bindParam(':receiver', $receiver);
    $stmt->bindParam(':cardID1', $card1);
    $stmt->bindParam(':cardID2', $card2);
    $stmt->execute();
    $result_set = $stmt->fetchAll(PDO::FETCH_ASSOC);

    //store the variables for the next query
    foreach($result_set as $trade){
        $initiator = $trade['initiator'];
        $receiver = $trade['receiever'];
        $cardID1 = $trade['cardID1'];
        $cardID2 = $trade['cardID1'];
    }

    
    //update the owns table. this does not yet account for if one of the users doesn't own the card in question yet.
    $stmt = $db->prepare( "UPDATE Owns set amount=amount-1, where username=:initiator AND cardID = cardID1;
                          UPDATE Owns set amount=amount+1, where username=:initiator AND cardID = cardID2;
                          UPDATE Owns set amount=amount-1, where username=:receiver AND cardID = cardID2;
                          UPDATE Owns set amount=amount+1, where username=:receiver AND cardID = cardID1;");
        //bind to post values
    $stmt->bindParam(':initiator', $initiator);
    $stmt->bindParam(':receiver', $receiver);
    $stmt->bindParam(':cardID1', $cardID1);
    $stmt->bindParam(':cardID2', $cardID2);
    $stmt->execute();


?>