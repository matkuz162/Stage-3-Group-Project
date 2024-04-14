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
    $broker_name = $_POST['broker_name'];
    $broker_license_number = $_POST["broker_license_number"];
    $company_name = $_POST["company_name"];
    $company_registration_number = $_POST['company_registration_number']; // Matched variable name to column name
    $company_country = $_POST["company_country"];
    $company_county = $_POST["company_county"];
    $company_city = $_POST['company_city']; // Directly assigning from POST data
    $company_postcode = $_POST['company_postcode']; // Directly assigning from POST data
    $role = "Broker"; // Assuming role is a string, change to match your data type
    
    // Initialize $confirm_password
    $confirm_password = $_POST["confirm_password"];

    if ($password == $confirm_password) {
        try {
            $db->beginTransaction();

            // Hash the password
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

            $sql = "INSERT INTO Broker (first_name, last_name, email, phone_number, country, city, postcode, password, broker_name, broker_license_number, company_name, company_registration_number, company_country, company_county, company_city, company_postcode, role) 
                    VALUES (:first_name, :last_name, :email, :phone_number, :country, :city, :postcode, :password, :broker_name, :broker_license_number, :company_name, :company_registration_number, :company_country, :company_county, :company_city, :company_postcode, :role)";

            $stmt = $db->prepare($sql);
            $stmt->bindParam(':first_name', $first_name);
            $stmt->bindParam(':last_name', $last_name);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':phone_number', $phone_number);
            $stmt->bindParam(':country', $country);
            $stmt->bindParam(':city', $city);
            $stmt->bindParam(':postcode', $postcode);
            $stmt->bindParam(':password', $hashedPassword);
            $stmt->bindParam(':broker_name', $broker_name);
            $stmt->bindParam(':broker_license_number', $broker_license_number);
            $stmt->bindParam(':company_name', $company_name);
            $stmt->bindParam(':company_registration_number', $company_registration_number);
            $stmt->bindParam(':company_country', $company_country);
            $stmt->bindParam(':company_county', $company_county);
            $stmt->bindParam(':company_city', $company_city); // Bind company_city
            $stmt->bindParam(':company_postcode', $company_postcode); // Bind company_postcode
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
