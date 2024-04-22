<?php
session_start();

// Initializing variables
$username = "";
$email    = "";
$errors = array(); 

// Clear errors array on page refresh
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $errors = array();
}

// Connect to the database
$db = mysqli_connect('localhost', 'root', '', 'travaldb');

// Check connection
if (!$db) {
    die("Connection failed: " . mysqli_connect_error());
}

// Register user
if (isset($_POST['reg_user'])) {
    // Receive all input values from the form
    $username = mysqli_real_escape_string($db, $_POST['username']);
    $email = mysqli_real_escape_string($db, $_POST['email']);
    $password = mysqli_real_escape_string($db, $_POST['password']);

    // Form validation: ensure that the form is correctly filled
    if (empty($username)) { 
        array_push($errors, "Username is required"); 
    }
    if (empty($email)) { 
        array_push($errors, "Email is required"); 
    }
    if (empty($password)) { 
        array_push($errors, "Password is required"); 
    }
    

    // Check the database to make sure a user does not already exist with the same username and/or email
    $user_check_query = "SELECT * FROM users WHERE username='$username' OR email='$email' LIMIT 1";
    $result = mysqli_query($db, $user_check_query);
    $user = mysqli_fetch_assoc($result);
    // Clear errors array on page refresh

  
    if ($user) { // If user exists
        if ($user['username'] === $username) {
            // If username already exists
            $error_message = "<span style='color: red;'>Username already exists</span>";
            array_push($errors, $error_message);
        }
        if ($user['email'] === $email) {
            // If email already exists
            $error_message = "<span style='color: red;'>Email already exists</span>";
            array_push($errors, $error_message);
        }
        
    }

    // Register the user if there are no errors in the form
    if (count($errors) == 0) {
        // No need to hash the password, use it as it is
        $password_plain = $password;
    
        // Continue with your code to insert the user data into the database
        $query = "INSERT INTO users (username, email, password) VALUES ('$username', '$email', '$password_plain')";
        mysqli_query($db, $query);
        $_SESSION['username'] = $username;
        $_SESSION['success'] = "You are now logged in";
        header('location: register_success.php'); // Change this to the correct page
        exit();
    }
}

// Login user
if (isset($_POST['login_user'])) {
    $username = mysqli_real_escape_string($db, $_POST['username']);
    $password = mysqli_real_escape_string($db, $_POST['password']);

    if (empty($username)) {
        array_push($errors, "Username is required");
    }
    if (empty($password)) {
        array_push($errors, "Password is required");
    }

    if (count($errors) == 0) {
        // Query to retrieve the user information from the database
        $query = "SELECT * FROM users WHERE username='$username'";
        $result = mysqli_query($db, $query);
        if (mysqli_num_rows($result) == 1) {
            $row = mysqli_fetch_assoc($result);
            $password_plain = $row['password'];
            $login_attempts = $row['login_attempts'];

            // Check if password matches
            if ($password == $password_plain) {
                // Reset login attempts if login successful
                $login_attempts = 0;
                $update_attempts_query = "UPDATE users SET login_attempts=$login_attempts WHERE username='$username'";
                mysqli_query($db, $update_attempts_query);

                $_SESSION['username'] = $username;
                $_SESSION['success'] = "You are now logged in";
                header('location: index.php'); // Change this to the correct page
                exit();
            } else {
                // Increment login attempts if password is incorrect
                $login_attempts++;
                $update_attempts_query = "UPDATE users SET login_attempts=$login_attempts WHERE username='$username'";
                mysqli_query($db, $update_attempts_query);

                if ($login_attempts >= 3) {
                    // Prompt user to reset password after 3 failed attempts
                    echo '<script type="text/javascript">';
                    echo 'if(confirm("You have attempted 3 times. Do you forget the password?"))';
                    echo 'window.location.href = "forgot_password.php?username=' . $username . '";';
                    echo 'else window.location.href = "login.php";';
                    echo '</script>';
                } else {
                    // If username/password combination is wrong
                    $error_message = "<span style='color: red;'>Wrong username/password combination</span>";
                    array_push($errors, $error_message);
                }
            }
        }  else {
            // If user is not found
            $error_message = "<span style='color: red;'>User not found</span>";
            array_push($errors, $error_message);
        }
    }
}


// Logout user
if (isset($_GET['logout'])) {
    session_unset();
    session_destroy();
    header('location: login.php');
    exit();
}
?>

