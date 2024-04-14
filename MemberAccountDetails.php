<?php

session_start();
include 'connection.php'; 

if (!isset($_SESSION['RegisteredUser_ID'])) {
  // Redirect to login page
  header('Location: login.html');
  exit();
}

$RegisteredUser_ID = $_SESSION['RegisteredUser_ID'];

$sqlPersonal = "SELECT first_name, last_name, email, phone_number, country, county, city, postcode FROM RegisteredUser WHERE RegisteredUser_ID=:RegisteredUser_ID";
$sqlFinancial = "SELECT annual_income, additional_income_amount, total_balance, other_commitments, credit_score FROM financialdetails WHERE RegisteredUser_ID=:RegisteredUser_ID";
$sqlLoan = "SELECT mortgage_reason, estimated_property_value, borrow_amount, mortgage_term FROM financialdetails WHERE RegisteredUser_ID=:RegisteredUser_ID";

// Fetch personal details
$stmtPersonal = $db->prepare($sqlPersonal);
$stmtPersonal->bindParam(':RegisteredUser_ID', $RegisteredUser_ID, PDO::PARAM_INT);
$stmtPersonal->execute();
$personalDetails = $stmtPersonal->fetch(PDO::FETCH_ASSOC);

// Fetch financial details
$stmtFinancial = $db->prepare($sqlFinancial);
$stmtFinancial->bindParam(':RegisteredUser_ID', $RegisteredUser_ID, PDO::PARAM_INT);
$stmtFinancial->execute();
$financialDetails = $stmtFinancial->fetch(PDO::FETCH_ASSOC);

// Fetch loan details
$stmtLoan = $db->prepare($sqlLoan);
$stmtLoan->bindParam(':RegisteredUser_ID', $RegisteredUser_ID, PDO::PARAM_INT);
$stmtLoan->execute();
$loanDetails = $stmtLoan->fetch(PDO::FETCH_ASSOC);

if (isset($_POST['submit'])) {
  // Update personal details
  $first_name = $_POST['first_name'];
  $last_name = $_POST['last_name'];
  $email = $_POST['email'];
  $phone_number = $_POST['phone_number'];
  $country = $_POST['country'];
  $county = $_POST['county'];
  $city = $_POST['city'];
  $postcode = $_POST['postcode'];

  $sqlsubmit = "UPDATE RegisteredUser
                SET first_name = :first_name, last_name = :last_name, email = :email, phone_number = :phone_number, country = :country, county = :county, city = :city, postcode = :postcode
                WHERE RegisteredUser_ID = :RegisteredUser_ID";

  $stmt = $db->prepare($sqlsubmit);
  $stmt->bindParam(':first_name', $first_name);
  $stmt->bindParam(':last_name', $last_name);
  $stmt->bindParam(':email', $email);
  $stmt->bindParam(':phone_number', $phone_number);
  $stmt->bindParam(':country', $country);
  $stmt->bindParam(':county', $county);
  $stmt->bindParam(':city', $city);
  $stmt->bindParam(':postcode', $postcode);
  $stmt->bindParam(':RegisteredUser_ID', $RegisteredUser_ID, PDO::PARAM_INT);

  if ($stmt->execute()) {
    echo "Personal details updated successfully";
  } else {
    echo "Error updating personal details: " . $stmt->errorInfo()[2];
  }
}

if (isset($_POST['finance-submit'])) {
  // Update financial details
  $annual_income = $_POST['annual_income'];
  $additional_income = $_POST['additional_income'];
  $total_balance = $_POST['total_balance'];
  $major_monthly_commitments_bool = $_POST['major_monthly_commitments_bool'];
  $credit_score = $_POST['credit_score'];

  $financialsubmit = "UPDATE financialdetails 
                      SET annual_income = :annual_income,
                          additional_income_amount = :additional_income,
                          total_balance = :total_balance,
                          other_commitments = :major_monthly_commitments_bool,
                          credit_score = :credit_score
                      WHERE RegisteredUser_ID = :RegisteredUser_ID";

  $stmt = $db->prepare($financialsubmit);
  $stmt->bindParam(':annual_income', $annual_income);
  $stmt->bindParam(':additional_income', $additional_income);
  $stmt->bindParam(':total_balance', $total_balance);
  $stmt->bindParam(':major_monthly_commitments_bool', $major_monthly_commitments_bool);
  $stmt->bindParam(':credit_score', $credit_score);
  $stmt->bindParam(':RegisteredUser_ID', $RegisteredUser_ID, PDO::PARAM_INT);

  if ($stmt->execute()) {
    echo "Financial details updated successfully";
  } else {
    echo "Error updating financial details: " . $stmt->errorInfo()[2];
  }
}

