<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Captcha Generator</title>
    <link rel="stylesheet" href="style.css" />
    <script src="https://kit.fontawesome.com/af573629d9.js" crossorigin="anonymous"></script>
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
            <div class="captch_box">
                <input type="text" value="100s" disabled />
                <button class="refresh_button">
                <i class="fa-solid fa-rotate-right"></i>
                </button>
            </div>
            <div class="otp-field captch_input">
                <input type="text" placeholder="Enter captcha"  />
            </div>
            <div class="message"></div>
            
            <div class="button ">
                <button type = "reset" onclick="(submitBtnClick)">Submit Captcha</button> 
            </div>

        </main>

        <footer>
        </footer>
    <body>
    

    <script src="script.js"></script>
  </body>
</html>
