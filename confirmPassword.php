<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Password</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>

        <a href="Home.php"><img src="Assets/logo.png" alt="Rose Mortgage"></a>

    </header>
    <main>

        <div class="reset">
                <form class="reset-password">
                <h1>Change Password</h1><br><br>

                <div class="otp-field captch_input">
                    <input type="text" placeholder="New Password"  />
                </div>
                <div class="otp-field captch_input">
                    <input type="text" placeholder="Confirm Password"  />
                </div>
                <div class="message"></div>            
                <div class="button ">
                    <button type = "reset" onclick="(submitBtnClick)">Submit Captcha</button> 
                </div>
        </div>        

    </main>


    <footer>
        <p>Footer</p>
    </footer>
</body>
</html>