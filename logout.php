<?php include('server.php') ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logout</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<style>
    body {
    font-family: Arial, sans-serif;
    background-color: #f9f9f9;
    margin: 0;
    padding: 0;
}

.container {
    text-align: center;
    margin-top: 100px;
}

h1 {
    font-size: 36px;
    color: #333;
}

.logout_btn {
    padding: 10px 20px;
    font-size: 18px;
    background-color: #007bff;
    color: #fff;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

.logout_btn:hover {
    background-color: #0056b3;
}

</style>
<body>
    <div class="container">
        <h1>Thank you for visiting.</h1>
        <h1>have Great day and bharatdarsha will welcome you again and again.</h1>
        <button class="logout_btn">Logout</button>
        
    </div>
    <script>
    const logoutBtn = document.querySelector(".logout_btn")
    logoutBtn.addEventListener("click", () => {
        window.location.replace("index.php"); // Redirect to login page upon logout
  
    });
    </script>
</body>
</html>
</html>