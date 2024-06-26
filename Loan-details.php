<?php
session_start();

include 'connection.php';


if (!isset($_SESSION['RegisteredUser_ID'])) {
    
    header('Location: login.php');
    exit();
}


$RegisteredUser_ID = $_SESSION['RegisteredUser_ID'];


if (isset($_POST['loan-submit'])) {
    try {
        
        $mortgage_reason = $_POST['mortgage_reason'];
        $estimated_property_value = $_POST['estimated_property_value'];
        $borrow_amount = $_POST['borrow_amount'];
        $mortgage_term = $_POST['mortgage_term'];

        
        $ltv_ratio = ($borrow_amount / $estimated_property_value) * 100;

        
        $check_loan_details_query = "SELECT * FROM financialdetails WHERE RegisteredUser_ID = :RegisteredUser_ID";
        $stmt_check = $db->prepare($check_loan_details_query);
        $stmt_check->bindParam(':RegisteredUser_ID', $RegisteredUser_ID, PDO::PARAM_INT);
        $stmt_check->execute();
        $loanDetails = $stmt_check->fetch(PDO::FETCH_ASSOC);

        if ($loanDetails) {
            
            $update_loan_query = "UPDATE financialdetails 
                                  SET mortgage_reason = :mortgage_reason,
                                      estimated_property_value = :estimated_property_value,
                                      borrow_amount = :borrow_amount,
                                      mortgage_term = :mortgage_term,
                                      user_ltv = :ltv_ratio
                                  WHERE RegisteredUser_ID = :RegisteredUser_ID";
            $stmt = $db->prepare($update_loan_query);
        } else {
            
            $insert_loan_query = "INSERT INTO financialdetails (RegisteredUser_ID, mortgage_reason, estimated_property_value, borrow_amount, mortgage_term, user_ltv) 
                                  VALUES (:RegisteredUser_ID, :mortgage_reason, :estimated_property_value, :borrow_amount, :mortgage_term, :ltv_ratio)";
            $stmt = $db->prepare($insert_loan_query);
        }

        
        $stmt->bindParam(':RegisteredUser_ID', $RegisteredUser_ID, PDO::PARAM_INT);
        $stmt->bindParam(':mortgage_reason', $mortgage_reason);
        $stmt->bindParam(':estimated_property_value', $estimated_property_value);
        $stmt->bindParam(':borrow_amount', $borrow_amount);
        $stmt->bindParam(':mortgage_term', $mortgage_term);
        $stmt->bindParam(':ltv_ratio', $ltv_ratio);

        
        if ($stmt->execute()) {
            echo "Loan details updated successfully";
        } else {
            echo "Error updating loan details: " . $stmt->errorInfo()[2];
        }
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
    }
}


$retrieve_loan_query = "SELECT * FROM financialdetails WHERE RegisteredUser_ID = :RegisteredUser_ID";
$stmt_retrieve = $db->prepare($retrieve_loan_query);
$stmt_retrieve->bindParam(':RegisteredUser_ID', $RegisteredUser_ID, PDO::PARAM_INT);
$stmt_retrieve->execute();
$loanDetails = $stmt_retrieve->fetch(PDO::FETCH_ASSOC);


if (!$loanDetails) {
    $loanDetails = array(
        'mortgage_reason' => '',
        'estimated_property_value' => '',
        'borrow_amount' => '',
        'mortgage_term' => '',
        'user_ltv' => ''
    );
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <title>Loan Details</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
</head>

<body>

<header class="flex-container">
    <a href="MemberViewProducts.php"> <img src="Assets/logo.png" alt="Rose Mortgage"> </a>
    <div>
        <ul class="nav-links">
            <li><a href="Loan-details.php">Loan Details</a></li>
            <li><a href="MemberViewProducts.php">Available Products</a></li>
            <li><a href="MemberChosenProducts.php">Chosen Products</a></li>
            <li><a href="MemberAccountDetails.php">Account Details</a></li>
            <li><a href="home.php">Sign Out</a></li>
        </ul>
    </div>
</header>

<main>

    <div class="reg">
        <h2 class="mb-4"><b>Loan Details:</b></h2>
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">          
            <div class="form-group">
                <label for="mortgage_reason" class="form-label">Reason for Mortgage:</label>
                <select class="form-select" id="mortgage_reason" name="mortgage_reason" required>
                    <option value="first_time_buyer" <?php if ($loanDetails['mortgage_reason'] == 'first_time_buyer') echo 'selected'; ?>>First Time Buyer</option>
                    <option value="remortgage" <?php if ($loanDetails['mortgage_reason'] == 'remortgage') echo 'selected'; ?>>Remortgage</option>
                    <option value="moving_home" <?php if ($loanDetails['mortgage_reason'] == 'moving_home') echo 'selected'; ?>>Moving Home</option>
                </select>
            </div>
            <div class="form-group">
                <label for="estimated_property_value" class="form-label">Estimated Property Value:</label>
                <input type="number" class="form-control" id="estimated_property_value" name="estimated_property_value" value="<?php echo $loanDetails['estimated_property_value']; ?>" required>
            </div>
            <div class="form-group">
                <label for="borrow_amount" class="form-label">Amount to Borrow (minimum £6000):</label>
                <input type="number" class="form-control" id="borrow_amount" name="borrow_amount" value="<?php echo $loanDetails['borrow_amount']; ?>" min="6000" required>
            </div>
            <div class="form-group">
                <label for="mortgage_term" class="form-label">Mortgage Term (years):</label>
                <input type="number" class="form-control" id="mortgage_term" name="mortgage_term" value="<?php echo $loanDetails['mortgage_term']; ?>" required>
            </div>
            <div class="form-group">
                <label for="ltv_ratio" class="form-label">Loan-to-Value (LTV) Ratio:</label>
                <input type="text" class="form-control" id="ltv_ratio" name="ltv_ratio" value="<?php echo isset($loanDetails['user_ltv']) ? $loanDetails['user_ltv'] : ''; ?>" readonly>
            </div>
            <button type="submit" name="loan-submit">Save Loan Details</button>        
        </form>
    </div>

</main>

<footer>

</footer>



<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>


</body>

</html>
