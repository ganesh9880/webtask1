<?php
session_start();


$servername = "localhost";
$username = "root";
$password = "";
$dbname = "register";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$message = "";
$registration_successful = false;

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['register'])) {
    $user = $_POST['username'];
    $email = $_POST['email'];
    $pass = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $sql = "SELECT * FROM users WHERE username='$user' OR email='$email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $message = "Username or email already exists!";
    } else {
        $sql = "INSERT INTO users (username, email, password) VALUES ('$user', '$email', '$pass')";
        if ($conn->query($sql) === TRUE) {
            $message = "Registration successful!";
            $registration_successful = true;
        } else {
            $message = "Error: " . $sql . "<br>" . $conn->error;
        }
    }
}


if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['login'])) {
    $user = $_POST['username'];
    $pass = $_POST['password'];

    $sql = "SELECT * FROM users WHERE username='$user'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if (password_verify($pass, $row['password'])) {
            $_SESSION['username'] = $user;
            header("Location: welcome.php");
            exit();
        } else {
            $message = "Invalid password!";
        }
    } else {
        $message = "No user found with that username!";
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
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
        .form-container {
            background-color: #ffffff;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
            width: 320px;
            color: #333333;
        }
        .form-container h2 {
            margin-bottom: 25px;
            color: #333333;
        }
        .form-container h3 {
            margin-bottom: 25px;
            color: #4CAF50;
        }
        .form-container input[type=text], .form-container input[type=email], .form-container input[type=password] {
            width: 100%;
            padding: 12px;
            margin: 8px 0;
            display: inline-block;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }
        .form-container input[type=submit] {
            width: 100%;
            background-color: #ff7e5f;
            color: white;
            padding: 12px;
            margin: 10px 0;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s, transform 0.3s;
        }
        .form-container input[type=submit]:hover {
            background-color: #e56b4d;
            transform: scale(1.05);
        }
        .form-container .message {
            text-align: center;
            color: red;
        }
    </style>
</head>
<body>
    <div class="form-container">
        <h2>Registration Form</h2>
        <?php if ($message): ?>
            <p class="message"><?php echo $message; ?></p>
        <?php endif; ?>
        <?php if ($registration_successful): ?>
            <h3>Registration successful! Please login below.</h3>
            <form action="registration.php" method="post">
                <label for="username">Username:</label><br>
                <input type="text" id="username" name="username" required><br>
                <label for="password">Password:</label><br>
                <input type="password" id="password" name="password" required><br><br>
                <input type="submit" name="login" value="Login">
            </form>
        <?php else: ?>
            <form action="registration.php" method="post">
                <label for="username">Username:</label><br>
                <input type="text" id="username" name="username" required><br>
                <label for="email">Email:</label><br>
                <input type="email" id="email" name="email" required><br>
                <label for="password">Password:</label><br>
                <input type="password" id="password" name="password" required><br><br>
                <input type="submit" name="register" value="Register">
            </form>
        <?php endif; ?>
    </div>
</body>
</html>
