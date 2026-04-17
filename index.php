<?php
session_start();

if (isset($_SESSION['employee_name']) && isset($_SESSION['employee_number'])) {
    header('Location: policies.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Policy Acknowledgment - Brand Soluxions Inc.</title>
    <link rel="icon" type="image/png" href="assets/images/Logo.png">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <div class="login-page">
        <div class="login-card">
            <div class="login-logo">
                <img src="assets/images/Logo.png" alt="Brand Soluxions Inc.">
            </div>

            <div class="login-title">
                <h1>Employee Policy Acknowledgment</h1>
                <p>Please enter your employee number to view company policies</p>
            </div>

            <div id="alertBox"></div>

            <form id="loginForm" method="POST" novalidate>
                <div class="form-group">
                    <label for="employee_number"><i class="fas fa-id-badge"></i> Employee Number</label>
                    <input type="text" id="employee_number" name="employee_number" placeholder="Enter your employee number (e.g. 157 or EMP-157)" required autocomplete="off">
                    <div class="error-message" id="empNumError">Please enter a valid employee number</div>
                </div>

                <div class="employee-preview" id="employeePreview">
                    <div class="employee-preview-icon">
                        <i class="fas fa-user-check"></i>
                    </div>
                    <div class="employee-preview-info">
                        <strong id="previewName"></strong>
                        <span id="previewDept"></span>
                    </div>
                </div>

                <div class="form-group" id="pinGroup" style="display:none;">
                    <label for="pin_input"><i class="fas fa-lock"></i> PIN</label>
                    <input type="password" id="pin_input" name="pin_input" placeholder="Enter your PIN" autocomplete="off">
                    <div class="error-message" id="pinError">Incorrect PIN</div>
                </div>

                <button type="submit" class="btn btn-primary" id="submitBtn" disabled>
                    <span id="btnText">PROCEED TO POLICIES</span>
                </button>
            </form>
        </div>
    </div>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        var form = document.getElementById('loginForm');
        var empNum = document.getElementById('employee_number');
        var empNumError = document.getElementById('empNumError');
        var pinInput = document.getElementById('pin_input');
        var pinError = document.getElementById('pinError');
        var pinGroup = document.getElementById('pinGroup');
        var submitBtn = document.getElementById('submitBtn');
        var btnText = document.getElementById('btnText');
        var alertBox = document.getElementById('alertBox');
        var preview = document.getElementById('employeePreview');
        var previewName = document.getElementById('previewName');
        var previewDept = document.getElementById('previewDept');

        var validatedEmployee = null;
        var lookupTimer = null;

        function showError(msg) {
            empNumError.textContent = msg;
            empNum.classList.add('error');
            empNumError.classList.add('show');
        }

        function clearError() {
            empNum.classList.remove('error');
            empNumError.classList.remove('show');
        }

        function showPinError(msg) {
            pinError.textContent = msg;
            pinInput.classList.add('error');
            pinError.classList.add('show');
        }

        function clearPinError() {
            pinInput.classList.remove('error');
            pinError.classList.remove('show');
        }

        function showPreview(data) {
            previewName.textContent = data.name;
            previewDept.textContent = data.department + ' — ' + data.position;
            preview.classList.add('show');
        }

        function hidePreview() {
            preview.classList.remove('show');
        }

        function showPinField() {
            pinGroup.style.display = '';
            pinInput.disabled = false;
            pinInput.value = '';
            clearPinError();
            pinInput.focus();
        }

        function hidePinField() {
            pinGroup.style.display = 'none';
            pinInput.disabled = true;
            pinInput.value = '';
            clearPinError();
        }

        function lookupEmployee(value) {
            if (!value) {
                hidePreview();
                hidePinField();
                submitBtn.disabled = true;
                validatedEmployee = null;
                clearError();
                return;
            }

            fetch('api/validate_employee.php?id=' + encodeURIComponent(value))
                .then(function(res) { return res.json(); })
                .then(function(data) {
                    if (data.valid) {
                        clearError();
                        validatedEmployee = data;
                        showPreview(data);
                        showPinField();
                        submitBtn.disabled = false;
                    } else {
                        hidePreview();
                        hidePinField();
                        submitBtn.disabled = true;
                        validatedEmployee = null;
                        if (value.length >= 1) {
                            showError(data.message || 'Employee not found');
                        }
                    }
                })
                .catch(function() {
                    hidePreview();
                    hidePinField();
                    submitBtn.disabled = true;
                    validatedEmployee = null;
                });
        }

        empNum.addEventListener('input', function() {
            var val = empNum.value.trim();
            clearTimeout(lookupTimer);

            if (!val) {
                hidePreview();
                hidePinField();
                submitBtn.disabled = true;
                validatedEmployee = null;
                clearError();
                return;
            }

            lookupTimer = setTimeout(function() {
                lookupEmployee(val);
            }, 400);
        });

        pinInput.addEventListener('input', function() {
            clearPinError();
        });

        form.addEventListener('submit', function(e) {
            e.preventDefault();

            if (!validatedEmployee) {
                showError('Please enter a valid employee number');
                return;
            }

            var enteredPin = pinInput.value.trim();
            if (!enteredPin) {
                showPinError('Please enter your PIN');
                pinInput.focus();
                return;
            }

            submitBtn.disabled = true;
            btnText.innerHTML = '<span class="spinner"></span> PROCESSING...';

            var formData = new FormData();
            formData.append('employee_number', validatedEmployee.employee_id);
            formData.append('pin', enteredPin);

            fetch('api/save_record.php', {
                method: 'POST',
                body: formData
            })
            .then(function(res) { return res.json(); })
            .then(function(data) {
                if (data.success) {
                    window.location.href = 'policies.php';
                } else if (data.pin_error) {
                    showPinError(data.message || 'Incorrect PIN');
                    pinInput.focus();
                    submitBtn.disabled = false;
                    btnText.textContent = 'PROCEED TO POLICIES';
                } else {
                    alertBox.innerHTML = '<div class="alert alert-error"><i class="fas fa-exclamation-circle"></i> ' + (data.message || 'An error occurred. Please try again.') + '</div>';
                    submitBtn.disabled = false;
                    btnText.textContent = 'PROCEED TO POLICIES';
                }
            })
            .catch(function() {
                alertBox.innerHTML = '<div class="alert alert-error"><i class="fas fa-exclamation-circle"></i> Connection error. Please try again.</div>';
                submitBtn.disabled = false;
                btnText.textContent = 'PROCEED TO POLICIES';
            });
        });
    });
    </script>
</body>
</html>
