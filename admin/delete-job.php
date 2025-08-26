<?php
include './includes/db.php';
include './includes/auth-check.php';

$id = intval($_GET["id"]);
$conn->query("DELETE FROM job_openings WHERE id = $id");
header("Location: manage-jobs.php");
exit();
