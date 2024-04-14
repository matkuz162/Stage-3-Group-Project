<?php
session_start();
include 'connection.php'; 



if (!isset($_SESSION['Broker_ID'])) {
  // Redirect to login page
  header('Location: login.html');
  exit();
}

$Broker_ID = $_SESSION['Broker_ID'];

$sql = "SELECT  first_name, last_name, email, phone_number, country, city, postcode, brokage_name, broker_license_number,company_name,company_registration_number,company_country 
        FROM Broker
        WHERE Broker_ID='$Broker_ID'";
$result = $db->query($sql);

foreach ( $result as $row ) {
}


if(isset($_POST['submit'])){


  $first_name = $_POST['first_name'];
  $last_name = $_POST['last_name'];
  $email = $_POST['email'];
  $phone_number = $_POST['phone_number'];
  $country = $_POST['country'];
  $city = $_POST['city'];
  $postcode = $_POST['postcode'];
  $postcode = $_POST['brokage_name'];
  $postcode = $_POST['broker_license_number'];
  $postcode = $_POST['company_name'];
  $postcode = $_POST['company_registration_number'];
  $postcode = $_POST['company_country'];
  
  $sqlsubmit = "UPDATE Broker
                SET first_name ='$first_name',last_name ='$last_name', email = '$email', phone_number = '$phone_number', country ='$country', county ='$county', city ='$city', postcode='$postcode' 
                WHERE Broker_ID='$Broker_ID'";
  
  if ($db->query($sqlsubmit) === TRUE) {
    echo "";
  } else {
    echo "";
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
        <form id="editForm" action="broker-account-information.php" method="post">
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
                <input type="password" class="form-control" id="password" name="password" required>
              </div>
              <h2 class="mt-5">Broker Details:</h2><br>
      
              <div class="form-group">
                <label for="broker_name" class="form-label">Broker Name:</label>
                <input type="text" class="form-control" id="broker_name" name="broker_name" value="<?php echo $row['brokage_name']; ?>" required disabled>
              </div>
              <div class="form-group">
                <label for="broker_license_number" class="form-label">Broker License Number:</label>
                <input type="text" class="form-control" id="broker_license_number" name="broker_license_number" value="<?php echo $row['broker_license_number']; ?>" required disabled>
              </div>
              
              <h2 class="mt-5">Company Details:</h2><br>
              
              <div class="form-group">
                <label for="company_name" class="form-label">Company Name:</label>
                <input type="text" class="form-control" id="company_name" name="company_name" value="<?php echo $row['company_name']; ?>" required disabled>
              <div class="form-group">
                <label for="company_license_number" class="form-label">Company License Number:</label>
                <input type="text" class="form-control" id="company_license_number" name="company_license_number"value=" <?php echo $row['company_registration_number']; ?>" required disabled>
              </div>
              <div class="form-group">
                <label for="company_country" class="form-label">Country:</label>
                <input type="text" class="form-control" id="company_country" name="company_country" value="<?php echo $row['company_country']; ?>" required disabled>
              </div>
              <div class="form-group">
                <label for="company_county" class="form-label">County:</label>
                <input type="text" class="form-control" id="company_county" name="company_county" value="<?php echo $row['']; ?>" required disabled>
              </div>
              <div class="form-group">
                <label for="company_city" class="form-label">City:</label>
                <input type="text" class="form-control" id="company_city" name="company_city" value="<?php echo $row['']; ?>" required disabled>
              </div>
              <div class="form-group">
                <label for="company_postcode" class="form-label">Postcode:</label>
                <input type="text" class="form-control" id="company_postcode" name="company_postcode" value="<?php echo $row['']; ?>" required disabled>
              </div>
              <button type="button" id="editbrokerBtn" class="btn btn-primary btn-lg btn-block" style="width: 100%;">Edit Financial Details</button>
              <button type="submit" name="submit" id="savebrokerBtn" class="btn btn-secondary btn-lg btn-block" style="display: none; width: 100%;">Save Financial Details</button>
              
          </form>
      </div>




  </main>
      






<script src="script.js"></script>



        
    <footer>
    
    </footer>










</body>



</html>
