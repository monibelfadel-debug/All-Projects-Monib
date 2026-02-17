<?php
require "session_guard.php";
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
</head>
<body>

<h2>Welcome, <?= htmlspecialchars($_SESSION['username']) ?></h2>

<p>This page is protected.</p>
<p>You will be logged out after inactivity.</p>

<p><a href="admin.php">Go to Admin Page</a></p>

<a href="logout.php">Logout</a>

</body>
</html>

