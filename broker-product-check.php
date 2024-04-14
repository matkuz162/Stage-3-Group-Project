<?php
    session_start();
    include "connection.php";
    //Retrieve broker ID
    /*if(isset($_SESSION['Broker_ID'])) {
        $brokerId = $_SESSION['Broker_ID'];*/
        //Function to validate input data
        function validate($data){
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        } 
        
        //Check if the form was submitted
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            
            $productId = validate($_POST['product-id']);
            $pname = validate($_POST['product-name']);
            $pdesc = validate($_POST['product-desc']);
            $baseInt = validate($_POST['base-interest']);
            $expectedInc = validate($_POST['expected-income']);
            $expectedOutg = validate($_POST['expected-outgoings']);
            $expectedCredit = validate($_POST['expected-credit']);
            $expectedOcc = validate($_POST['expected-occupation']);
            $loanRatio = validate($_POST['mtv-ratio']);
            $IsDraft = isset($_POST['isDraft']) ? 1 : 0;
       
            
        if (isset($_POST['createProduct'])) {
            createProduct($brokerId,$pname,$pdesc,$baseInt,$expectedInc,$expectedOutg,$expectedCredit,$expectedOcc,$loanRatio,$isDraft, $db);
        } else if (isset($_POST['createProductDraft'])) {
            createProductDraft($brokerId,$pname,$pdesc,$baseInt,$expectedInc,$expectedOutg,$expectedCredit,$expectedOcc,$loanRatio,$isDraft, $db);
        } else if (isset($_POST['updateProduct'])) {
            updateProduct($productId,$pname,$pdesc,$baseInt,$expectedInc,$expectedOutg,$expectedCredit,$expectedOcc,$loanRatio,$isDraft, $db);
        }else{
            header("Location: broker-product-creation.php");
            exit();
        }
    } else{
            header("Location: broker-product-creation.php");
            exit();
        }
/*} else {
    header("Location: LogIn.php");
    exit();
}*/
    function createProduct($brokerId,$pname,$pdesc,$baseInt,$expectedInc,$expectedOutg,$expectedCredit,$expectedOcc,$loanRatio,$isDraft, $db){
        if (empty($pname)|| empty($pdesc)|| empty($baseInt)|| empty($expectedInc)||empty($expectedOutg)|| empty($expectedCredit)||empty($expectedOcc)|| empty($loanRatio)){
            header("Location: Broker-product-creation.php?error=All required fields must be entered");
            exit();
        }
        try {
            $stmt = $db->prepare("INSERT INTO Product (Broker_ID, name, description, expected_income, expected_outgoings, expected_credit_score, expected_employment_type, interest_rate, mtv_ratio, isDraft) VALUES (?,?,?,?,?,?,?,?,?,?,0)");
            $stmt->execute($brokerId,$pname, $pdesc, $expectedInc, $expectedOutg, $expectedCredit, $expectedOcc, $baseInt, $loanRatio);
            return $db->lastInsertId();
        } catch(PDOException $e) {
            return false;
        }
    }
    function createProductDraft($brokerId,$pname,$pdesc,$baseInt,$expectedInc,$expectedOutg,$expectedCredit,$expectedOcc,$loanRatio,$isDraft, $db){
        if (empty($pname)|| empty($pdesc)|| empty($baseInt)|| empty($expectedInc)||empty($expectedOutg)|| empty($expectedCredit)||empty($expectedOcc)|| empty($loanRatio)){
            header("Location: Broker-product-creation.php?error=All required fields must be entered");
            exit();
        }
        try {
            $stmt = $db->prepare("INSERT INTO Product (Broker_ID, name, description, expected_income, expected_outgoings, expected_credit_score, expected_employment_type, interest_rate, mtv_ratio, isDraft) VALUES (?,?,?,?,?,?,?,?,?,?,1)");
            $stmt->execute($brokerId,$pname, $pdesc, $expectedInc, $expectedOutg, $expectedCredit, $expectedOcc, $baseInt, $loanRatio);
            return $db->lastInsertId();
        } catch(PDOException $e) {
            return false;
        }
    }
    function updateProduct($productId,$pname,$pdesc,$baseInt,$expectedInc,$expectedOutg,$expectedCredit,$expectedOcc,$loanRatio,$isDraft, $db){
        if (empty($pname)|| empty($pdesc)|| empty($baseInt)|| empty($expectedInc)||empty($expectedOutg)|| empty($expectedCredit)||empty($expectedOcc)|| empty($loanRatio)){
            header("Location: Broker-product-creation.php?error=All required fields must be entered");
            exit();
        }
        try {
            $stmt = $db->prepare("UPDATE Product SET 
                                    name=?, 
                                    description=?, 
                                    expected_income=?, 
                                    expected_outgoings=?, 
                                    expected_credit_score=?, 
                                    expected_employment_type=?, 
                                    interest_rate=?, 
                                    mtv_ratio=?, 
                                    isDraft=? WHERE Product_ID=?"); 
            $stmt->execute($pname, $pdesc, $expectedInc, $expectedOutg, $expectedCredit, $expectedOcc, $baseInt, $loanRatio);
            return true;
        } catch(PDOException $e) {
            return false;
        }
    }
    function deleteProduct($productId,$pname,$pdesc,$baseInt,$expectedInc,$expectedOutg,$expectedCredit,$expectedOcc,$loanRatio,$isDraft, $db){

    } 
?>