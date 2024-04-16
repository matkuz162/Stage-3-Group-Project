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
            header("Location: broker-product-creation.php");
            exit();
            die();
        }
    } else{
            header("Location: broker-product-creation.php");
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
            return $db->lastInsertId();
        } catch(PDOException $e) {
            return false;
        }

    }
    function updateProduct($productId,$pname,$expectedInc,$expectedOutg,$expectedCredit,$expectedOcc,$baseInt,$loanRatio,$isDraft, $db){
        if (empty($pname)|| empty($baseInt)|| empty($expectedInc)||empty($expectedOutg)|| empty($expectedCredit)||empty($expectedOcc)|| empty($loanRatio)){
            header("Location: Broker-product-creation.php?error=All required fields must be entered");
            exit();
        }
        try {
            $stmt = $db->prepare("UPDATE Product SET 
                                    name=?, 
                                    expected_income=?, 
                                    expected_outgoings=?, 
                                    expected_credit_score=?, 
                                    expected_employment_type=?, 
                                    interest_rate=?, 
                                    mtv_ratio=?, 
                                    aDraft=? WHERE Product_ID=?"); 
            $stmt->execute([$pname, $expectedInc, $expectedOutg, $expectedCredit, $expectedOcc, $baseInt, $loanRatio, $isDraft, $productId]);
            return true;
            header("Location: broker-manage-product.php?success=Product updated successfully");
            exit();
        } catch(PDOException $e) {
            return false;
        }
    }
?>