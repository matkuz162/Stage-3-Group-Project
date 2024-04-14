<?php

session_start();
include 'connection.php'; 

if (!isset($_SESSION['RegisteredUser_ID'])) {
  // Redirect to login page
  header('Location: login.html');
  exit();
}

$RegisteredUser_ID = $_SESSION['RegisteredUser_ID'];


$sql = "SELECT ru.first_name, ru.last_name, ru.email, ru.phone_number, ru.country, ru.county, ru.city, ru.postcode, ud.annual_income , ud.additional_income_amount, ud.total_balance, ud.other_commitments, ud.monthly_spending_amounts, ud.credit_score
        FROM RegisteredUser ru
        INNER JOIN financialdetails ud ON ru.RegisteredUser_ID = ud.RegisteredUser_ID
        WHERE ru.RegisteredUser_ID='$RegisteredUser_ID'";

        
$result = $db->query($sql);

foreach ( $result as $row ) {
}

if(isset($_POST['submit'])){


  $first_name = $_POST['first_name'];
  $last_name = $_POST['last_name'];
  $email = $_POST['email'];
  $phone_number = $_POST['phone_number'];
  $country = $_POST['country'];
  $county = $_POST['county'];
  $city = $_POST['city'];
  $postcode = $_POST['postcode'];
  
  $sqlsubmit = "UPDATE RegisteredUser
                SET first_name ='$first_name',last_name ='$last_name', email = '$email', phone_number = '$phone_number', country ='$country', county ='$county', city ='$city', postcode='$postcode' 
                WHERE RegisteredUser_ID='$RegisteredUser_ID'";
  
  if ($db->query($sqlsubmit) === TRUE) {
    echo "";
  } else {
    echo "";
  }

 
}

if(isset($_POST['finance-submit'])){

  $annual_income = $_POST['annual_income'];
  $total_balance = $_POST['total_balance'];
  $credit_score = $_POST['credit_score'];
  
  $financialsubmit = "UPDATE financialdetails 
  SET annual_income = '$annual_income',
      total_balance = '$total_balance',
      credit_score = '$credit_score'
  WHERE RegisteredUser_ID IN (SELECT RegisteredUser_ID FROM RegisteredUser WHERE RegisteredUser_ID='$RegisteredUser_ID')";

  if ($db->query($financialsubmit) === TRUE) {
  } else {
  }
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
            <form action="MemberAccountDetails.php" method="post">
              <div class="form-group">
                <label for="first_name" class="form-label">First Name:</label>
                <input type="text" class="form-control" id="first_name" name="first_name"  value="<?php echo $row['first_name']; ?>" required disabled>
              </div>
              <div class="form-group">
                <label for="last_name" class="form-label">Last Name:</label>
                <input type="text" class="form-control" id="last_name" name="last_name" value="<?php echo $row['last_name']; ?>" required disabled>
              </div>
              <div class="form-group">
                <label for="email" class="form-label">Email:</label>
                <input type="email" class="form-control" id="email" name="email"  value="<?php echo $row['email']; ?>" required disabled>
              </div>
              <div class="form-group">
                <label for="phone_number" class="form-label">Phone Number:</label>
                <input type="tel" class="form-control" id="phone_number" name="phone_number"  value="<?php echo $row['phone_number']; ?>"required disabled>
              </div>
              <div class="form-group">
                <label for="country" class="form-label">Country:</label>
                <input type="text" class="form-control" id="country" name="country"  value="<?php echo $row['country']; ?>" required disabled>
              </div>
              <div class="form-group">
                <label for="county" class="form-label">County:</label>
                <input type="text" class="form-control" id="county" name="county" value="<?php echo $row['county']; ?>"disabled> 
              </div>
              <div class="form-group">
                <label for="city" class="form-label">City:</label>
                <input type="text" class="form-control" id="city" name="city" value="<?php echo $row['city']; ?>" required disabled>
              </div>
              <div class="form-group">
                <label for="postcode" class="form-label">Postcode:</label>
                <input type="text" class="form-control" id="postcode" name="postcode" value="<?php echo $row['postcode']; ?>" required disabled>
              </div>
              <div class="form-group">
                <label for="password" class="form-label">New Password:</label>
                <input type="password" class="form-control" id="password" name="password" required disabled>
              </div>
              <button type="button" id="editBtn" class="btn btn-primary btn-lg btn-block" style="width: 100%;">Edit Details</button>
              <button type="submit" name="submit" id="saveBtn" class="btn btn-secondary btn-lg btn-block" style="display: none; width: 100%;">Save</button>
          </form>
      </div>
      <br></br>
      <br>

        <div class="reg">
            <h2 class="mb-4"><b>Financial Details:</b></h2>
                       <form action="MemberAccountDetails.php" method="post">
              <div class="form-group">
                <label for="annual_income" class="form-label">Annual Income:</label>
                <input type="text" class="form-control" id="annual_income" name="annual_income" value="<?php echo $row['annual_income']; ?>" required disabled>
              </div>
              <div class="form-group">
                <label for="additional_income" class="form-label">Amount of Additional Income:</label>
                <input type="text" class="form-control" id="additional_income" name="additional_income" value="<?php echo $row['additional_income_amount']; ?>" required disabled>
              </div>
              <div class="form-group">
                <label for="total_balance" class="form-label">Total Balance held by User:</label>
                <input type="text" class="form-control" id="total_balance" name="total_balance" value="<?php echo $row['total_balance']; ?>" required disabled>
              </div>
              <div class="form-group">
                <label for="major_monthly_commitments_bool" class="form-label">Major Monthly Commitments?</label>
                <input type="text" class="form-control" id="major_monthly_commitments_bool" name="major_monthly_commitments_bool" value="<?php echo $row['other_commitments']; ?>" required disabled>
              </div>
              <div class="form-group">
                <label for="credit_score" class="form-label">Credit Score:</label>
                <input type="text" class="form-control" id="credit_score" name="credit_score" value="<?php echo $row['credit_score']; ?>" required disabled>
              </div>
              <button type="button" id="editFinancialBtn" class="btn btn-primary btn-lg btn-block" style="width: 100%;">Edit Financial Details</button>
              <button type="submit" name="finance-submit" id="saveFinancialBtn" class="btn btn-secondary btn-lg btn-block" style="display: none; width: 100%;">Save Financial Details</button>              
          </form>
</div>






  </main>
      



  <script src="script.js"></script>





        
    <footer>
    
    </footer>











</body>



</html>
