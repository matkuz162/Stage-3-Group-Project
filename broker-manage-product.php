<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="style.css" rel="stylesheet"></link> 
</head>
<body>
<header class="flex-container">

<a href="broker-manage-product.php"> <img src="Assets/logo.png" alt="Rose Mortgage"> </a>

<div>
    <ul class="nav-links">
        <li><a href="Broker-product-creation.php">Create Product</a></li>
        <li><a href="broker-manage-product.php">Manage Product</a></li>
        <li><a href="broker-account-information.php">Account Details</a></li>
        <li><a href="LogIn.php">Sign Out</a></li>
    </ul>
</div>

</header>
    <main>
        
        <div class="largecontainer">
            <div class="flex-container">
                <div><h3><b>Manage Products:</b></h3></div>
        
                <div class="flex-container">
                    <div>
                        <a>Sort By:</a>
                    </div>
                    <div>
                        <select>
                            <option>Highest Price</option>
                            <option>Lowest Price</option>
                            <option>Oldest Product</option>
                            <option>Newest Product</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <div class="product-layout">
            <div class="product-header">
                <h3>Product name</h3>
                <div>
                    <a href="broker-product-update.html" class="edit-product-btn">Edit</a>
                    <a href="#" class="delete-product-btn">Delete</a>
                </div>
            </div>
            <div class="product-section">
                <div class="manage-product-information">
                    <div>
                    
                    </div>
                </div>
                </div>
            </div>
        </div>
    <footer>
    </footer>
</body>
</html>
