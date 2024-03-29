<?php
include 'connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $firstname = $_POST["first_name"]; // Updated variable name to match HTML form
    $lastname = $_POST["last_name"]; // Updated variable name to match HTML form
    $email = $_POST["email"];
    $phonenumber = $_POST["phone_number"]; // Updated variable name to match HTML form
    $password = $_POST["password"];
    $confirmPassword = $_POST["confirm_password"]; // Updated variable name to match HTML form
    $country = $_POST["country"];
    $county = $_POST["county"];
    $city = $_POST["city"];
    $postcode = $_POST["postcode"];

    if ($password == $confirmPassword) {
        try {
            // Begin transaction
            $db->beginTransaction();

            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

            $defaultRole = 'User';

            $sql = "INSERT INTO User (FirstName, LastName, Email, PhoneNumber, Password, Country, County, City, Postcode, Role) 
            VALUES (:firstname, :lastname, :email, :phonenumber, :password, :country, :county, :city, :postcode, :role)";

            $stmt = $db->prepare($sql);
            $stmt->bindParam(':firstname', $firstname);
            $stmt->bindParam(':lastname', $lastname);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':phonenumber', $phonenumber);
            $stmt->bindParam(':password', $hashedPassword);
            $stmt->bindParam(':country', $country);
            $stmt->bindParam(':county', $county);
            $stmt->bindParam(':city', $city);
            $stmt->bindParam(':postcode', $postcode);
            $stmt->bindParam(':role', $defaultRole);

            $stmt->execute();

            // Commit transaction
            $db->commit();

            header('Location: financial');
            exit();
        } catch (Exception $e) {
            // Rollback transaction
            $db->rollBack();
            echo "Error: " . $e->getMessage();
        }
    } else {
        echo "Passwords do not match!";
    }
}
?>
