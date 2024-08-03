<?php
session_start();
if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['message'])) {
    $message = htmlspecialchars($_POST['message']);
    file_put_contents('chat.txt', $message . "\n", FILE_APPEND);
}

header('Location: dashboard.php');
exit();
