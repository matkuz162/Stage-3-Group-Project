document.addEventListener('DOMContentLoaded', function() {
    const editPersonalBtn = document.getElementById('editPersonalBtn');
    const savePersonalBtn = document.getElementById('savePersonalBtn');
    const editFinancialBtn = document.getElementById('editFinancialBtn');
    const saveFinancialBtn = document.getElementById('saveFinancialBtn');
    const editLoanBtn = document.getElementById('editLoanBtn');
    const saveLoanBtn = document.getElementById('saveLoanBtn');
    const editbrkBtn = document.getElementById('editbrkBtn');
    const savebrkBtn = document.getElementById('savebrkBtn');

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

    // Broker Details
    editbrkBtn.addEventListener('click', function() {
        toggleButtons(editbrkBtn, savebrkBtn);
        enableEditing(document.querySelectorAll('#first_name, #last_name, #email, #phone_number, #country, #county, #city, #postcode, #broker_license_number, #company_name, #company_registration_number, #company_country, #company_county, #company_city, #company_postcode'));
    });
  });



//Mortgage calculator

function calculateMonthlyPayment() {
    var principal = parseFloat(document.getElementById("principal").value);
    var annualInterestRate = parseFloat(document.getElementById("interest").value);
    var years = parseInt(document.getElementById("years").value);

    var monthlyInterestRate = annualInterestRate / 100 / 12;//converts interest rate from percentage to decimal
    var months = years*12;

   
    var monthlyPayment = principal * (monthlyInterestRate * Math.pow((1 + monthlyInterestRate), months)) / (Math.pow((1 + monthlyInterestRate), months) - 1);  // formula for monthly mortgage payment

   
    document.getElementById("result").innerHTML = "£" + monthlyPayment.toFixed(2);  // result
}

//reset password captcha
const captchaTextBox = document.querySelector(".captcha-box");
const refreshButton = document.querySelector(".refreshButton");
const captchaInputBox = document.querySelector(".captcha-input");
const message = document.querySelector(".message");
const submitButton = document.querySelector(".button");

//Variable to store generated captcha

let captchaText = null;

//function to generate captcha
const generateCaptcha = () => {
    const randomString = math.random().toString(36).subString(2,7);
    const randomStringArray = randomString.split("");
    const changeString = randomStringArray.map(char => (Math.random() > 0.5? char.toUpperCase(): char));
    captchaText = changeString.join("  ");
    captchaTextBox.value = captchaText;
    console.log(captchaText);

};
const refreshBtnClick= () => {
    generateCaptcha();
    captchaInputBox.value="";
    captchaKeyUpValidate();
};
const captchaKeyUpValidate = () =>{
 submitButton.classList.toggle("disabled", !captchaInputBox.value);

 if(captchaInputBox.value ==="") message.classList.remove("active");
};

const submitBtnClick= ()=>{
    captchaText = captchaText
    .split("")
    .filter((char) => char !== " ")
    .join("");
    
    message.classList.add("active");
    if(captchaInputBox.value === captchaText){
        message.innerText ="Entered captcha is correct";
        message.style.color = "#826afb";
    }
    
    else{
        message.innerText ="Entered captcha is not correct";
        message.style.color = "##FF2525";
    }
};
//add event listener for the refresh button
refreshButton.addEventListener("click", refreshBtnClick); 
captchaInputBox.addEventListener("keyup", captchaKeyUpValidate);
submitButton.addEventListener("click", submitBtnClick);
generateCaptcha();