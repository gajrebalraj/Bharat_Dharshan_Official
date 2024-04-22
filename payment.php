<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f2f2f2;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h1 {
            text-align: center;
            margin-top: 20px;
        }
        form {
            margin-top: 20px;
            text-align: center;
        }
        input[type="text"],
        input[type="email"],
        input[type="tel"],
        select {
            width: 100%;
            padding: 10px;
            margin-top: 10px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }
        input[type="submit"] {
            width: 100%;
            padding: 10px;
            margin-top: 20px;
            font-size: 16px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #0056b3;
        }
        #QRCode {
            text-align: center;
            margin-top: 20px;
        }
        #QRCode img {
            max-width: 300px;
            height: auto;
        }
        .error {
            color: red;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Payment</h1>
        
        <!-- Personal Information -->
        <form id="paymentForm">
            <input type="text" id="name" name="name" placeholder="Your Name" required>
            <input type="email" id="email" name="email" placeholder="Your Email" required>
            <input type="tel" id="phoneNumber" name="phoneNumber" placeholder="Your Phone Number" required>
            <input type="tel" id="altPhoneNumber" name="altPhoneNumber" placeholder="Alternative Phone Number" required>
            <select id="gender" name="gender" required>
                <option value="">Select Gender</option>
                <option value="male">Male</option>
                <option value="female">Female</option>
            </select>

            <!-- Amount Input -->
            
            <!-- UPI ID or QR Code Option -->
            <div id="paymentMethodSelection">
                <label for="paymentMethod">Select payment method:</label>
                <select id="paymentMethod" name="paymentMethod" onchange="togglePaymentMethod()">
                    <option value="upi">UPI ID</option>
                    <option value="qr">QR Code</option>
                </select>
                
            </div>

            <!-- UPI ID Input -->
            <div id="upiInput" style="display: none;">
                <input type="text" id="upiId" name="upiId" placeholder="Enter UPI ID">
                <button type="button" onclick="verifyUPI()">Verify</button>
                <p id="upiError" class="error" style="display: none;">Please enter a valid UPI ID</p>
                <p id="verificationStatus" style="display: none; color: green;">UPI ID verified successfully!</p>
            </div>

            <!-- QR Code Placeholder -->
            <div id="qrCode" style="display: none;">
                <div id="QRCode"></div>
            </div>

            <input type="submit" value="Proceed to Payment" id="proceedBtn">
        </form>
    </div>

    <script>
        function verifyUPI() {
            var upiId = document.getElementById('upiId').value;
            if (upiId.trim() === "") {
                document.getElementById('upiError').style.display = 'block';
                document.getElementById('verificationStatus').style.display = 'none';
            } else {
                // Here you would typically implement your UPI ID verification logic
                // For demonstration purposes, let's assume the ID is verified successfully
                document.getElementById('upiError').style.display = 'none';
                document.getElementById('verificationStatus').style.display = 'block';
            }
        }

        function togglePaymentMethod() {
            var paymentMethod = document.getElementById('paymentMethod').value;
            if (paymentMethod === 'upi') {
                document.getElementById('upiInput').style.display = 'block';
                document.getElementById('qrCode').style.display = 'none';
            } else if (paymentMethod === 'qr') {
                document.getElementById('upiInput').style.display = 'none';
                document.getElementById('qrCode').style.display = 'block';
                // Here you would typically generate the QR code for payment
                // For demonstration purposes, let's just show a placeholder
                var QRCodeElement = document.getElementById('QRCode');
                QRCodeElement.innerHTML = '<img src="path_to_your_qr_code_image" alt="QR Code">';
            }
        }

        document.getElementById('paymentForm').addEventListener('submit', function(event) {
            event.preventDefault();
            var name = document.getElementById('name').value;
            var email = document.getElementById('email').value;
            var phoneNumber = document.getElementById('phoneNumber').value;
            var altPhoneNumber = document.getElementById('altPhoneNumber').value;
            var gender = document.getElementById('gender').value;
            var amount = document.getElementById('amount').value;
            if (name.trim() === "" || email.trim() === "" || phoneNumber.trim() === "" || altPhoneNumber.trim() === "" || gender.trim() === "" || amount.trim() === "") {
                alert("Please fill in all required fields.");
                return;
            }
            var paymentMethod = document.getElementById('paymentMethod').value;
            if (paymentMethod === 'upi') {
                var upiId = document.getElementById('upiId').value;
                if (upiId.trim() === "") {
                    document.getElementById('upiError').style.display = 'block';
                    document.getElementById('verificationStatus').style.display = 'none';
                    return; // Stop further processing if UPI ID is empty
                }
                // Here you would typically initiate the payment process using the provided UPI ID
                // For demonstration purposes, you can add your logic here
                alert("Proceeding with UPI payment for UPI ID: " + upiId + " and Amount: " + amount);
            } else if (paymentMethod === 'qr') {
                // Here you would typically initiate the payment process using the QR code
                // For demonstration purposes, you can add your logic here
                alert("Proceeding with QR code payment and Amount: " + amount);
            }
        });
    </script>

</body>
</html>
