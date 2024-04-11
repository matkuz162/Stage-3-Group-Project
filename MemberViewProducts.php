<?php
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
    

    <div>
        <div class="card" style="width: 18rem;">
            <img src="..." class="card-img-top" alt="...">
            <div class="card-body">
                <h5 class="card-title">Card title</h5>
                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
            </div>
            <ul class="list-group list-group-flush">
                <li class="list-group-item">An item</li>
                <li class="list-group-item">A second item</li>
                <li class="list-group-item">A third item</li>
            </ul>
            <div class="card-body">
                <a href="#" class="card-link">Card link</a>
                <a href="#" class="card-link">Another link</a>
            </div>
        </div>





        <div class="flex-table">22</div>
        <div class="flex-table">test</div>
        <div class="flex-table">4
        
    </div>

</div>
</div>


<footer>

</footer>


</body>



</html>
