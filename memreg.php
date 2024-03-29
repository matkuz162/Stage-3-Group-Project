<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Register as Member</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="style.css" rel="stylesheet"></link> 
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
            <form action="update_details.php" method="post" class="update-details-form">
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
