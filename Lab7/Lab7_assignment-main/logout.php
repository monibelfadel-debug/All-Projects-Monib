<?php
// To delete a cookie, we set its expiration date to the past.
setcookie("username", "", time() - 1, "/");

// Redirect back to login
header("Location: login.php");
exit;
?>