if (isset($_POST['loan-submit'])) {
  // Update loan details
  $mortgage_reason = $_POST['mortgage_reason'];
  $estimated_property_value = $_POST['estimated_property_value'];
  $borrow_amount = $_POST['borrow_amount'];
  $mortgage_term = $_POST['mortgage_term'];

  $loansubmit = "UPDATE financialdetails 
                 SET mortgage_reason = :mortgage_reason,
                     estimated_property_value = :estimated_property_value,
                     borrow_amount = :borrow_amount,
                     mortgage_term = :mortgage_term
                 WHERE RegisteredUser_ID = :RegisteredUser_ID";

  $stmt = $db->prepare($loansubmit);
  $stmt->bindParam(':mortgage_reason', $mortgage_reason);
  $stmt->bindParam(':estimated_property_value', $estimated_property_value);
  $stmt->bindParam(':borrow_amount', $borrow_amount);
  $stmt->bindParam(':mortgage_term', $mortgage_term);
  $stmt->bindParam(':RegisteredUser_ID', $RegisteredUser_ID, PDO::PARAM_INT);

  if ($stmt->execute()) {
    echo "Loan details updated successfully";
  } else {
    echo "Error updating loan details: " . $stmt->errorInfo()[2];
  }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Update Account Information</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="style.css" rel="stylesheet">
</head>

<body>

  <header class="flex-container">
    <a href="MemberViewProducts.php"> <img src="Assets/logo.png" alt="Rose Mortgage"> </a>
    <div>
      <ul class="nav-links">
        <li><a href="MemberViewProducts.php">Available Products</a></li>
        <li><a href="MemberChosenProducts.php">Chosen Products</a></li>
        <li><a href="MemberAccountDetails.php">Account Details</a></li>
        <li><a href="home.php">Sign Out</a></li>
      </ul>
    </div>
  </header>

  <main>

    <div class="reg">
      <h2 class="mb-4"><b>Personal Details:</b></h2>
      <form action="MemberAccountDetails.php" method="post">
        <div class="form-group">
          <label for="first_name" class="form-label">First Name:</label>
          <input type="text" class="form-control" id="first_name" name="first_name" value="<?php echo $personalDetails['first_name']; ?>" required>
        </div>
        <div class="form-group">
          <label for="last_name" class="form-label">Last Name:</label>
          <input type="text" class="form-control" id="last_name" name="last_name" value="<?php echo $personalDetails['last_name']; ?>" required>
        </div>
        <div class="form-group">
          <label for="email" class="form-label">Email:</label>
          <input type="email" class="form-control" id="email" name="email" value="<?php echo $personalDetails['email']; ?>" required>
        </div>
        <div class="form-group">
          <label for="phone_number" class="form-label">Phone Number:</label>
          <input type="tel" class="form-control" id="phone_number" name="phone_number" value="<?php echo $personalDetails['phone_number']; ?>" required>
        </div>
        <div class="form-group">
          <label for="country" class="form-label">Country:</label>
          <input type="text" class="form-control" id="country" name="country" value="<?php echo $personalDetails['country']; ?>" required>
        </div>
        <div class="form-group">
          <label for="county" class="form-label">County:</label>
          <input type="text" class="form-control" id="county" name="county" value="<?php echo $personalDetails['county']; ?>">
        </div>
        <div class="form-group">
          <label for="city" class="form-label">City:</label>
          <input type="text" class="form-control" id="city" name="city" value="<?php echo $personalDetails['city']; ?>" required>
        </div>
        <div class="form-group">
          <label for="postcode" class="form-label">Postcode:</label>
          <input type="text" class="form-control" id="postcode" name="postcode" value="<?php echo $personalDetails['postcode']; ?>" required>
        </div>

        <button type="button" id="editPersonalBtn" class="btn btn-primary btn-lg btn-block" style="width: 100%;">Edit Personal Details</button>
        <button type="submit" name="submit" id="savePersonalBtn" class="btn btn-secondary btn-lg btn-block" style="display: none; width: 100%;">Save Personal Details</button>
      </form>
    </div>

    <br><br><br>

    <div class="reg">
      <h2 class="mb-4"><b>Financial Details:</b></h2>
      <form action="MemberAccountDetails.php" method="post">
        <div class="form-group">
          <label for="annual_income" class="form-label">Annual Income:</label>
          <input type="text" class="form-control" id="annual_income" name="annual_income" value="<?php echo $financialDetails['annual_income']; ?>" required>
        </div>
        <div class="form-group">
          <label for="additional_income" class="form-label">Amount of Additional Income:</label>
          <input type="text" class="form-control" id="additional_income" name="additional_income" value="<?php echo $financialDetails['additional_income_amount']; ?>" required>
        </div>
        <div class="form-group">
          <label for="total_balance" class="form-label">Total Balance held by User:</label>
          <input type="text" class="form-control" id="total_balance" name="total_balance" value="<?php echo $financialDetails['total_balance']; ?>" required>
        </div>
        <div class="form-group">
          <label for="major_monthly_commitments_bool" class="form-label">Major Monthly Commitments?</label>
          <input type="text" class="form-control" id="major_monthly_commitments_bool" name="major_monthly_commitments_bool" value="<?php echo $financialDetails['other_commitments']; ?>" required>
        </div>
        <div class="form-group">
          <label for="credit_score" class="form-label">Credit Score:</label>
          <input type="text" class="form-control" id="credit_score" name="credit_score" value="<?php echo $financialDetails['credit_score']; ?>" required>
        </div>

        <button type="button" id="editFinancialBtn" class="btn btn-primary btn-lg btn-block" style="width: 100%;">Edit Financial Details</button>
        <button type="submit" name="finance-submit" id="saveFinancialBtn" class="btn btn-secondary btn-lg btn-block" style="display: none; width: 100%;">Save Financial Details</button>
      </form>
    </div>

    <br><br><br>
        
    <div class="reg">
      <h2 class="mb-4"><b>Loan Details:</b></h2>
      <form action="MemberAccountDetails.php" method="post">
        <div class="form-group">
          <label for="mortgage_reason" class="form-label">Reason for Mortgage:</label>
          <select class="form-select" id="mortgage_reason" name="mortgage_reason" required>
            <option value="first_house" <?php if ($loanDetails['mortgage_reason'] == 'first_house') echo 'selected'; ?>>First House</option>
            <option value="moving_home" <?php if ($loanDetails['mortgage_reason'] == 'moving_home') echo 'selected'; ?>>Moving Home</option>
          </select>
        </div>
        <div class="form-group">
          <label for="estimated_property_value" class="form-label">Estimated Property Value:</label>
          <input type="number" class="form-control" id="estimated_property_value" name="estimated_property_value" value="<?php echo $loanDetails['estimated_property_value']; ?>" required>
        </div>
        <div class="form-group">
          <label for="borrow_amount" class="form-label">Amount to Borrow (minimum £6000):</label>
          <input type="number" class="form-control" id="borrow_amount" name="borrow_amount" value="<?php echo $loanDetails['borrow_amount']; ?>" min="6000" required>
        </div>
        <div class="form-group">
          <label for="mortgage_term" class="form-label">Mortgage Term (years):</label>
          <input type="number" class="form-control" id="mortgage_term" name="mortgage_term" value="<?php echo $loanDetails['mortgage_term']; ?>" required>
        </div>
        <button type="button" id="editLoanBtn" class="btn btn-primary btn-lg btn-block" style="width: 100%;">Edit Loan Details</button>
        <button type="submit" name="loan-submit" id="saveLoanBtn" class="btn btn-secondary btn-lg btn-block" style="display: none; width: 100%;">Save Loan Details</button>
      </form>
    </div>

    </main>

<footer>

</footer>

<script>
  document.addEventListener('DOMContentLoaded', function() {
    const editPersonalBtn = document.getElementById('editPersonalBtn');
    const savePersonalBtn = document.getElementById('savePersonalBtn');
    const editFinancialBtn = document.getElementById('editFinancialBtn');
    const saveFinancialBtn = document.getElementById('saveFinancialBtn');
    const editLoanBtn = document.getElementById('editLoanBtn');
    const saveLoanBtn = document.getElementById('saveLoanBtn');

    // Function to toggle between edit and save buttons
    function toggleButtons(editBtn, saveBtn) {
      editBtn.style.display = 'none';
      saveBtn.style.display = 'block';
    }

    // Function to enable editing of form fields
    function enableEditing(fields) {
      fields.forEach(field => {
        field.removeAttribute('readonly');
      });
    }

    // Personal Details
    editPersonalBtn.addEventListener('click', function() {
      toggleButtons(editPersonalBtn, savePersonalBtn);
      enableEditing(document.querySelectorAll('#first_name, #last_name, #email, #phone_number, #country, #county, #city, #postcode'));
    });

    // Financial Details
    editFinancialBtn.addEventListener('click', function() {
      toggleButtons(editFinancialBtn, saveFinancialBtn);
      enableEditing(document.querySelectorAll('#annual_income, #additional_income, #total_balance, #major_monthly_commitments_bool, #credit_score'));
    });

    // Loan Details
    editLoanBtn.addEventListener('click', function() {
      toggleButtons(editLoanBtn, saveLoanBtn);
      enableEditing(document.querySelectorAll('#mortgage_reason, #estimated_property_value, #borrow_amount, #mortgage_term'));
    });
  });
</script>

</body>

</html>