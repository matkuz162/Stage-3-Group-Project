<?php
session_start();
include 'connection.php'; 
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

            <div class="input-group flex-nowrap">
                <span class="input-group-text" id="addon-wrapping">Search:</span>
                <input type="text" class="form-control" placeholder="..." aria-label="Username" aria-describedby="addon-wrapping">
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
            $sql = "SELECT * FROM Product";
            $result = mysqli_query($conn,$sql);
            $queryResults = mysqli_num_rows($result);

            if($queryResults > 0){
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<div>
                        <h3>".$row['name']."</h3>
                        <p>".$row['description']."</p>
                        <p>".$row['expected_income']."</p>
                        <p>".$row['expected_outgoings']."</p>
                        <p>".$row['expected_credit_score']."</p>
                        <p>".$row['expected_employment_type']."</p>
                        <p>".$row['interest_rate']."</p>
                        <p>".$row['mtv_ratio']."</p>
                    </div>";
                }
            }
        ?>




        

    </div>

</div>
</div>


<footer>

</footer>


</body>



</html>
