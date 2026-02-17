<?php
session_start();

$SESSION_TIMEOUT = 10; // 10 seconds
// Not logged in
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}

// Session expired
if (isset($_SESSION['last_activity']) &&
    (time() - $_SESSION['last_activity']) > $SESSION_TIMEOUT) {

    session_unset();
    session_destroy();

    header("Location: login.php?timeout=1");
    exit;
}

// Update activity time
$_SESSION['last_activity'] = time();
