<?php
include 'connection.php'; 

session_start();

if (!isset($_SESSION['RegisteredUser_ID'])) {
  // Redirect to login page
  header('Location: login.php');
  exit();
}

$RegisteredUser_ID = $_SESSION['RegisteredUser_ID'];

$sql = "SELECT first_name, last_name 
        FROM RegisteredUser
        WHERE RegisteredUser_ID='$RegisteredUser_ID'";
$result = $db->query($sql);

foreach ( $result as $row ) {
  echo "<strong>first_name:</strong> " . $row["first_name"] . "<br>";
  echo "<strong>last_name :</strong> " . $row["last_name"] . "<br>";
}
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


    <main>

        <div class="reg">
            <h2 class="mb-4"><b>Personal Details:</b></h2>
            <form action="update_details.php" method="post">
              <div class="form-group">
                <label for="first_name" class="form-label">First Name:</label>
                <input type="text" class="form-control" id="first_name" name="first_name" required>
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
              <button type="button" id="editBtn" class="btn btn-primary btn-lg btn-block" style="width: 100%;">Edit Details</button>
              <button type="submit" id="saveBtn" class="btn btn-secondary btn-lg btn-block" style="display: none; width: 100%;">Save</button>
          </form>
      </div>
      <br></br>
      <br>

        <div class="reg">
            <h2 class="mb-4"><b>Financial Details:</b></h2>
                       <form action="update_details.php" method="post">
              <div class="form-group">
                <label for="annual_income" class="form-label">Annual Income:</label>
                <input type="text" class="form-control" id="annual_income" name="annual_income" required>
              </div>
              <div class="form-group">
                <label for="additional_income" class="form-label">Amount of Additional Income:</label>
                <input type="text" class="form-control" id="additional_income" name="additional_income" required>
              </div>
              <div class="form-group">
                <label for="total_balance" class="form-label">Total Balance:</label>
                <input type="text" class="form-control" id="total_balance" name="total_balance" required>
              </div>
              <div class="form-group">
                <label for="major_monthly_commitments_bool" class="form-label">Other Commitments:</label>
                <input type="text" class="form-control" id="major_monthly_commitments_bool" name="major_monthly_commitments_bool" required>
              </div>
              <div class="form-group">
                <label for="disposable_income" class="form-label">Monthly Spending Amounts:</label>
                <input type="text" class="form-control" id="monthly_spending_amounts" name="monthly_spending_amounts" required>
              </div>
              <div class="form-group">
                <label for="credit_score" class="form-label">Credit Score:</label>
                <input type="text" class="form-control" id="credit_score" name="credit_score" required>
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
