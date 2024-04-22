<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Password Reset Confirmation</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            text-align: center;
        }
        .container {
            width: 300px;
            margin: 100px auto;
            border: 1px solid #ccc;
            padding: 40px;
            border-radius: 5px;
            background-color: #fff;
        }
        p {
            margin-bottom: 20px;
        }
        button {
            padding: 10px 20px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 3px;
            cursor: pointer;
        }
        button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>

    <div class="container">
        <h2>Password Reset Confirmation</h2>
        <p>An email containing a password reset link has been sent to your email address. Please check your inbox and follow the instructions provided to reset your password.</p>
        <button onclick="window.location.href='login.php'">Back to Login</button>
    </div>

</body>
</html>
