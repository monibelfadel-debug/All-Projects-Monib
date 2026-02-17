<?php
require "db.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $password = strval($_POST['password']);

    $sql = "INSERT INTO users (username, password)
            VALUES ('$username', '$password')";

    mysqli_query($conn, $sql);

    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Sign Up</title>
</head>
<body>

<h2>Sign Up</h2>

<form method="POST">
    <input type="text" name="username" placeholder="Username" required><br><br>
    <input type="password" name="password" placeholder="Password" required><br><br>
    <button type="submit">Sign Up</button>
</form>

<p>Already have an account? <a href="login.php">Login</a></p>

</body>
</html>
