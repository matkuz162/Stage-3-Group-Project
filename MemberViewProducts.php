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
    $RegisteredUser_ID = $_SESSION['RegisteredUser_ID'];

    $checkSql = "SELECT COUNT(*) FROM Quote WHERE Product_ID = :ProductID AND RegisteredUser_ID = :RegisteredUser_ID";
    $checkStatement = $db->prepare($checkSql);
    $checkStatement->bindParam(':ProductID', $productID);
    $checkStatement->bindParam(':RegisteredUser_ID', $RegisteredUser_ID);
    $checkStatement->execute();
    $quoteCount = $checkStatement->fetchColumn();

    if ($quoteCount == 0) {
        $sql = "INSERT INTO Quote (Product_ID, RegisteredUser_ID, product_starred) 
                VALUES (:ProductID, :RegisteredUser_ID, 1)";

        $statement = $db->prepare($sql);
        $statement->bindParam(':ProductID', $productID);
        $statement->bindParam(':RegisteredUser_ID', $RegisteredUser_ID);
        $statement->execute();
    } else {
        $updateSql = "UPDATE Quote SET product_starred = 1 WHERE Product_ID = :ProductID AND RegisteredUser_ID = :RegisteredUser_ID";
        $updateStatement = $db->prepare($updateSql);
        $updateStatement->bindParam(':ProductID', $productID);
        $updateStatement->bindParam(':RegisteredUser_ID', $RegisteredUser_ID);
        $updateStatement->execute();
    }
}

$sql = "SELECT *
        FROM Product
        LEFT JOIN financialdetails ON (financialdetails.RegisteredUser_ID = Product.Broker_ID)
        LEFT JOIN RegisteredUser ON (RegisteredUser.RegisteredUser_ID = financialdetails.RegisteredUser_ID)
        LEFT JOIN Quote ON (Quote.Product_ID = Product.Product_ID)
        WHERE Product.expected_income <= (SELECT annual_income FROM financialdetails WHERE RegisteredUser_ID = $RegisteredUser_ID)
        AND Product.expected_credit_score <= (SELECT credit_score FROM financialdetails WHERE RegisteredUser_ID = $RegisteredUser_ID)
        AND Product.ltv_ratio <= (SELECT ltv_ratio FROM financialdetails WHERE RegisteredUser_ID = $RegisteredUser_ID);";

$sortingOption = isset($_GET['sort']) ? $_GET['sort'] : '1';
if($sortingOption == '1'){
    $sql .= "ORDER BY Product.initial_interest_rate DESC";
   } else if ($sortingOption == '2'){
    $sql .= "ORDER BY Product.YearRate DESC";
    }

$statement = $db->query($sql);

?>
<script>
    function sortProducts() {
        var sortBy = document.getElementById("sorting").value;
    console.log("Selected sorting option:", sortBy);
    var url = "MemberViewProducts.php?sort=" + sortBy;
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
                <label class="input-group-text" for="sorting">Sort By:</label>
                <select class="form-select" id="sorting" onchange="sortProducts()">
                    <option value="1" <?php echo($sortingOption == '1')? 'selected' : ''?>>Initial Rate</option>
                    <option value="2" <?php echo($sortingOption == '2')? 'selected' : ''?>>Initial Period</option>
                </select>
            </div>

        </div>

    </div>
    


    
    

    <div class="flex-table">
        <?php
        while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
        ?>
        <div class="card" style="width: 18rem; margin-bottom: 50px;">
            <div class="card-body">
                <h5 class="card-title"><b><?php echo $row["YearRate"] . " Year " . $row["ProductType"]; ?></b></h5>
                <ul class="list-group list-group-flush">
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
