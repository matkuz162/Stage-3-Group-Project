<?php
include 'connection.php';
session_start();

// Check if the user is logged in
if (!isset($_SESSION['Broker_ID'])) {
  // Redirect to login page
  header('Location: LogIn.php');
  exit();
}

// Fetch broker details from the database
$broker_id = $_SESSION['Broker_ID'];
$sql = "SELECT * FROM `Broker` WHERE Broker_ID = :broker_id";
$stmt = $db->prepare($sql);
$stmt->bindParam(':broker_id', $broker_id);
$stmt->execute();
$broker = $stmt->fetch(PDO::FETCH_ASSOC);

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Update broker details
    $broker['first_name'] = $_POST['first_name'];
    $broker['last_name'] = $_POST['last_name'];
    $broker['email'] = $_POST['email'];
    $broker['phone_number'] = $_POST['phone_number'];
    $broker['country'] = $_POST['country'];
    $broker['city'] = $_POST['city'];
    $broker['postcode'] = $_POST['postcode'];
    $broker['password'] = $_POST['password'];
    $broker['broker_name'] = $_POST['broker_name'];
    $broker['broker_license_number'] = $_POST['broker_license_number'];
    $broker['company_name'] = $_POST['company_name'];
    $broker['company_registration_number'] = $_POST['company_registration_number'];
    $broker['company_country'] = $_POST['company_country'];
    $broker['company_county'] = $_POST['company_county'];
    $broker['company_city'] = $_POST['company_city'];
    $broker['company_postcode'] = $_POST['company_postcode'];

    try {
        // Update broker details in the database
        $db->beginTransaction();
        $sql = "UPDATE `Broker` SET first_name = :first_name, last_name = :last_name, email = :email, phone_number = :phone_number, country = :country, city = :city, postcode = :postcode, password = :password, brokage_name = :broker_name, broker_license_number = :broker_license_number, company_name = :company_name, company_registration_number = :company_registration_number, company_country = :company_country, company_county = :company_county, company_city = :company_city, company_postcode = :company_postcode WHERE Broker_ID = :broker_id";
        $stmt = $db->prepare($sql);
        $stmt->execute($broker);
        $db->commit();

        // Redirect to broker manage product page
        header('Location: broker-manage-product.php');
        exit();
    } catch (Exception $e) {
        // Rollback and display error message
        $db->rollBack();
        echo "Error: " . $e->getMessage();
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
            <h2 class="mb-4">Update Broker Details</h2>
            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                <div class="form-group">
                    <label for="first_name" class="form-label">First Name:</label>
                    <input type="text" class="form-control" id="first_name" name="first_name" value="<?php echo $broker['first_name']; ?>" required>
                </div>
                <div class="form-group">
                    <label for="last_name" class="form-label">Last Name:</label>
                    <input type="text" class="form-control" id="last_name" name="last_name" value="<?php echo $broker['last_name']; ?>" required>
                </div>
                <div class="form-group">
                    <label for="email" class="form-label">Email:</label>
                    <input type="email" class="form-control" id="email" name="email" value="<?php echo $broker['email']; ?>" required>
                </div>
                <div class="form-group">
                    <label for="phone_number" class="form-label">Phone Number:</label>
                    <input type="tel" class="form-control" id="phone_number" name="phone_number" value="<?php echo $broker['phone_number']; ?>" required>
                </div>
                <div class="form-group">
                    <label for="country" class="form-label">Country:</label>
                    <input type="text" class="form-control" id="country" name="country" value="<?php echo $broker['country']; ?>" required>
                </div>
                <div class="form-group">
                    <label for="city" class="form-label">City:</label>
                    <input type="text" class="form-control" id="city" name="city" value="<?php echo $broker['city']; ?>" required>
                </div>
                <div class="form-group">
                    <label for="postcode" class="form-label">Postcode:</label>
                    <input type="text" class="form-control" id="postcode" name="postcode" value="<?php echo $broker['postcode']; ?>" required>
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
                    <label for="broker_name" class="form-label">Broker Name:</label>
                    <input type="text" class="form-control" id="broker_name" name="broker_name" value="<?php echo $broker['brokage_name']; ?>" required>
                </div>
                <div class="form-group">
                    <label for="broker_license_number" class="form-label">Broker License Number:</label>
                    <input type="text" class="form-control" id="broker_license_number" name="broker_license_number" value="<?php echo $broker['broker_license_number']; ?>">
                </div>

                <h2 class="mt-5">Company Details</h2><br>

                <div class="form-group">
                    <label for="company_name" class="form-label">Company Name:</label>
                    <input type="text" class="form-control" id="company_name" name="company_name" value="<?php echo $broker['company_name']; ?>" required>
                </div>
                <div class="form-group">
                    <label for="company_registration_number" class="form-label">Company Registration Number:</label>
                    <input type="text" class="form-control" id="company_registration_number" name="company_registration_number" value="<?php echo $broker['company_registration_number']; ?>">
                </div>
                <div class="form-group">
                    <label for="company_country" class="form-label">Country:</label>
                    <input type="text" class="form-control" id="company_country" name="company_country" value="<?php echo $broker['company_country']; ?>" required>
                </div>
                <div class="form-group">
                    <label for="company_county" class="form-label">County:</label>
                    <input type="text" class="form-control" id="company_county" name="company_county" value="<?php echo $broker['company_county']; ?>">
                </div>
                <div class="form-group">
                    <label for="company_city" class="form-label">City:</label>
                    <input type="text" class="form-control" id="company_city" name="company_city" value="<?php echo $broker['company_city']; ?>" required>
                </div>
                <div class="form-group">
                    <label for="company_postcode" class="form-label">Postcode:</label>
                    <input type="text" class="form-control" id="company_postcode" name="company_postcode" value="<?php echo $broker['company_postcode']; ?>" required>
                </div>

                <button type="button" id="editFinancialBtn" class="btn btn-primary btn-lg btn-block" style="width: 100%;">Edit Details</button>
                <button type="submit" name="finance-submit" id="saveFinancialBtn" class="btn btn-secondary btn-lg btn-block" style="display: none; width: 100%;">Save Details</button>
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
