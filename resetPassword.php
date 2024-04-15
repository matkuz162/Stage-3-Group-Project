<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
    <link rel="stylesheet" href="style.css">
    <script src="https://kit.fontawesome.com/af573629d9.js" crossorigin="anonymous"></script>
    <script src="script.js"></script>
</head>
<body>
    <header>

        <a href="Home.php"><img src="Assets/logo.png" alt="Rose Mortgage"></a>
  
    </header>

   <main>

    <div class="reset">
    <form class="reset-password">
        <h1>Reset Password</h1><br><br>
        <h2>Enter the 6 digit code</h2><br>

        <div class ="input-field captcha-box">
            <input type="text" value="3  y  4  5  8  r" disabled/>
        </div>
        <div class="refresh-button">
        <i class="fa-solid fa-rotate-right"></i>
        </div>
        <div>
        <div class ="input-field captcha-input">
            <input type="text" placeholder="Enter Captcha"/>
        </div>
        <div class="message">Enter captcha is correct</div>
        <div class="input-field button diabled">
            <button>Submit</button>
        </div>

        </div>
        
        <div class ="otp-field">
            <input type="text" maxlength="1">
            <input type="text" maxlength="1">
            <input type="text" maxlength="1">
            <input type="text" maxlength="1">
            <input type="text" maxlength="1">
            <input type="text" maxlength="1">
        </div>
        <button class="confirm-btn" type="submit">Confirm</button>
    </form>
    </div>

</main>    

    <footer>
        <p>Footer</p>
    </footer>


</body>
</html>