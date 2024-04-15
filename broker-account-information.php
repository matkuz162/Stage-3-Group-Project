<?php
include 'connection.php';
session_start();


if (!isset($_SESSION['Broker_ID'])) {
 
  header('Location: LogIn.php');
  exit();
}


$broker_id = $_SESSION['Broker_ID'];
$sql = "SELECT * FROM `Broker` WHERE Broker_ID = :broker_id";
$stmt = $db->prepare($sql);
$stmt->bindParam(':broker_id', $broker_id);
$stmt->execute();
$broker = $stmt->fetch(PDO::FETCH_ASSOC);


if ($_SERVER["REQUEST_METHOD"] == "POST") {
   
    $broker['first_name'] = $_POST['first_name'];
    $broker['last_name'] = $_POST['last_name'];
    $broker['email'] = $_POST['email'];
    $broker['phone_number'] = $_POST['phone_number'];
    $broker['country'] = $_POST['country'];
    $broker['city'] = $_POST['city'];
    $broker['postcode'] = $_POST['postcode'];
    $broker['password'] = $_POST['password'];
    $broker['brokage_name'] = $_POST['brokage_name'];
    $broker['broker_license_number'] = $_POST['broker_license_number'];
    $broker['company_name'] = $_POST['company_name'];
    $broker['company_registration_number'] = $_POST['company_registration_number'];
    $broker['company_country'] = $_POST['company_country'];
    $broker['company_county'] = $_POST['company_county'];
    $broker['company_city'] = $_POST['company_city'];
    $broker['company_postcode'] = $_POST['company_postcode'];

    try {
        
        $db->beginTransaction();
        $sql = "UPDATE `Broker` SET first_name = :first_name, last_name = :last_name, email = :email, phone_number = :phone_number, country = :country, city = :city, postcode = :postcode, password = :password, brokage_name = :brokage_name, broker_license_number = :broker_license_number, company_name = :company_name, company_registration_number = :company_registration_number, company_country = :company_country, company_county = :company_county, company_city = :company_city, company_postcode = :company_postcode WHERE Broker_ID = :broker_id";
        $stmt = $db->prepare($sql);
        $stmt->execute([
            ':first_name' => $broker['first_name'],
            ':last_name' => $broker['last_name'],
            ':email' => $broker['email'],
            ':phone_number' => $broker['phone_number'],
            ':country' => $broker['country'],
            ':city' => $broker['city'],
            ':postcode' => $broker['postcode'],
            ':password' => $broker['password'],
            ':brokage_name' => $broker['brokage_name'],
            ':broker_license_number' => $broker['broker_license_number'],
            ':company_name' => $broker['company_name'],
            ':company_registration_number' => $broker['company_registration_number'],
            ':company_country' => $broker['company_country'],
            ':company_county' => $broker['company_county'],
            ':company_city' => $broker['company_city'],
            ':company_postcode' => $broker['company_postcode'],
            ':broker_id' => $broker_id,
        ]);
        $db->commit();

        
        header('Location: broker-manage-product.php');
        exit();
    } catch (Exception $e) {
        

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
                    <input type="password" class="form-control" id="password" name="password">
                </div>

                <h2 class="mt-5">Broker Details</h2><br>

                <div class="form-group">
                    <label for="brokage_name" class="form-label">Broker Name:</label>
                    <input type="text" class="form-control" id="brokage_name" name="brokage_name" value="<?php echo $broker['brokage_name']; ?>" required>
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
                    <label for="company_country" class="form-label">Company Country:</label>
                    <input type="text" class="form-control" id="company_country" name="company_country" value="<?php echo $broker['company_country']; ?>" required>
                </div>
                <div class="form-group">
                    <label for="company_county" class="form-label">Company County:</label>
                    <input type="text" class="form-control" id="company_county" name="company_county" value="<?php echo $broker['company_county']; ?>">
                </div>
                <div class="form-group">
                    <label for="company_city" class="form-label">Company City:</label>
                    <input type="text" class="form-control" id="company_city" name="company_city" value="<?php echo $broker['company_city']; ?>" required>
                </div>
                <div class="form-group">
                    <label for="company_postcode" class="form-label">Company Postcode:</label>
                    <input type="text" class="form-control" id="company_postcode" name="company_postcode" value="<?php echo $broker['company_postcode']; ?>" required>
                </div>

                <button type="button" id="editbrkBtn" class="btn btn-primary btn-lg btn-block" style="width: 100%;">Edit Loan Details</button>
                <button type="submit" name="loan-submit" id="savebrkBtn" class="btn btn-secondary btn-lg btn-block" style="display: none; width: 100%;">Save Loan Details</button>
            </form>
        </div>

    </main>

    <footer>

    </footer>
    
<script>
    // Broker Details
    const editbrkBtn = document.getElementById('editbrkBtn');
    const savebrkBtn = document.getElementById('savebrkBtn');

    // Function to toggle between edit and save buttons
    function toggleButtons(editBtn, saveBtn) {
      editBtn.style.display = 'none';
      saveBtn.style.display = 'block';
    }

    // Function to enable editing of form fields
    function enableEditing(fields) {
      fields.forEach(field => {
        field.removeAttribute('readonly');
      });
    }

    editbrkBtn.addEventListener('click', function() {
        toggleButtons(editbrkBtn, savebrkBtn);
        enableEditing(document.querySelectorAll('#first_name, #last_name, #email, #phone_number, #country, #county, #city, #postcode, #broker_license_number, #company_name, #company_registration_number, #company_country, #company_county, #company_city, #company_postcode'));
    });

</script>

</body>

</html>
