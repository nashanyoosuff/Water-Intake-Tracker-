<?php
session_start();
include 'db.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $result = $conn->query("SELECT * FROM users WHERE username='$username'");
    $user = $result->fetch_assoc();
    if ($user && password_verify($_POST['password'], $user['password'])) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['role'] = $user['role'];
        header("Location: dashboard.php");
    } else {
        echo "Invalid login.";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Login - Water Intake Tracker</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<div class="container">
    <h2>Login</h2>
    <form action="login.php" method="POST">
        <input type="text" name="username" placeholder="Username" required><br>
        <input type="password" name="password" placeholder="Password" required><br>
        <button type="submit">Login</button>
    </form>
    <p>No account? <a href="register.php">Register</a></p>
</div>
</body>
</html>