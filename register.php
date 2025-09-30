<?php
session_start();
$conn = pg_connect("host=localhost dbname=resume_portfolio user=postgres password=1234");
if (!$conn) {
    die("Connection failed: " . pg_last_error());
}
$error = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST["username"]);
    $password = trim($_POST["password"]);
    $confirm_password = trim($_POST["confirm_password"]);
    if (empty($username) || empty($password) || empty($confirm_password)) {
        $error = "All fields are required!";
    } elseif ($password !== $confirm_password) {
        $error = "Passwords do not match!";
    } else {
        $check = pg_query_params($conn, "SELECT * FROM users WHERE username = $1", array($username));
        if (pg_num_rows($check) > 0) {
            $error = "Username already exists!";
        } else {
            $hashed = crypt($password, base64_encode(random_bytes(16)));
            $insert = pg_query_params($conn, "INSERT INTO users (username, password) VALUES ($1, $2)", array($username, $hashed));
            if ($insert) {
                $_SESSION["username"] = $username;
                header("Location: myresume.php");
                exit();
            } else {
                $error = "Registration failed!";
            }
        }
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
    <style>
        body { font-family: Arial, sans-serif; background-color: #f4f6f8; display: flex; justify-content: center; align-items: center; height: 100vh; margin: 0; }
        .container { width: 320px; background: #fff; padding: 25px; border-radius: 8px; box-shadow: 0px 4px 12px rgba(0,0,0,0.1); text-align: center; }
        h2 { margin-bottom: 20px; font-size: 22px; color: #333; }
        input[type="text"], input[type="password"] { width: 100%; padding: 10px 12px; margin: 8px 0; border: 1px solid #ccc; border-radius: 6px; font-size: 14px; box-sizing: border-box; }
        button { width: 100%; padding: 10px; margin-top: 12px; border: none; background-color: #2ecc71; color: white; font-size: 15px; font-weight: bold; border-radius: 6px; cursor: pointer; }
        button:hover { background-color: #27ae60; }
        .error { color: red; font-size: 14px; margin-bottom: 10px; }
        .link { margin-top: 12px; font-size: 14px; }
    </style>
</head>
<body>
<div class="container">
    <h2>Register</h2>
    <?php if (!empty($error)) echo "<p class='error'>$error</p>"; ?>
    <form method="POST">
        <input type="text" name="username" placeholder="Enter username" required>
        <input type="password" name="password" placeholder="Enter password" required>
        <input type="password" name="confirm_password" placeholder="Confirm password" required>
        <button type="submit">Register</button>
    </form>
    <div class="link">
        <a href="login.php">Already have an account? Login</a>
    </div>
</div>
</body>
</html>
