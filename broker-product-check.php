<?php
    session_start();
    include "connection.php";
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
        $loanRatio = validate($_POST['loan-ratio']);
        $IsDraft = isset($_POST['isDraft']) ? 1 : 0;

        function createProduct($pname,$pdesc,$baseInt,$expectedInc,$expectedOutg,$expectedCredit,$expectedOcc,$loanRatio,$isDraft){
            
        }
        function createProductDraft($pname,$pdesc,$baseInt,$expectedInc,$expectedOutg,$expectedCredit,$expectedOcc,$loanRatio,$isDraft){
    
        }
        function updateProduct($productId,$pname,$pdesc,$baseInt,$expectedInc,$expectedOutg,$expectedCredit,$expectedOcc,$loanRatio,$isDraft){
    
        }
    if (isset($_POST['createProduct'])) {

    } else if (isset($_POST['createProductDraft'])) {
        

    } else if (isset($_POST['updateProduct'])) {
    
    }else{
        header("Location: broker-product-creation.php");
        exit();
    }
 } else{
        header("Location: broker-product-creation.php");
        exit();
    }
?>