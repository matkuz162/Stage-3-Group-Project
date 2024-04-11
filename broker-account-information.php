<?php
session_start();

include 'connection.php';


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Update Account Information</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="style.css" rel="stylesheet"></link> 
</head>


<body>


  <header class="flex-container">

    <a href="broker-manage-product.php"> <img src="Assets/logo.png" alt="Rose Mortgage"> </a>

    <div>
        <ul class="nav-links">
            <li><a href="Broker-product-creation.php">Create Product</a></li>
            <li><a href="broker-manage-product.php">Manage Product</a></li>
            <li><a href="broker-account-information.php">Account Details</a></li>
            <li><a href="home.php">Sign Out</a></li>
        </ul>
    </div>

</header>


    <main>

      <div class="reg">
        <h2 class="mb-4">Account Details:</h2>
        <form id="editForm" action="update_details.php" method="post">
            <div class="form-group">
                <label for="first_name" class="form-label">First Name:</label>
                <input type="text" class="form-control" id="first_name" name="first_name" required readonly>
            </div>
              <div class="form-group">
                <label for="last_name" class="form-label">Last Name:</label>
                <input type="text" class="form-control" id="last_name" name="last_name" required>
              </div>
              <div class="form-group">
                <label for="email" class="form-label">Email:</label>
                <input type="email" class="form-control" id="email" name="email" required>
              </div>
              <div class="form-group">
                <label for="phone_number" class="form-label">Phone Number:</label>
                <input type="tel" class="form-control" id="phone_number" name="phone_number" required>
              </div>
              <div class="form-group">
                <label for="country" class="form-label">Country:</label>
                <input type="text" class="form-control" id="country" name="country" required>
              </div>
              <div class="form-group">
                <label for="county" class="form-label">County:</label>
                <input type="text" class="form-control" id="county" name="county">
              </div>
              <div class="form-group">
                <label for="city" class="form-label">City:</label>
                <input type="text" class="form-control" id="city" name="city" required>
              </div>
              <div class="form-group">
                <label for="postcode" class="form-label">Postcode:</label>
                <input type="text" class="form-control" id="postcode" name="postcode" required>
              </div>
              <div class="form-group">
                <label for="password" class="form-label">New Password:</label>
                <input type="password" class="form-control" id="password" name="password" required>
              </div>
              <h2 class="mt-5">Broker Details:</h2><br>
      
              <div class="form-group">
                <label for="broker_name" class="form-label">Broker Name:</label>
                <input type="text" class="form-control" id="broker_name" name="broker_name" required>
              </div>
              <div class="form-group">
                <label for="broker_license_number" class="form-label">Broker License Number:</label>
                <input type="text" class="form-control" id="broker_license_number" name="broker_license_number">
              </div>
              
              <h2 class="mt-5">Company Details:</h2><br>
              
              <div class="form-group">
                <label for="company_name" class="form-label">Company Name:</label>
                <input type="text" class="form-control" id="company_name" name="company_name" required>
              </div>
              <div class="form-group">
                <label for="company_license_number" class="form-label">Company License Number:</label>
                <input type="text" class="form-control" id="company_license_number" name="company_license_number">
              </div>
              <div class="form-group">
                <label for="company_country" class="form-label">Country:</label>
                <input type="text" class="form-control" id="company_country" name="company_country" required>
              </div>
              <div class="form-group">
                <label for="company_county" class="form-label">County:</label>
                <input type="text" class="form-control" id="company_county" name="company_county">
              </div>
              <div class="form-group">
                <label for="company_city" class="form-label">City:</label>
                <input type="text" class="form-control" id="company_city" name="company_city" required>
              </div>
              <div class="form-group">
                <label for="company_postcode" class="form-label">Postcode:</label>
                <input type="text" class="form-control" id="company_postcode" name="company_postcode" required>
              </div>
              <button type="button" id="editFinancialBtn" class="btn btn-primary btn-lg btn-block" style="width: 100%;">Edit Financial Details</button>
              <button type="submit" id="saveFinancialBtn" class="btn btn-secondary btn-lg btn-block" style="display: none; width: 100%;">Save Financial Details</button>
              
          </form>
      </div>




  </main>
      






<script src="script.js"></script>



        
    <footer>
    
    </footer>











</body>



</html>
