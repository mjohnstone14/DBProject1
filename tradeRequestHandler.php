<?php 
session_start();

    $tradeID = time();
    $initiator = $_SESSION['username'];
    $receiver = $_POST['receiver'];
    $card1 = $_POST['card1'];
    $card2 = $_POST['card2'];

    $db = new PDO('sqlite:../myDB/spitting.db');
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $stmt = $db->prepare("INSERT INTO Trades (tradeID,initiator,receiver,cardID1,cardID2) VALUES (:tradeID,:initiator,:receiver,:cardID1,:cardID2)");
    $stmt->bindParam(':tradeID', $tradeID);
    $stmt->bindParam(':initiator', $initiator);
    $stmt->bindParam(':receiver', $receiver);
    $stmt->bindParam(':cardID1', $card1);
    $stmt->bindParam(':cardID2', $card2);
    $stmt->execute();
    header("tradeView.php");



?>