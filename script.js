
// Function to toggle between read-only and editable states
function toggleEditable(state) {
    var inputs = document.querySelectorAll('.form-control');
    inputs.forEach(function (input) {
        input.readOnly = state;
    });
}

// Event listener for the Edit button in the Account Details section
document.getElementById('editBtn').addEventListener('click', function () {
    toggleEditable(false); // Enable editing
    this.style.display = 'none'; // Hide Edit button
    document.getElementById('saveBtn').style.display = 'block'; // Show Save button
    var inputs = document.querySelectorAll('input[type="text"], input[type="email"], input[type="tel"], input[type="password"]');
    inputs.forEach(function(input) {
        input.removeAttribute('disabled');
    });
}); 


// Event listener for the Save button in the Account Details section
document.getElementById('saveBtn').addEventListener('click', function () {
    toggleEditable(true); // Disable editing
    this.style.display = 'none'; // Hide Save button
    document.getElementById('editBtn').style.display = 'block'; // Show Edit button
    document.getElementById('editForm').submit(); // Submit the form
});

// Event listener for the Edit button in the Financial section
document.getElementById('editFinancialBtn').addEventListener('click', function () {
    toggleEditable(false); // Enable editing
    this.style.display = 'none'; // Hide Edit button
    document.getElementById('saveFinancialBtn').style.display = 'block'; // Show Save button
    var inputs = document.querySelectorAll('input[type="text"], input[type="email"], input[type="tel"], input[type="password"]');
    inputs.forEach(function(input) {
        input.removeAttribute('disabled');
    });
});

// Event listener for the Save button in the Financial section
document.getElementById('saveFinancialBtn').addEventListener('click', function () {
    toggleEditable(true); // Disable editing
    this.style.display = 'none'; // Hide Save button
    document.getElementById('editFinancialBtn').style.display = 'block'; // Show Edit button
});

// Event listener for the Edit button in the broker Details section
document.getElementById('editbrokerBtn').addEventListener('click', function () {
    toggleEditable(false); // Enable editing
    this.style.display = 'none'; // Hide Edit button
    document.getElementById('savebrokerBtn').style.display = 'block'; // Show Save button
    var inputs = document.querySelectorAll('input[type="text"], input[type="email"], input[type="tel"], input[type="password"]');
    inputs.forEach(function(input) {
        input.removeAttribute('disabled');
    });
});

document.getElementById('savebrokerBtn').addEventListener('click', function () {
    toggleEditable(true); // Disable editing
    this.style.display = 'none'; // Hide Save button
    document.getElementById('editbrokerBtn').style.display = 'block'; // Show Edit button
});

//Mortgage calculator

function calculate() {
    var principal = parseFloat(document.getElementById("principal").value);
    var annualInterestRate = parseFloat(document.getElementById("interest").value);
    var years = parseInt(document.getElementById("years").value);

    var monthlyInterestRate = annualInterestRate / 100 / 12;
    var months = years * 12;

   
    var monthlyPayment = principal * (monthlyInterestRate * Math.pow((1 + monthlyInterestRate), months)) / (Math.pow((1 + monthlyInterestRate), months) - 1);  // formula for monthly mortgage payment

   
    document.getElementById("result").innerHTML = "£" + monthlyPayment.toFixed(2);  // result
}


