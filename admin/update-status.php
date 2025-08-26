<?php
include './includes/db.php';
include './includes/auth-check.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = intval($_POST['id']);
    $status = $_POST['status'];

    $allowed = ['new', 'viewed', 'interviewed', 'onboarding', 'not proceeding'];
    if (!in_array($status, $allowed)) {
        echo 'invalid';
        exit;
    }

    $stmt = $conn->prepare("UPDATE applications SET status = ? WHERE id = ?");
    $stmt->bind_param("si", $status, $id);
    echo $stmt->execute() ? 'success' : 'error';
}
?>
