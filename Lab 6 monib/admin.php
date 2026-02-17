<?php
require "session_guard.php";
?>
<!DOCTYPE html>
<html>
<head>
    <title>Admin</title>
</head>
<body>

<h2>Admin Page</h2>
<p>Welcome, <b><?= htmlspecialchars($_SESSION['username']) ?></b>. You are logged in.</p>

<p>This page is protected. Only logged-in users can access it.</p>

<ul>
    <li><a href="dashboard.php">Go to Dashboard</a></li>
    <li><a href="logout.php">Logout</a></li>
</ul>

</body>
</html>
