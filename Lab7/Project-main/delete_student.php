<?php
declare(strict_types=1);
require_once __DIR__ . "/auth.php";

require_login();

$csrf = (string)($_GET["csrf"] ?? "");
if (!hash_equals($_SESSION["csrf"], $csrf)) {
    die("Invalid CSRF token.");
}

$student_number = trim((string)($_GET["student_number"] ?? ""));
if ($student_number === "") {
    redirect("admin.php");
}

$stmt = $connection->prepare("DELETE FROM students WHERE student_number = ?");
$stmt->bind_param("s", $student_number);
$stmt->execute();

redirect("admin.php");
