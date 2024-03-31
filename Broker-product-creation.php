<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
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
        <li><a href="home.php">Sign Out</a></li>
    </ul>
</div>

</header>


    <main>
        <div class="hero">
            <h1>Product Creation</h1>
            <form class="product">
                <div class="product-information">
                    <div class="product-description">
                        <label class="label-group" for="product-name">Product Name</label><br>
                        <input class="form-control" type="text" id="product-name" name="product-name"><br>
                        <label  class="label-group" for="product-desc">Product Description</label><br>
                        <textarea class="form-control"row="10" id="product-desc" name="product-desc"></textarea>
                        <label class="label-group" for="product-interest">Base Interest Rate</label><br>
                        <input class="form-control" type="text" id="base-interest" name="expected-occupation"><br>
                    </div>
                
                    <div class="expected-description">
                        <label  class="label-group" for="expected-income">Expected Income</label><br>
                        <input class="form-control" type="text" id="expected-income" name="expected-income"><br>
                        <label  class="label-group" for="expected-outgoings">Expected Outgoings</label><br>
                        <input class="form-control" type="text" id="expected-outgoings" name="expected-outgoings"><br>
                        <label  class="label-group" for="expected-credit">Expected Credit Score</label><br>
                        <input class="form-control" type="text" id="expected-credit" name="expected-credit"><br>
                        <label  class="label-group" for="expected-occupation">Expected Type of Employment</label><br>
                        <input class="form-control" type="text" id="expected-occupation" name="expected-occupation"><br>
                        <label  class="label-group" for="expected-occupation">Maximum loan to value ratio</label><br>
                        <input class="form-control" type="text" id="expected-occupation" name="expected-occupation"><br>
                    </div>
                </div>
                <div>
                    <button class="product-creation-btn" type="submit">Create Product</button>
                    <button class="product-creation-btn" type="submit">Create Product Draft</button>
                </div>
            </form>
        </div>  
        
    </main>
    <footer>
    
    </footer>
</body>
</html>
