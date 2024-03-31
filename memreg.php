<?php
include 'connection.php';

// Start the session
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $first_name = $_POST["first_name"];
    $last_name = $_POST["last_name"];
    $email = $_POST["email"];
    $phone_number = $_POST["phone_number"];
    $country = $_POST["country"];
    $county = $_POST["county"];
    $city = $_POST["city"];
    $postcode = $_POST["postcode"];
    $password = $_POST["password"];
    $confirm_password = $_POST["confirm_password"];

    if ($password == $confirm_password) {
        try {
           
            $db->beginTransaction();

            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

            $sql = "INSERT INTO RegisteredUser (first_name, last_name, email, phone_number, country, county, city, postcode, password) 
            VALUES (:first_name, :last_name, :email, :phone_number, :country, :county, :city, :postcode, :password)";

            $stmt = $db->prepare($sql);
            $stmt->bindParam(':first_name', $first_name);
            $stmt->bindParam(':last_name', $last_name);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':phone_number', $phone_number);
            $stmt->bindParam(':country', $country);
            $stmt->bindParam(':county', $county);
            $stmt->bindParam(':city', $city);
            $stmt->bindParam(':postcode', $postcode);
            $stmt->bindParam(':password', $hashedPassword);

            $stmt->execute();

        
            $_SESSION['RegisteredUser_ID'] = $db->lastInsertId();

           
            var_dump($_SESSION);

            $db->commit();

            header('Location: financial.php');
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
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Register as Member</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="style.css" rel="stylesheet"> 
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
            <li><a href="login.html">Login</a></li>
        </ul>
    </div>
</header>
<main>
    <div class="reg">
        <h2 class="mb-4">Account Details</h2>
        <form action=" <?php echo $_SERVER['PHP_SELF']; ?>" method="post" class="update-details-form">
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
