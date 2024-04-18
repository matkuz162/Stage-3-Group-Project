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

$sortingOption = isset($_GET['sort']) ? $_GET['sort'] : '1';
if($sortingOption == '1'){
    $sql .= "ORDER BY Product.initial_interest_rate DESC";
   } else if (sortingOption == '2'){
    $sql .= "ORDER BY Product.YearRate DESC";
    } else if (sortingOption == '3'){
    $sql .= "ORDER BY Product.YearRate DESC";
    }

$statement = $db->query($sql);

?>
$statement->bindParam(':registered_user_id', $RegisteredUser_ID);
$statement->execute();
?>
<script>
    function sortProducts() {
        var sortBy = document.getElementById("sorting").value;
    console.log("Selected sorting option:", sortBy);
    var url = "MemberChosenProducts.php?sort=" + sortBy;
    console.log("Redirecting to:", url);
    window.location.href = url;
}
</script>
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
                        <option value="1"<?php echo ($sortOption == '1')? 'selected' : '';?>>Initial Rate</option>
                        <option value="2"<?php echo ($sortOption == '2')? 'selected' : '';?>>Initial Period</option>
                        <option value="3"<?php echo ($sortOption == '3')? 'selected' : '';?>>Total Repayment</option>
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
                $remainingamount = ($row["borrow_amount"] - ($row["YearRate"] * $initialmonthlyPayments));
                $remainingmonthlyPayments = $remainingamount * (($remainingmonthlyInterestRate * pow((1 + $remainingmonthlyInterestRate), $remainingmonths)) / (pow((1 + $remainingmonthlyInterestRate), $remainingmonths) - 1));
                $remainingrounded = round($remainingmonthlyPayments,2);

                $totalpayment = (($row["YearRate"]*12)*$initialmonthlyPayments) + ((($row["mortgage_term"]-$row["YearRate"])*12)*$remainingmonthlyPayments);
                $totalrounded = round($totalpayment,2);

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
                        <li class="list-group-item"><b>Total Repayment: </b>£<?php echo $totalrounded; ?></li>
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
