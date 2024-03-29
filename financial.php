<!DOCTYPE html>
<html lang="en">

<head>
  <title>Financial Details</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="form.css">
</head>

<body>

  <header>
    <a href="Home.html"> <img src="Assets/logo.png" alt="Rose Mortgage"> </a>
  </header>


  <main>

  <div class="reg">
    <h2>Financial Details</h2>
    <br>
    <form action="memreg.php" method="post">
      <div class="mb-3">
        <label for="annual" class="form-label">1 - Annual Income:</label>
        <input type="text" class="form-control" id="annual" name="annual" required>
      </div>
      <br>
      <div class="mb-3">
        <label for="addinc" class="form-label">2 - Receive Additional Income?</label>
        <select class="form-select" id="addinc" name="addinc">
          <option value="select">--Select--</option>
          <option value="no">No</option>
          <option value="yes">Yes</option>
        </select>
      </div>
      <br>
      <div class="mb-3">
        <label for="amount" class="form-label">2.1 - Amount of Additional Income?</label>
        <input type="text" class="form-control" id="amount" name="amount" required>
      </div>
      <br>
      <div class="mb-3">
        <label for="duration" class="form-label">3 - Mortgage Duration?</label>
        <input type="text" class="form-control" id="duration" name="duration" required>
      </div>
      <br>
      <div class="mb-3">
        <label for="balance" class="form-label">4 - Total Balance held by User:</label>
        <input type="text" class="form-control" id="balance" name="balance" required>
      </div>
      <br>
      <div class="mb-3">
        <label for="commit" class="form-label">5 - Major Monthly Commitments?</label>
        <input type="text" class="form-control" id="commit" name="commit">
      </div>
      <br>
      <div class="mb-3">
        <label for="credit" class="form-label">6 - Credit Score</label>
        <input type="text" class="form-control" id="credit" name="credit">
      </div>
      <br>
      <div class="mb-3">
        <label for="deposit" class="form-label">7 - Deposit</label>
        <input type="text" class="form-control" id="deposit" name="deposit">
      </div>
      <br>
      <div class="mb-3">
        <label for="disposable" class="form-label">8 - Disposable Income</label>
        <input type="text" class="form-control" id="disposable" name="disposable">
      </div>
      <br>
      <button type="submit" class="btn btn-primary">Submit</button>
    </form>
  </div>



</main>



  <footer>

  </footer>

</body>

</html>
