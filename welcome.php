<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(45deg, #ff0000, #ff7f00, #ffff00, #00ff00, #0000ff, #4b0082, #8b00ff);
            background-size: 400% 400%;
            animation: gradientAnimation 15s ease infinite;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            color: #fff;
        }

        @keyframes gradientAnimation {
            0% {background-position: 0% 50%;}
            50% {background-position: 100% 50%;}
            100% {background-position: 0% 50%;}
        }

        .welcome-container {
            background-color: rgba(255, 255, 255, 0.9);
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
            text-align: center;
            width: 320px;
            color: #333;
        }

        .welcome-container h2 {
            margin-bottom: 20px;
            color: #333;
        }

        .welcome-container p {
            font-size: 18px;
            margin-bottom: 30px;
        }

        input[type=submit] {
            background: linear-gradient(to right, #ff7f00, #ff0000);
            color: white;
            padding: 12px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            width: 100%;
            font-size: 16px;
            transition: background 0.3s, transform 0.3s;
        }

        input[type=submit]:hover {
            background: linear-gradient(to right, #ff0000, #ff7f00);
            transform: scale(1.05);
        }
    </style>
</head>
<body>
    <div class="welcome-container">
        <h2>Welcome Page</h2>
        <p>Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?>!</p>
        <form action="logout.php" method="post">
            <input type="submit" name="submit" value="Logout">
        </form>
    </div>
</body>
</html>
