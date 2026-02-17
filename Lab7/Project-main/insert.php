<?php
declare(strict_types=1);
require_once __DIR__ . "/auth.php";

require_login();

if (!hash_equals($_SESSION["csrf"], (string)($_POST["csrf"] ?? ""))) {
    die("Invalid CSRF token.");
}

$student_number = trim((string)($_POST["student_number"] ?? ""));
$full_name      = trim((string)($_POST["full_name"] ?? ""));
$email          = trim((string)($_POST["email"] ?? ""));
$department     = trim((string)($_POST["department"] ?? ""));
$date_of_birth  = (string)($_POST["date_of_birth"] ?? "");
$phone_number   = trim((string)($_POST["phone_number"] ?? ""));

$stmt = $connection->prepare(
    "INSERT INTO students (student_number, full_name, email, department, date_of_birth, phone_number)
     VALUES (?, ?, ?, ?, NULLIF(?, ''), NULLIF(?, ''))"
);
$stmt->bind_param("ssssss", $student_number, $full_name, $email, $department, $date_of_birth, $phone_number);

if ($stmt->execute()) {
    redirect("admin.php");
} else {
    echo "Error: " . htmlspecialchars($connection->error);
}
