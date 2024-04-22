<?php include ('server.php') ?>
<!DOCTYPE html>
<html>

<head>
  <title>Register Page</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background-image: url('image/adventure/login_page.jpg');
      /* Add your background image URL here */
      background-size: cover;
      /* Ensure the background image covers the entire body */
      background-repeat: no-repeat;
      /* Prevent the background image from repeating */
      background-position: center;
      /* Center the background image */
      background-color: rgba(255, 255, 255, 0.2);
    }

    .container {
      width: 400px;
      margin: 120px auto 0 auto;
      margin-right: 230px;
      border: 2px solid black;
      /* Change border color to black */
      padding: 25px;
      border-radius: 5px;
      background-color: rgba(0, 0, 0, 0.2);
      ;
    }


    .header {
      text-align: center;
    }

    .input-group {
      margin-bottom: 10px;
      background-color: transparent;
    }

    .input-group label {
      display: block;
      margin-bottom: 5px;
     color: whitesmoke;
    }

    .input-group input {
      width: 90%;
      height: 10px;
      padding: 10px;
      border-radius: 3px;
      border: 1px solid;
      background-color: transparent;
    }

    h2 {
      color: black;
    }

    .btn {
      width: 40%;
      padding: 10px;
      border: 1px solid black;
      background-color: whitesmoke;
      color: black;
      border-radius: 3px;
      cursor: pointer;
      margin-top: 35px;
      text-align: center;
      display: block;
      /* Ensures the button takes up the full width available */
      margin-left: auto;
      /* Centers the button horizontally */
      margin-right: auto;
      /* Centers the button horizontally */
    }

    .btn:hover {
      background-color: #0056b3;
    }

    .footer {
      text-align: center;
      margin-top: 20px;
    }

    .member {
      margin: 35px auto;
      color: whitesmoke;
      text-align: center;
    }

    .link {
      color: whitesmoke;
    }
    .main{
    position: absolute;
    top: -10px; /* Adjust this value to change the distance from the top */
    right: 270px;
    margin: 60px auto 0 auto;
    }

  </style>
</head>

<body>
  <h1 class="main">welcome to Bharatdarshan  </h1>
  <div class="container">
    <div class="header">
      <h2>Register Page</h2>
    </div>
    <form method="post" action="register.php">
      <?php include ('errors.php'); ?>
      <div class="input-group">
        <label>Username</label>
        <input type="text" name="username" value="<?php echo $username; ?>" required>
      </div>
      <div class="input-group">
        <label>Email</label>
        <input type="email" name="email" value="<?php echo $email; ?>" required>
      </div>
      <div class="input-group">
        <label>Password</label>
        <input type="password" name="password" required>
      </div>
      <div class="input-group">
        <button type="submit" class="btn" name="reg_user">Register</button>
      </div>
      <p class="member">Already a member? <a class="link" href="login.php">Login</a></p>
    </form>
  </div>
</body>

</html>