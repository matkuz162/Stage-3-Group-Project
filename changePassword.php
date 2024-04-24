<?php
include 'connection.php';


session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $password = $_POST["password"];
    $confirm_password = $_POST["confirm_password"];


    if ($password == $confirm_password) {
        try {
            $db->beginTransaction();

            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

            if(isset($_SESSION["RegisteredUser_ID"]))
            {
                $RegisteredUser_ID = $_SESSION['RegisteredUser_ID'];

                $sqlRegUser = "UPDATE RegisteredUser SET password = :password WHERE RegisteredUser_ID = :RegisteredUser_ID";
                
                $stmt = $db->prepare($sqlRegUser);
                          
                $stmt->bindParam(':password', $hashedPassword);
                $stmt->bindParam(':RegisteredUser_ID', $RegisteredUser_ID, PDO::PARAM_INT);
                $stmt->execute();
    
            }

            if(isset($_SESSION["Broker_ID"]))
            {
                $Broker_ID = $_SESSION['Broker_ID'];

                $sqlBroker = "UPDATE Broker SET password = :password WHERE Broker_ID = :Broker_ID";
                
                $stmt = $db->prepare($sqlBroker);
                          
                $stmt->bindParam(':password', $hashedPassword);
                $stmt->bindParam(':Broker_ID', $Broker_ID, PDO::PARAM_INT);
                $stmt->execute();
                
            }
                        
            $db->commit();
            echo "Password updated successfully!";
        }       
        catch (Exception $e) {
            $db->rollBack();
            echo "Error: " . $e->getMessage();
        }
    }
    else
    {
        echo "Passwords do not match!";
    }

}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Password</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <header>

        <a href="Home.php"><img src="Assets/logo.png" alt="Rose Mortgage"></a>

    </header>
    <main>

        <div class="reset">
            <form class="reset-password" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                <h1>Change Password</h1><br><br>

                <div class="otp-field captch_input">
                    <input type="password" class="form-control" id="password" name="password" placeholder="New Password" required>
                </div>
                <div class="otp-field captch_input">
                <input type="password" class="form-control" id="confirm_password" name="confirm_password" placeholder="Confirm Password" required>
                </div>
                <div class="message"></div>            
                <div class="button ">
                    <button type = "submit">Submit</button> 
                </div>
            </form>
        </div>        

    </main>


    <footer>
        <p>Footer</p>
    </footer>
</body>
</html>