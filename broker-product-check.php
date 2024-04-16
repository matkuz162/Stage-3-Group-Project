<?php
    session_start();
    include "connection.php";
    //Retrieve broker ID
   if(isset($_SESSION['Broker_ID'])) {
        $brokerId = $_SESSION['Broker_ID'];
        //Function to validate input data
        function validate($data){
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        } 
        $isDraft = isset($_POST['isDraft']) ? 1 : 0;
        //Check if the form was submitted
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $pname = validate($_POST['product-name']);
            $baseInt = validate($_POST['base-interest']);
            $expectedInc = validate($_POST['expected-income']);
            $expectedOutg = validate($_POST['expected-outgoings']);
            $expectedCredit = validate($_POST['expected-credit']);
            $expectedOcc = validate($_POST['expected-occupation']);
            $loanRatio = validate($_POST['mtv-ratio']);
            
        if (isset($_POST['createProduct'])) {
            createProduct($brokerId,$pname,$expectedInc,$expectedOutg,$expectedCredit,$expectedOcc,$baseInt,$loanRatio,$isDraft, $db);
        } else if (isset($_POST['updateProduct'])) {
            $productId = validate($_POST['product-id']);
            updateProduct($productId,$pname,$expectedInc,$expectedOutg,$expectedCredit,$expectedOcc,$baseInt,$loanRatio,$isDraft, $db);
        }else{
            header("Location: broker-product-creation.php?error=no form sent or incorrect name");
            exit();
            die();
        }
    } else{
            header("Location: broker-product-creation.php?error=unable to retrieve form");
            exit();
            die();
    }
} else {
    header("Location: LogIn.php");
    exit();
}
    function createProduct($brokerId,$pname,$expectedInc,$expectedOutg,$expectedCredit,$expectedOcc,$baseInt,$loanRatio,$isDraft, $db){
        if (empty($pname)|| empty($baseInt)|| empty($expectedInc)||empty($expectedOutg)|| empty($expectedCredit)||empty($expectedOcc) ||empty($loanRatio) ){
            header("Location: Broker-product-creation.php?error=All required fields must be entered");
            exit();
        }
        try {
            $stmt = $db->prepare("INSERT INTO Product (Broker_ID, name, expected_income, expected_outgoings, expected_credit_score, expected_employment_type, interest_rate, mtv_ratio, aDraft) VALUES (?,?,?,?,?,?,?,?,?)");
            $stmt->execute([$brokerId,$pname, $expectedInc, $expectedOutg, $expectedCredit, $expectedOcc, $baseInt, $loanRatio, $isDraft]);
            header("Location: broker-manage-product.php?success=Product successfully created");
            exit();
        } catch(PDOException $e) {
            return false;
        }

    }
    function updateProduct($productId,$pname,$expectedInc,$expectedOutg,$expectedCredit,$expectedOcc,$baseInt,$loanRatio,$isDraft, $db){
        try {
            // Constructing the SQL Query based on non-empty fields
        $query = "UPDATE Product SET ";
        $params = array();

        if (!empty($pname)) {
            $query .= "name=?, ";
            $params[] = $pname;
        }
        if (!empty($expectedInc)) {
            $query .= "expected_income=?, ";
            $params[] = $expectedInc;
        }
        if (!empty($expectedOutg)) {
            $query .= "expected_outgoings=?, ";
            $params[] = $expectedOutg;
        }
        if (!empty($expectedCredit)) {
            $query .= "expected_credit_score=?, ";
            $params[] = $expectedCredit;
        }
        if (!empty($expectedOcc)) {
            $query .= "expected_employment_type=?, ";
            $params[] = $expectedOcc;
        }
        if (!empty($baseInt)) {
            $query .= "interest_rate=?, ";
            $params[] = $baseInt;
        }
        if (!empty($loanRatio)) {
            $query .= "mtv_ratio=?, ";
            $params[] = $loanRatio;
        }
        
        // Check if any fields were provided to update
        if (empty($params)) {
            header("Location: Broker-product-update.php?id=$productId&error=No fields to update");
            exit();
        }

        // Removing space from the query
        $query = rtrim($query, ", ");

        // Add the WHERE clause for the query
        $query .= " WHERE Product_ID=?";
        $params[] = $productId;

        // Prepare and execute the statement
        $stmt = $db->prepare($query);
        $stmt->execute($params);

            header("Location: broker-manage-product.php?success=Product updated successfully");
            exit();
        } catch(PDOException $e) {
            return false;
        }
    }
?>