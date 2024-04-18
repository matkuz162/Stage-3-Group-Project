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

                    <label class="label-group" for="year-rate">Year Rate *</label>
                    <input class="form-control" type="text" id="year-rate" name="year-rate" value="<?php echo $product['YearRate']; ?>"><br>
                    <label class="label-group" for="product-type">Product Type *</label>
                    <select class="form-control" id="product-type" name="product-type">
                        <option class="default-value" value="">Please select</option>
                        <option value="Fixed Rate" <?= ($product['ProductType'] == 'Fixed rate') ? 'Fixed rate': ''; ?>>Fixed rate</option>
                        <option value="Tracked Rate" <?= ($product['ProductType'] == 'Tracked rate') ? 'Tracked rate': ''; ?>>Tracked rate</option>
                    </select><br>
                    <label class="label-group" for="base-interest">Initial Interest Rate *</label>
                    <input class="form-control" type="text" id="base-interest" name="base-interest" value="<?php echo $product['initial_interest_rate']; ?>"><br>
                    <label class="label-group" for="secondary-interest">Secondary Interest Rate *</label>
                    <input class="form-control" type="text" id="secondary-interest" name="secondary-interest" value="<?php echo $product['secondary_interest_rate']; ?>"><br>
                    <label class="label-group" for="product-fee">Product Fee *</label>
                    <input class="form-control" type="text" id="product-fee" name="product-fee" value="<?php echo $product['ProductFee']; ?>"><br>
                </div>
                    
                <div class="expected-description">
                    <label  class="label-group" for="expected-income">Expected available income *</label>
                    <input class="form-control" type="text" id="expected-income" name="expected-income" value="<?php echo $product['expected_income']; ?>"><br>
                    <label  class="label-group" for="expected-credit">Expected Credit Score *</label>
                    <input class="form-control" type="text" id="expected-credit" name="expected-credit" value="<?php echo $product['expected_credit_score']; ?>"><br>
                    <label  class="label-group" for="ltv-ratio">Maximum loan to value ratio *</label>
                    <input class="form-control" type="text" id="ltv-ratio" name="ltv-ratio" value="<?php echo $product['ltv_ratio']; ?>"><br>
                    <label for="isDraft">Set as Draft *</label>
                    <input type="checkbox" name="isDraft" id="isDraft"  <?= ($product['aDraft'] == 0) ? '': 'checked'; ?> style="width:25px;height:25px"/>
                    <input type="hidden" name="product-id" value="<?php echo $productId; ?>">
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
