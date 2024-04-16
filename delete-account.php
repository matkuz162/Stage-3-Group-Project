<?php
session_start();
include 'connection.php';

$Broker_ID = $_SESSION['Broker_ID'];

$sql = "DELETE FROM Broker WHERE Broker_ID = :Broker_ID";

$stmt = $db->prepare($sql);

if ($stmt) {
    $stmt->bindParam(':Broker_ID', $Broker_ID, PDO::PARAM_INT);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        header("Location: Home.php");
        exit();
    } else {
        echo "No data found for the user.";
    }

    $stmt->closeCursor();
} else {
    echo "Error: " . $db->errorInfo()[2];
}

$db = null;
?>
