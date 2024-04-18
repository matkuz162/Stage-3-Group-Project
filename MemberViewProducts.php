<?php

require_once 'connection.php';

session_start();
include 'connection.php'; 

if (!isset($_SESSION['RegisteredUser_ID'])) {
    
  header('Location: login.php');
  exit();
}

$RegisteredUser_ID = $_SESSION['RegisteredUser_ID'];


if (isset($_POST['compare'])) {
    $productID = $_POST['Product_id'];
    echo "Product ID: " . $productID;
    $RegisteredUser_ID = $_SESSION['RegisteredUser_ID'];

    $sql = "INSERT INTO Quote (Product_ID, RegisteredUser_ID, initial_monthly_repayments, secondary_monthly_repayments, total_repayment, product_starred) 
            VALUES (:productID, :RegisteredUser_ID, 100, 100, 100, 0)";
    
    $statement = $db->prepare($sql);
    $statement->bindParam(':productID', $productID);
    $statement->bindParam(':RegisteredUser_ID', $RegisteredUser_ID);
    $statement->execute();

    $updateSql = "UPDATE Quote SET product_starred = 1 WHERE Product_ID = :Product_id AND RegisteredUser_ID = :RegisteredUser_ID";
    $updateStatement = $db->prepare($updateSql);
    $updateStatement->bindParam(':Product_id', $productID);
    $updateStatement->bindParam(':RegisteredUser_ID', $RegisteredUser_ID);
    $updateStatement->execute();
}


$sql = "SELECT *
        FROM Product
        LEFT JOIN financialdetails ON (financialdetails.RegisteredUser_ID = Product.Broker_ID)
        LEFT JOIN RegisteredUser ON (RegisteredUser.RegisteredUser_ID = financialdetails.RegisteredUser_ID)
        LEFT JOIN Quote ON (Quote.Product_ID = Product.Product_ID)
        WHERE Product.expected_income <= (SELECT annual_income FROM financialdetails WHERE RegisteredUser_ID = $RegisteredUser_ID)
        AND Product.expected_outgoings <= (SELECT monthly_spending_amounts FROM financialdetails WHERE RegisteredUser_ID = $RegisteredUser_ID)
        AND Product.expected_credit_score <= (SELECT credit_score FROM financialdetails WHERE RegisteredUser_ID = $RegisteredUser_ID);";

$statement = $db->query($sql);

?>





<!DOCTYPE html>
<html lang="en">


<head>
  <title>Rose Mortgage</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <link rel="stylesheet" href="style.css">
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



<div class="largecontainer">
    <div class="flex-container">
        <div><h1><b>Available Products:</b></h1></div>


        <div>
            <div class="input-group mb-3">
                <label class="input-group-text" for="inputGroupSelect01">Sort By:</label>
                <select class="form-select" id="inputGroupSelect01">
                    <option selected>Monthly Payments</option>
                    <option value="1">Total Repayment</option>
                    <option value="2">Initial Rate</option>
                    <option value="3">Initial Period</option>
                </select>
            </div>

        </div>

    </div>
    


    
    

    <div class="flex-table">
        <?php
        while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
            $monthlyInterestRate = $row["initial_interest_rate"] / 100/ 12;
            $months = $row["YearRate"]*12;
            $monthlyPayments = $row["initial_interest_rate"] * ($monthlyInterestRate * pow((1 + $monthlyInterestRate), $months)) / (pow((1 + $monthlyInterestRate), $months) - 1);
            $rounded = round($monthlyPayments,2);
        ?>
        <div class="card" style="width: 18rem; margin-bottom: 50px;">
            <div class="card-body">
                <h5 class="card-title"><b><?php echo $row["YearRate"] . " Year " . $row["ProductType"]; ?></b></h5>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item"><b>Initial Monthly Cost: </b><?php echo $rounded; ?></li>
                    <li class="list-group-item"><b>Initial rate: </b><?php echo $row["initial_interest_rate"]; ?></li>
                    <li class="list-group-item"><b>Product fee: </b><?php echo $row["ProductFee"]; ?></li>
                </ul>
                <br>
                <form method="post" action="">
                    <input type="hidden" name="Product_id" value="<?php echo $row['Product_ID']; ?>">
                    <button type="submit" name="compare" class="btn btn-primary">Compare</button>
                </form>
            </div>
        </div>
        <?php
        }
        ?>

    </div>
</div>

</div>
</div>


<footer>

</footer>


</body>



</html>
