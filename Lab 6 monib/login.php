<?php
session_start();
require "db.php";

$error = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $password = strval($_POST['password']);

    $sql = "SELECT * FROM users
            WHERE username='$username' AND password='$password'";

    $result = mysqli_query($conn, $sql);

    if ($result && mysqli_num_rows($result) === 1) {
        $_SESSION['username'] = $username;
        $_SESSION['last_activity'] = time();

        header("Location: dashboard.php");
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

<?php if (isset($_GET['timeout'])): ?>
    <p style="color:red">Session expired. Please log in again.</p>
<?php endif; ?>

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
