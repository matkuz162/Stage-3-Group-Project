<?php
include 'connection.php';

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $first_name = $_POST["first_name"];
    $last_name = $_POST["last_name"];
    $email = $_POST["email"];
    $phone_number = $_POST["phone_number"];
    $country = $_POST["country"];
    $city = $_POST["city"];
    $postcode = $_POST["postcode"];
    $password = $_POST["password"];
    $confirm_password = $_POST["confirm_password"];
    $brokage_name = $_POST['brokage_name'];
    $broker_license_number = $_POST["broker_license_number"];
    $company_name = $_POST["company_name"];
    $company_registration_number = $_POST['company_registration_number'];
    $company_country = $_POST["company_country"];
    $company_county = $_POST["company_county"];

    if ($password == $confirm_password) {
        try {
           
            $db->beginTransaction();

            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
            $role = "Broker";

            $sql = "INSERT INTO `Broker` (first_name, last_name, email, phone_number, country, city, postcode, password, brokage_name, broker_license_number, company_name, company_registration_number, company_country, company_county, role) 
            VALUES (:first_name, :last_name, :email, :phone_number, :country, :city, :postcode, :password, :brokege_name, :broker_license_number, :company_name, :company_registration_number, :company_country, :company_county, :role)";

            $stmt = $db->prepare($sql);
            $stmt->bindParam(':first_name', $first_name);
            $stmt->bindParam(':last_name', $last_name);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':phone_number', $phone_number);
            $stmt->bindParam(':country', $country);
            $stmt->bindParam(':city', $city);
            $stmt->bindParam(':postcode', $postcode);
            $stmt->bindParam(':password', $hashedPassword);
            $stmt->bindParam(':brokage_name', $broker_name);
            $stmt->bindParam(':broker_license_number', $broker_license_number);
            $stmt->bindParam(':company_name', $company_name);
            $stmt->bindParam(':company_registration_number', $company_registration_number);
            $stmt->bindParam(':company_country', $company_country);
            $stmt->bindParam(':company_county', $company_county);
            $stmt->bindParam(':role', $role);

            $stmt->execute();

            
            $broker_id = $db->lastInsertId();

            
            $_SESSION['Broker_ID'] = $broker_id;

            $db->commit();

            header('Location: broker-manage-product.php');
            exit();
        } catch (Exception $e) {
           
            $db->rollBack();
            echo "Error: " . $e->getMessage();
        }
    } else {
        echo "Passwords do not match!";
    }
}
?>


<!DOCTYPE html>
<html lang="en">


<head>
  <title>Register as Broker</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="style.css">
</head>


<body>

  <header class="flex-container">
    <a href="Home.php"> <img src="Assets/logo.png" alt="Rose Mortgage"> </a>
    <div>
        <ul class="nav-links">
            <li class="dropdown">
                <a class="dropdown-toggle" href="#" role="button" id="registerDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Register
                </a>
                <div class="dropdown-menu" aria-labelledby="registerDropdown">
                    <a class="dropdown-item" href="memreg.php">Register as Member</a>
                    <a class="dropdown-item" href="brkreg.php">Register as Broker</a>
                </div>
            </li>
            <li><a href="login.php">Login</a></li>
        </ul>
    </div>
</header>



<main>

  
<div class="reg">
    <h2 class="mb-4">Account Registration</h2>
    <form action=" <?php echo $_SERVER['PHP_SELF']; ?>" method="post">
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
        <label for="password" class="form-label">Password:</label>
        <input type="password" class="form-control" id="password" name="password" required>
      </div>
      <div class="form-group">
        <label for="confirm_password" class="form-label">Confirm Password:</label>
        <input type="password" class="form-control" id="confirm_password" name="confirm_password" required>
      </div>
      
      <h2 class="mt-5">Broker Details</h2><br>
      
      <div class="form-group">
        <label for="brokage_name" class="form-label">Broker Name:</label>
        <input type="text" class="form-control" id="broker_name" name="brokage_name" required>
      </div>
      <div class="form-group">
        <label for="broker_license_number" class="form-label">Broker License Number:</label>
        <input type="text" class="form-control" id="broker_license_number" name="broker_license_number">
      </div>
      
      <h2 class="mt-5">Company Details</h2><br>
      
      <div class="form-group">
        <label for="company_name" class="form-label">Company Name:</label>
        <input type="text" class="form-control" id="company_name" name="company_name" required>
      </div>
      <div class="form-group">
        <label for="company_registration_number" class="form-label">Company Registration Number:</label>
        <input type="text" class="form-control" id="company_registration_number" name="company_registration_number">
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
  
      <button type="submit" class="btn btn-primary btn-lg btn-block" style="width: 100%;">Register</button>

    </form>
  </div>








</main>















  <footer>
 
    
  </footer>




  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>






</body>

</html>
