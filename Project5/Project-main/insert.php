<?php
require "db_connection.php";

// Get form data
$student_number = $_POST["student_number"];
$full_name      = $_POST["full_name"];
$email          = $_POST["email"];
$department     = $_POST["department"];
$date_of_birth  = $_POST["date_of_birth"];
$phone_number   = $_POST["phone_number"];

// Insert query
$sql = "INSERT INTO students 
        (student_number, full_name, email, department, date_of_birth, phone_number) 
        VALUES 
        ('$student_number', '$full_name', '$email', '$department', '$date_of_birth', '$phone_number')";

// Execute query
if (mysqli_query($connection, $sql)) {
    echo "Student added successfully.";
} else {
    echo "Error: " . mysqli_error($connection);
}

// Close connection
mysqli_close($connection);
?>
