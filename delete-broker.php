<?php

include 'connection.php';


session_start();


$broker_id = $_SESSION['Broker_ID'];

try {

    $sqlBroker = "DELETE FROM Broker WHERE Broker_ID = ?";
 
    $stmtBroker = $db->prepare($sqlBroker);
    
    if ($stmtBroker) {
       
        $stmtBroker->bindParam(1, $broker_id);
        
      
        $stmtBroker->execute();
        
        
        $stmtBroker->closeCursor();
    } else {
        echo "Error preparing statement for Broker deletion: " . $db->errorInfo()[2];
    }

    
    $sqlProduct = "DELETE FROM Product WHERE Broker_ID = ?";
    
    $stmtProduct = $db->prepare($sqlProduct);
    
    if ($stmtProduct) {
      
        $stmtProduct->bindParam(1, $broker_id);
        
        
        $stmtProduct->execute();
        
      
        $stmtProduct->closeCursor();
    } else {
        echo "Error preparing statement for Product deletion: " . $db->errorInfo()[2];
    }
    
   
    header("Location: home.php");
    exit();
} catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>
