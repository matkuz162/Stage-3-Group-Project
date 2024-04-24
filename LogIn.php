<?php
include 'connection.php'; 

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $enteredemail = $_POST["email"];
    $enteredpassword = $_POST["password"];

    try {
   
        if(isset($db)) {
            
            //Check if the user exists in the RegisteredUser table
            $stmt = $db->prepare("SELECT * FROM RegisteredUser WHERE email = :email");
            $stmt->bindParam(':email', $enteredemail, PDO::PARAM_STR);
            $stmt->execute();

            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($row) {
                $password = $row["password"];

                if (password_verify($enteredpassword, $password)) {
                    $_SESSION["email"] = $enteredemail;
                    $_SESSION["role"] = "registered_user";
                    $_SESSION["RegisteredUser_ID"] = $row["RegisteredUser_ID"];
                    
                    header("Location: Loan-details.php");
                    exit();
                } else {
                    echo "Incorrect password";
                }
            } else {
                //Check if the user exists in the Broker table
                $stmt = $db->prepare("SELECT * FROM Broker WHERE email = :email");
                $stmt->bindParam(':email', $enteredemail, PDO::PARAM_STR);
                $stmt->execute();

                $row = $stmt->fetch(PDO::FETCH_ASSOC);

                if ($row) {
                    $password = $row["password"];

                    if (password_verify($enteredpassword, $password)) {
                        $_SESSION["email"] = $enteredemail;
                        $_SESSION["role"] = "broker";
                        $_SESSION["Broker_ID"] = $row["Broker_ID"];
                        
                        header("Location: broker-manage-product.php");
                        exit();
                    } else {
                        echo "Incorrect password";
                    }
                } else {
                    echo "User not found";
                }
            }
        } else {
            echo "Database connection not established.";
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>




<!DOCTYPE html>
<html lang="en">


<head>
  <title>Rose Mortgage</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="css/style.css">
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

  <div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h3>Login</h3>
                </div>
                <div class="card-body">
                    <form action="login.php" method="post">
                        <div class="form-group">
                            <label for="email">Email address:</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                        <div class="form-group">
                            <label for="password">Password:</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                        </div>
                        <button type="submit" class="btn btn-primary btn-lg btn-block" style="width: 100%;">Login</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>





















</main>





  <footer>
 
  </footer>





  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>




</body>

</html>
