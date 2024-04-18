<?php
require_once 'connection.php';
session_start();

$RegisteredUser_ID = $_SESSION['RegisteredUser_ID'];


if (isset($_POST['deselect'])) {
    
    $productID = $_POST['Product_id'];
    
    
    $updateSql = "UPDATE Quote SET product_starred = 0 WHERE Product_ID = :Product_id";
    $updateStatement = $db->prepare($updateSql);
    $updateStatement->bindParam(':Product_id', $productID);
    $updateStatement->execute();
}


$sql = "SELECT * 
        FROM Quote
        LEFT JOIN RegisteredUser ON (Quote.RegisteredUser_ID = RegisteredUser.RegisteredUser_ID)
        LEFT JOIN Product ON (Quote.Product_ID = Product.Product_ID)
        LEFT JOIN financialdetails ON (financialdetails.RegisteredUser_ID = RegisteredUser.RegisteredUser_ID)
        WHERE product_starred = 1
        AND RegisteredUser.RegisteredUser_ID = :registered_user_id
        ";

$statement = $db->prepare($sql);
$statement->bindParam(':registered_user_id', $RegisteredUser_ID);
$statement->execute();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Rose Mortgage</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
        crossorigin="anonymous">
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
            <div>
                <h1><b>Chosen Products:</b></h1>
            </div>


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
            <?php while ($row = $statement->fetch(PDO::FETCH_ASSOC)) { 
                $initialmonthlyInterestRate = $row["initial_interest_rate"] / 100/ 12;
                $initialmonths = $row["mortgage_term"]*12;
                $initialmonthlyPayments = $row["borrow_amount"] * (($initialmonthlyInterestRate * pow((1 + $initialmonthlyInterestRate), $initialmonths)) / (pow((1 + $initialmonthlyInterestRate), $initialmonths) - 1));
                $initialrounded = round($initialmonthlyPayments,2);

                $remainingmonthlyInterestRate = 7.5/100/12;
                $remainingmonths = ($row["mortgage_term"] - $row["YearRate"]) * 12;
                $remainingamount = ($row["borrow_amount"] - ($initialmonths * $initialmonthlyPayments));
                $remainingmonthlyPayments = $remainingamount * (($remainingmonthlyInterestRate * pow((1 + $remainingmonthlyInterestRate), $remainingmonths)) / (pow((1 + $remainingmonthlyInterestRate), $remainingmonths) - 1));
                $remainingrounded = round($remainingmonthlyPayments,2);

                ?>
                <div class="card" style="width: 18rem;">
                    <div class="card-header">
                        <?php echo $row["YearRate"] . " Year " . $row["ProductType"]; ?>
                    </div>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item"><b>Initial Rate: </b><?php echo $row["initial_interest_rate"]; ?>%</li>
                        <li class="list-group-item"><b>Product Fee: </b><?php echo $row["ProductFee"]; ?></li>
                        <li class="list-group-item"><b>Monthly Payments: </b>£<?php echo $initialrounded; ?></li>
                        <li class="list-group-item"><b>Remaining Monthly Payments: </b>£<?php echo $remainingrounded; ?></li>
                        <li class="list-group-item"><b>Total Repayment: </b>£<?php echo $initialrounded; ?></li>
                    </ul>
                    
                    <form method="post" action="">
                        <input type="hidden" name="Product_id" value="<?php echo $row['Product_ID']; ?>">
                        <button type="submit" name="deselect" class="btn btn-primary">Deselect</button>
                    </form>
                </div>
            <?php } ?>
        </div>
    </div>


    <footer>

    </footer>

</body>

</html>
