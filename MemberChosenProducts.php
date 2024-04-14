<?php

require_once 'connection.php';

$sql = "SELECT * FROM Quote WHERE product_starred = 1";
$statement = $db->query($sql);

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <title>Rose Mortgage</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
    integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <link rel="stylesheet" href="style.css">
</head>

<body>

  <header class="flex-container">

    <a href="MemberViewProducts.php"> <img src="Assets/logo.png" alt="Rose Mortgage"> </a>

    <div>
      <ul class="nav-links">
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

        <div class="input-group flex-nowrap">
          <span class="input-group-text" id="addon-wrapping">Search:</span>
          <input type="text" class="form-control" placeholder="..." aria-label="Username"
            aria-describedby="addon-wrapping">
        </div>


        <div class="input-group mb-3">
          <label class="input-group-text" for="inputGroupSelect01">Sort By:</label>
          <select class="form-select" id="inputGroupSelect01">
            <option selected>Highest Price:</option>
            <option value="1">Lowest Price</option>
            <option value="2">Oldest Product</option>
            <option value="3">Newest Product</option>
          </select>
        </div>

      </div>

    </div>
    <div class="flex-table">
      <?php
      while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
      ?>
      <div class="card" style="width: 18rem;">
        <div class="card-header">
          <?php echo $row["Quote_ID"]; ?>
        </div>
        <ul class="list-group list-group-flush">
          <li class="list-group-item"><b>Loan Amount:</b><?php echo $row["loan_amount"]; ?></li>
          <li class="list-group-item"><b>Term (Months):</b><?php echo $row["term"]; ?></li>
          <li class="list-group-item"><b>Interest (%):</b><?php echo $row["interest"]; ?></li>
          <li class="list-group-item"><b>Rate:</b><?php echo $row["rate"]; ?></li>
          <li class="list-group-item"><b>Total:</b><?php echo $row["total"]; ?></li>
        </ul>
      </div>
      <?php
      }
      ?>


    </div>
  </div>


  <footer>

  </footer>

</body>

</html>