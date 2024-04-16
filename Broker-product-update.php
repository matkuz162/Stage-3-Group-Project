<?php
session_start();
include 'connection.php';
    //check if ID is provided
    if (isset($_GET['id'])) {
        $productId = $_GET['id'];
        $stmt = $db->prepare("SELECT * FROM Product WHERE Product_ID=?");
        $stmt->execute([$productId]);
        $product = $stmt->fetch(PDO::FETCH_ASSOC);
    }

?>

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
            <h1>Alter Product Information</h1>
            <form class="product" action="broker-product-check.php" method="post">
                <div class="product-information">
                    <div class="product-description">

                    <?php if (isset($_GET['error'])) { ?>
                        <p class ="error-field"><?php echo $_GET['error']; ?></p>
                    <?php }?>

                    <?php if (isset($_GET['success'])) { ?>
                        <p class ="success-field"><?php echo $_GET['success']; ?></p>
                    <?php }?>

                        <label class="label-group" for="product-name">Product Name *</label>
                        <input class="form-control" type="text" id="product-name" name="product-name" value="<?php echo $product['name']; ?>"><br>
                        <label class="label-group" for="product-interest">Base Interest Rate (in %) *</label>
                        <input class="form-control" type="text" id="base-interest" name="base-interest" value="<?php echo $product['interest_rate']; ?>"><br>
                        <label for="isDraft">Set as Draft *</label>
<<<<<<< HEAD
                        <input type="checkbox" name="isDraft" <?= ($product['isDraft'] == 0) ? '': 'checked'; ?> style="width:25px;height:25px"/>
=======
                        <input type="checkbox" name="isDraft" <?= ($product['aDraft'] == 0) ? '': 'checked'; ?> style="width:25px;height:25px"/>
>>>>>>> c68d1b248ca55622e4705c9a7a7192d85a7d6460
                    </div>
                
                    <div class="expected-description">
                        <label  class="label-group" for="expected-income">Expected annual income *</label>
                        <input class="form-control" type="text" id="expected-income" name="expected-income" value="<?php echo $product['expected_income']; ?>"><br>
                        <label  class="label-group" for="expected-outgoings">Expected monthly outgoings *</label>
                        <input class="form-control" type="text" id="expected-outgoings" name="expected-outgoings" value="<?php echo $product['expected_outgoings']; ?>"><br>
                        <label  class="label-group" for="expected-credit">Expected Credit Score *</label>
                        <input class="form-control" type="text" id="expected-credit" name="expected-credit" value="<?php echo $product['expected_credit_score']; ?>"><br>
                        <label  class="label-group" for="expected-occupation">Expected Type of Employment *</label>
                        <input class="form-control" type="text" id="expected-occupation" name="expected-occupation" value="<?php echo $product['expected_employment_type']; ?>"><br>
                        <label  class="label-group" for="mtv-ratio">Maximum loan to value ratio (in %) *</label>
<<<<<<< HEAD
                        <input class="form-control" type="text" id="mtv-ratio" name="mtv-ratio" value="<?php echo $product['mtv-ratio']; ?>"><br>
=======
                        <input class="form-control" type="text" id="mtv-ratio" name="mtv-ratio" value="<?php echo $product['mtv_ratio']; ?>"><br>
                        <input type="hidden" name="product-id" value="<?php echo $productId; ?>">
>>>>>>> c68d1b248ca55622e4705c9a7a7192d85a7d6460
                    </div>
                </div>
                <div>
                    <button class="product-creation-btn" type="submit" name="updateProduct">Update Product</button>
                </div>
            </form>
        </div>  
        
    </main>
    <footer>
    
    </footer>
</body>
</html>