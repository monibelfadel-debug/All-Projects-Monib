<?php
require "db.php";

// 1. Check if user already has a cookie. If yes, send to dashboard.
if (isset($_COOKIE['username'])) {
    header("Location: admin.php");
    exit;
}

$error = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $password = strval($_POST['password']);

    // Check database
    $sql = "SELECT * FROM users WHERE username='$username' AND password='$password'";
    $result = mysqli_query($conn, $sql);

    if ($result && mysqli_num_rows($result) === 1) {
        
        // 2. SUCCESS: Create the Cookie
        // We store the username in a cookie valid for 1 day (86400 seconds)
        setcookie("username", $username, time() + 10, "/");

        // Redirect to dashboard
        header("Location: admin.php");
        exit;
    } else {
        $error = "Invalid login credentials";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
</head>
<body>

<h2>Login</h2>

<?php if ($error): ?>
    <p style="color:red"><?= $error ?></p>
<?php endif; ?>

<form method="POST">
    <input type="text" name="username" placeholder="Username" required><br><br>
    <input type="password" name="password" placeholder="Password" required><br><br>
    <button type="submit">Login</button>
</form>

<p>No account? <a href="signup.php">Sign up</a></p>

</body>

</html>
