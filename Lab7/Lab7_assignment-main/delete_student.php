<?php
// Security check
if (!isset($_COOKIE['username'])) {
    header("Location: login.php");
    exit;
}

require "db_connection.php";

// Check if student_number exists
if (isset($_GET['student_number'])) {

    $student_number = $_GET['student_number'];

    // Delete query
    $sql = "DELETE FROM students WHERE student_number = '$student_number'";

    if (mysqli_query($connection, $sql)) {
        // Redirect back to dashboard after delete
        header("Location: admin.php");
        exit;
    } else {
        echo "Error deleting student: " . mysqli_error($connection);
    }
} else {
    header("Location: admin.php");
    exit;
}

mysqli_close($connection);
?>