<?php
// config.php - DB connection (MySQLi) + common settings
declare(strict_types=1);

$DB_HOST = "localhost";
$DB_USER = "root";
$DB_PASS = "";
$DB_NAME = "university";

$connection = new mysqli($DB_HOST, $DB_USER, $DB_PASS, $DB_NAME);
if ($connection->connect_error) {
    die("Connection Error: " . $connection->connect_error);
}
$connection->set_charset("utf8mb4");
?>