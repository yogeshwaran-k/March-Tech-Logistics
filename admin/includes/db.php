<?php
require_once __DIR__ . "/../../../db_config.php";

$conn = new mysqli(
    $DB_CONFIG["host"],
    $DB_CONFIG["user"],
    $DB_CONFIG["pass"],
    $DB_CONFIG["dbname"]
);

if ($conn->connect_error) {
    die("Database connection failed: " . $conn->connect_error);
}
?>
