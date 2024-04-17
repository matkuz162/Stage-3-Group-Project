<?php

include 'connection.php';


session_start();


$RegisteredUser_ID = $_SESSION['RegisteredUser_ID'];

try {

    $sqlBroker = "DELETE FROM RegisteredUser WHERE RegisteredUser_ID = ?";
 
    $stmtBroker = $db->prepare($sqlBroker);
    
    if ($stmtBroker) {
       
        $stmtBroker->bindParam(1, $RegisteredUser_ID);
        
      
        $stmtBroker->execute();
        
        
        $stmtBroker->closeCursor();
    } else {
        echo "Error preparing statement for Broker deletion: " . $db->errorInfo()[2];
    }

    
    $sqlfinancialdetails = "DELETE FROM financialdetails WHERE RegisteredUser_ID = ?";
    
    $stmtfinancialdetails = $db->prepare($sqlfinancialdetails);
    
    if ($stmtfinancialdetails) {
      
        $stmtfinancialdetails->bindParam(1, $RegisteredUser_ID);
        
        
        $stmtfinancialdetails->execute();
        
      
        $stmtfinancialdetails->closeCursor();
    } else {
        echo "Error preparing statement for financialdetails deletion: " . $db->errorInfo()[2];
    }
    
   
    header("Location: home.php");
    exit();
} catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>
