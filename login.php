<?php include('server.php') ?>
<!DOCTYPE html>
<html>

<head>
    <title> User Login Page</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-image: url('image/adventure/signup_bg.jpg');
            /* Add your background image URL here */
            background-size: cover;
            /* Ensure the background image covers the entire body */
            background-repeat: no-repeat;
            /* Prevent the background image from repeating */
            background-position: center;
            /* Center the background image */
            background-color: rgba(255, 255, 255, 0.5);
            /* Add background color with opacity to make content readable */
        }

        .login-container {
            width: 300px;
            margin: 100px auto;
            /* Center the login container vertically and horizontally */
            border: 1px solid #ccc;
            padding: 40px;
            border-radius: 5px;
            background-color: rgba(0, 0, 0, 0.2);
            /* Add background color with opacity */
        }

        input[type="text"],
        input[type="password"] {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            border-radius: 3px;
            border: 1px solid #ccc;
        }

        .button-container {
            width: 100%;
            text-align: center;
        }

        button[type="submit"] {
            width: 50%;
            padding: 10px;
            border: none;
            background-color: #007bff;
            color: white;
            border-radius: 3px;
            cursor: pointer;
        }

        button[type="submit"]:hover {
            background-color: #0056b3;
        }
    </style>
</head>

<body>

    <div class="login-container" id="login" >
        <h2>Login</h2>
        <form method="post" action="login.php">
            <?php include('errors.php'); ?>

            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required>
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>
            <button type="submit" class="btn" name="login_user">Login</button>
        </form>
        <p>Don't have an account? <a href="register.php">Click Here</a></p>
        <p>Forgot your password? <a href="forgot_password.php">Reset Password</a></p>
    </div>

</body>

</html>
