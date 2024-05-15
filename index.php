<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Index</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background: linear-gradient(to right, #ff7e5f, #feb47b);
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            color: #ffffff;
        }
        .index-container {
            background-color: #ffffff;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
            text-align: center;
            width: 320px;
            color: #333333;
        }
        .index-container h2 {
            margin-bottom: 25px;
            color: #ff7e5f; 
        }
        .index-container a {
            display: block;
            margin: 12px 0;
            padding: 12px;
            background-color: #ff7e5f; 
            color: #ffffff;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s, transform 0.3s;
        }
        .index-container a:hover {
            background-color: #feb47b; 
            transform: scale(1.05);
        }
    </style>
</head>
<body>
    <div class="index-container">
        <h2>Welcome to Web Technology</h2>
        <?php if (isset($_SESSION['username'])): ?>
            <a href="welcome.php">Welcome Page</a>
            <a href="logout.php">Logout</a>
        <?php else: ?>
            <a href="registration.php">Register</a>
            <a href="login.php">Login</a>
        <?php endif; ?>
    </div>
</body>
</html>
