<?php
session_start();
include 'connection.php';

if (isset($_SESSION['Broker_ID'])){

    //fetching products associated with the current broker
    $brokerId = $_SESSION['Broker_ID'];
    $stmt = $db->prepare("SELECT * FROM Product WHERE Broker_ID = ?");
    $stmt->execute([$brokerId]);
    $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
    ?>

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
            <li><a href="home.php">Sign Out</a></li>
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
                        <?php if (isset($_GET['error'])) { ?>
                            <p class ="error-field-manage-prod"><?php echo $_GET['error']; ?></p>
                        <?php }?>

                        <?php if (isset($_GET['success'])) { ?>
                            <p class ="success-field-manage-prod"><?php echo $_GET['success']; ?></p>
                        <?php }?>
                    <h4 class="products-type">Active Products</h4>
            <div class="product-layout">
                <?php if (!empty($products)) : ?>
                    <?php foreach ($products as $product) : ?>
                    <div class="product-header">
                        <h3><?php echo $product['name']; ?></h3>
                        <div>
                            <a href="Broker-product-update.php?id=<?php echo $product['Product_ID']; ?>" class="edit-product-btn">Edit</a>
                            <a href="broker-product-deletion.php?id=<?php echo $product['Product_ID']; ?>" class="delete-product-btn">Delete</a>
                        </div>
                    </div>
                    <div class="product-section">
                        <div class="manage-product-information">
                        
                        </div>
                    </div>
                    <?php endforeach; ?>
                <?php else : ?>
                    <div class ="no-products-text">
                        <p>No Products Created</p>
                    </div>
                <?php endif; ?>
            </div>
            <h4 class="products-type">Drafted Products</h4>
            <div class="product-layout">
                <?php if (!empty($products)) : ?>
                    <?php foreach ($products as $product) : ?>
                    <div class="product-header">
                        <h3><?php echo $product['name']; ?></h3>
                        <div>
                            <a href="Broker-product-update.php?id=<?php echo $product['Product_ID']; ?>" class="edit-product-btn">Edit</a>
                            <a href="broker-product-deletion.php?id=<?php echo $product['Product_ID']; ?>" class="delete-product-btn">Delete</a>
                        </div>
                    </div>
                    <div class="product-section">
                        <div class="manage-product-information">
                        
                        </div>
                    </div>
                    <?php endforeach; ?>
                <?php else : ?>
                    <div class ="no-products-text">
                        <p>No Products Created</p>
                    </div>
                <?php endif; ?>
            </div>
            </div>
        <footer>
        </footer>
    </body>
    </html>
<?php
} else {
    header("Location: LogIn.php");
    exit();
}
?>
