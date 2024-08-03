<?php
session_start();
if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit();
}

$username = $_SESSION['username'];
$upload_dir = ($username == 'mudatt') ? 'uploads/muds_files' : 'uploads/atts_files';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $file = $_FILES['file'];
    $target_file = $upload_dir . '/' . basename($file['name']);

    if (move_uploaded_file($file['tmp_name'], $target_file)) {
        header('Location: dashboard.php');
        exit();
    } else {
        echo 'Error uploading file.';
    }
}
