<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home-Rose Mortgage</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
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
        <div class="calculator-container"> 
            <div class="calculator">
                <h2>Mortgage Calculator</h2>
                
                <label for="principal">Loan Amount:</label>
                <input type="number" id="principal" placeholder="Enter loan amount">

                <label for="interest">Annual Interest Rate:</label>
                <input type="number" id="interest" placeholder="Enter annual interest rate">

                <label for="years">Loan duration (years):</label>
                <input type="number" id="years" placeholder="Enter loan duration">

                <button onclick="calculateMonthlyPayment()">Calculate</button>

                <h3>Monthly Mortgage Payment:</h3>
                <p id="result">£0.00</p>
            </div>
        </div>
        <div class="container mt-5">
            <div class="row">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <h3 class="card-title">BECOME A MEMBER</h3>
                            <ul>
                                <li>Personalized dashboard for tailored mortgage browsing</li>
                                <li>Exclusive insights into market trends and interest rates</li>
                                <li>Priority assistance from dedicated customer support team</li>
                                <li>Community engagement and networking opportunities with fellow homebuyers</li>
                            </ul>
                            <a href="memreg.php" class="btn btn-primary">Register</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <h3 class="card-title">BECOME A BROKER</h3>
                            <ul>
                                <li>Access to a vast network of potential clients actively seeking mortgage solutions</li>
                                <li>Advanced tools and analytics for efficient portfolio management</li>
                                <li>Exclusive training sessions and updates on industry regulations</li>
                                <li>Streamlined communication channels for transparent and trustworthy interactions with clients</li>
                            </ul>
                            <a href="brkreg.php" class="btn btn-primary">Register</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <footer>
    </footer>   

    <script src="script.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
