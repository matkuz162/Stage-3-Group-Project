
document.addEventListener('DOMContentLoaded', function() {
    const editPersonalBtn = document.getElementById('editPersonalBtn');
    const savePersonalBtn = document.getElementById('savePersonalBtn');
    const editFinancialBtn = document.getElementById('editFinancialBtn');
    const saveFinancialBtn = document.getElementById('saveFinancialBtn');
    const editLoanBtn = document.getElementById('editLoanBtn');
    const saveLoanBtn = document.getElementById('saveLoanBtn');

    //Function to toggle between edit and save buttons
    function toggleButtons(editBtn, saveBtn) {
      editBtn.style.display = 'none';
      saveBtn.style.display = 'block';
    }

    //Function to enable editing of form fields
    function enableEditing(fields) {
      fields.forEach(field => {
        field.removeAttribute('readonly');
      });
    }

    //Personal Details
    editPersonalBtn.addEventListener('click', function() {
      toggleButtons(editPersonalBtn, savePersonalBtn);
      enableEditing(document.querySelectorAll('#first_name, #last_name, #email, #phone_number, #country, #county, #city, #postcode'));
    });

    //Financial Details
    editFinancialBtn.addEventListener('click', function() {
      toggleButtons(editFinancialBtn, saveFinancialBtn);
      enableEditing(document.querySelectorAll('#annual_income, #additional_income, #total_balance, #major_monthly_commitments_bool, #credit_score'));
    });

    //Loan Details
    editLoanBtn.addEventListener('click', function() {
      toggleButtons(editLoanBtn, saveLoanBtn);
      enableEditing(document.querySelectorAll('#mortgage_reason, #estimated_property_value, #borrow_amount, #mortgage_term'));
    });

  });

  
//delete account

$(document).ready(function() {
  $('#delete-userBtn').click(function() {
    if (confirm("Are you sure you want to delete your account? This action cannot be undone.")) {
      window.location.href = 'delete-user.php';
    }
  });
});

function passwordSubmitBtnClick() {
    window.location.href = 'http://localhost/Stage-3-Group-Project/changePassword.php';
}



//Mortgage calculator

function calculateMonthlyPayment() {
    var principal = parseFloat(document.getElementById("principal").value);
    var annualInterestRate = parseFloat(document.getElementById("interest").value);
    var years = parseInt(document.getElementById("years").value);

    var monthlyInterestRate = annualInterestRate / 100 / 12;//converts interest rate from percentage to decimal
    var months = years*12;

   
    var monthlyPayment = principal * (monthlyInterestRate * Math.pow((1 + monthlyInterestRate), months)) / (Math.pow((1 + monthlyInterestRate), months) - 1);  // formula for monthly mortgage payment

   
    document.getElementById("result").innerHTML = "£" + monthlyPayment.toFixed(2);  //result
}

