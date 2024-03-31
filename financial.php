<?php
session_start();

// Include database connection
include 'connection.php';

// Process form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $annual_income = $_POST["annual_income"];
    $additional_income_amount = $_POST["additional_income_amount"];
    $mortgage_duration = $_POST["mortgage_duration"];
    $total_balance = $_POST["total_balance"];
    $other_commitments = $_POST["other_commitments"];
    $monthly_spending_amounts = $_POST["monthly_spending_amounts"];
    $deposit_amounts = $_POST["deposit_amounts"];
    $credit_score = $_POST["credit_score"];

    // Retrieve RegisteredUser_ID from session
    $RegisteredUser_ID = $_SESSION['RegisteredUser_ID'];

    try {
        // Begin transaction
        $db->beginTransaction();

        // SQL query to insert financial details
        $sql = "INSERT INTO financialdetails (RegisteredUser_ID, annual_income, additional_income_amount, mortgage_duration, total_balance, other_commitments, monthly_spending_amounts, deposit_amounts, credit_score) 
                VALUES (:RegisteredUser_ID, :annual_income, :additional_income_amount, :mortgage_duration, :total_balance, :other_commitments, :monthly_spending_amounts, :deposit_amounts, :credit_score)";

        $stmt = $db->prepare($sql);

        // Bind parameters
        $stmt->bindParam(':RegisteredUser_ID', $RegisteredUser_ID);
        $stmt->bindParam(':annual_income', $annual_income);
        $stmt->bindParam(':additional_income_amount', $additional_income_amount);
        $stmt->bindParam(':mortgage_duration', $mortgage_duration);
        $stmt->bindParam(':total_balance', $total_balance);
        $stmt->bindParam(':other_commitments', $other_commitments);
        $stmt->bindParam(':monthly_spending_amounts', $monthly_spending_amounts);
        $stmt->bindParam(':deposit_amounts', $deposit_amounts);
        $stmt->bindParam(':credit_score', $credit_score);

        $stmt->execute();

        // Commit transaction
        $db->commit();

        echo "<p>Financial details submitted successfully!</p>";
    } catch (Exception $e) {
        // Rollback transaction
        $db->rollBack();
        echo "Error: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Financial Details</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>

<body>

    <header>
        <a href="Home.php"> <img src="Assets/logo.png" alt="Rose Mortgage"> </a>
    </header>

    <main>

        <div class="reg">
            <h2>Financial Details</h2>
            <br>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <div class="mb-3">
                    <label for="annual_income" class="form-label">Annual Income:</label>
                    <input type="text" class="form-control" id="annual_income" name="annual_income" required>
                </div>
                <div class="mb-3">
                    <label for="additional_income_amount" class="form-label">Additional Income Amount:</label>
                    <input type="text" class="form-control" id="additional_income_amount" name="additional_income_amount" required>
                </div>
                <div class="mb-3">
                    <label for="mortgage_duration" class="form-label">Mortgage Duration:</label>
                    <input type="text" class="form-control" id="mortgage_duration" name="mortgage_duration" required>
                </div>
                <div class="mb-3">
                    <label for="total_balance" class="form-label">Total Balance:</label>
                    <input type="text" class="form-control" id="total_balance" name="total_balance" required>
                </div>
                <div class="mb-3">
                    <label for="other_commitments" class="form-label">Other Commitments:</label>
                    <input type="text" class="form-control" id="other_commitments" name="other_commitments" required>
                </div>
                <div class="mb-3">
                    <label for="monthly_spending_amounts" class="form-label">Monthly Spending Amounts:</label>
                    <input type="text" class="form-control" id="monthly_spending_amounts" name="monthly_spending_amounts" required>
                </div>
                <div class="mb-3">
                    <label for="deposit_amounts" class="form-label">Deposit Amounts:</label>
                    <input type="text" class="form-control" id="deposit_amounts" name="deposit_amounts" required>
                </div>
                <div class="mb-3">
                    <label for="credit_score" class="form-label">Credit Score:</label>
                    <input type="text" class="form-control" id="credit_score" name="credit_score" required>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>

    </main>

    <footer>

    </footer>

</body>

</html>
