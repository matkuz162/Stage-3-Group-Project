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
            $yearRate = validate($_POST['year-rate']);
            $productType = validate($_POST['product-type']);
            $baseInt = validate($_POST['base-interest']);
            $productFee = validate($_POST['product-fee']);
            $expectedInc = validate($_POST['expected-income']);
            $expectedOutg = validate($_POST['expected-outgoings']);
            $expectedCredit = validate($_POST['expected-credit']);
            $loanRatio = validate($_POST['ltv-ratio']);
            
        if (isset($_POST['createProduct'])) {
            createProduct($brokerId,$yearRate, $productType, $expectedInc,$expectedOutg,$expectedCredit,$baseInt,$productFee,$loanRatio,$isDraft, $db);
        } else if (isset($_POST['updateProduct'])) {
            $productId = validate($_POST['product-id']);
            updateProduct($productId,$yearRate, $productType, $expectedInc,$expectedOutg,$expectedCredit,$baseInt, $productFee,$loanRatio,$isDraft, $db);
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
    function createProduct($brokerId,$yearRate, $productType, $expectedInc,$expectedOutg,$expectedCredit,$baseInt, $productFee,$loanRatio,$isDraft, $db){
        if (empty($yearRate)|| empty($baseInt)|| empty($expectedInc)||empty($expectedOutg)|| empty($expectedCredit)||empty($productType) || empty($loanRatio)){
            header("Location: Broker-product-creation.php?error=All required fields must be entered");
            exit();
        }
        try {
            $stmt = $db->prepare("INSERT INTO Product (Broker_ID, YearRate, ProductType, expected_income, expected_outgoings, expected_credit_score, initial_interest_rate, ProductFee, ltv_ratio, aDraft) VALUES (?,?,?,?,?,?,?,?,?,?)");
            $stmt->execute([$brokerId,$yearRate, $productType, $expectedInc,$expectedOutg,$expectedCredit,$baseInt, $productFee,$loanRatio,$isDraft]);
            header("Location: broker-manage-product.php?success=Product successfully created");
            exit();
        } catch(PDOException $e) {
            return false;
        }

    }
    function updateProduct($productId,$yearRate, $productType, $expectedInc,$expectedOutg,$expectedCredit,$baseInt,$productFee,$loanRatio,$isDraft, $db){
        try {
            // Constructing the SQL Query based on non-empty fields
        $query = "UPDATE Product SET ";
        $params = array();

        if (!empty($yearRate)) {
            $query .= "YearRate=?, ";
            $params[] = $yearRate;
        }
        if (!empty($productType)) {
            $query .= "ProductType=?, ";
            $params[] = $productType;
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
        if (!empty($baseInt)) {
            $query .= "initial_interest_rate=?, ";
            $params[] = $baseInt;
        }
        if (isset($productFee)) {
            $query .= "ProductFee=?, ";
            $params[] = $productFee;
        }
        if (!empty($loanRatio)) {
            $query .= "ltv_ratio=?, ";
            $params[] = $loanRatio;
        }
        if (isset($isDraft)){
            $query .= "aDraft=?, ";
            $params[] = $isDraft;
        }
        // Check if any fields were provided to update
        if (empty($params)) {
            header("Location: Broker-product-update.php?id=$productId&error=No fields to update");
            exit();
        }

        // Removing space from the query
        $query = rtrim($query, ", ");

        // Add the WHERE clause for the query
        $query .= " WHERE Product_ID= ?";
        $params[] = $productId;

        // Prepare and execute the statement
        $stmt = $db->prepare($query);
        $stmt->execute($params);
        
        if ($stmt) {
            header("Location: broker-manage-product.php?success=Product updated successfully");
            exit();
        } else {
            header("Location: broker-manage-product.php?error=Failed to update product");
        }
        } catch(PDOException $e) {
            header("Location: broker-manage-product.php?error=Failed to update product: " . $e->getMessage());
            exit();
        }
    }
?>
