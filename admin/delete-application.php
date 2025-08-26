<?php
include './includes/db.php';
include './includes/auth-check.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = intval($_POST['id']);

    // Optional: Delete resume file too
    $result = $conn->query("SELECT resume_path FROM applications WHERE id = $id");
    if ($row = $result->fetch_assoc()) {
        $resume = '../' . $row['resume_path'];
        if (file_exists($resume)) unlink($resume);
    }

    $conn->query("DELETE FROM applications WHERE id = $id");
    echo ($conn->affected_rows > 0) ? 'success' : 'error';
}
?>
