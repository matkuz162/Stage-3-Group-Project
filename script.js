    // Function to toggle between read-only and editable states
    function toggleEditable(state) {
        var inputs = document.querySelectorAll('.form-control');
        inputs.forEach(function (input) {
            input.readOnly = state;
        });
    }

    // Event listener for the Edit button
    document.getElementById('editBtn').addEventListener('click', function () {
        toggleEditable(false); // Enable editing
        this.style.display = 'none'; // Hide Edit button
        document.getElementById('saveBtn').style.display = 'block'; // Show Save button
    });

    // Event listener for the Save button
    document.getElementById('saveBtn').addEventListener('click', function () {
        toggleEditable(true); // Disable editing
        this.style.display = 'none'; // Hide Save button
        document.getElementById('editBtn').style.display = 'block'; // Show Edit button
        document.getElementById('editForm').submit(); // Submit the form
    });