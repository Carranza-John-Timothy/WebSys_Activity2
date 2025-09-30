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
    if (empty($username) || empty($password)) {
        $error = "All fields are required!";
    } else {
        $result = pg_query_params($conn, "SELECT * FROM users WHERE username = $1", array($username));
        if ($row = pg_fetch_assoc($result)) {
            if (crypt($password, $row['password']) === $row['password']) {
                $_SESSION["username"] = $row["username"];
                header("Location: myresume.php");
                exit();
            } else {
                $error = "Incorrect username or password!";
            }
        } else {
            $error = "User not found!";
        }
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <style>
        body { font-family: Arial, sans-serif; background-color: #f4f6f8; display: flex; justify-content: center; align-items: center; height: 100vh; margin: 0; }
        .container { width: 320px; background: #fff; padding: 25px; border-radius: 8px; box-shadow: 0px 4px 12px rgba(0,0,0,0.1); text-align: center; }
        h2 { margin-bottom: 20px; font-size: 22px; color: #333; }
        input[type="text"], input[type="password"] { width: 100%; padding: 10px 12px; margin: 8px 0; border: 1px solid #ccc; border-radius: 6px; font-size: 14px; box-sizing: border-box; }
        button { width: 100%; padding: 10px; margin-top: 12px; border: none; border-radius: 6px; font-size: 15px; font-weight: bold; cursor: pointer; }
        .login-btn { background-color: #3498db; color: white; }
        .login-btn:hover { background-color: #2980b9; }
        .register-btn { background-color: #2ecc71; color: white; }
        .register-btn:hover { background-color: #27ae60; }
        .error { color: red; font-size: 14px; margin-bottom: 10px; }
    </style>
</head>
<body>
<div class="container">
    <h2>Login</h2>
    <?php if (!empty($error)) echo "<p class='error'>$error</p>"; ?>
    <form method="POST">
        <input type="text" name="username" placeholder="Enter username" required>
        <input type="password" name="password" placeholder="Enter password" required>
        <button type="submit" class="login-btn">Login</button>
    </form>
    <form action="register.php" method="get">
        <button type="submit" class="register-btn">Register</button>
    </form>
</div>
</body>
</html>
