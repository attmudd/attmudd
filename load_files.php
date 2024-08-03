<?php
header('Content-Type: application/json');

// Replace with actual logic to fetch files for the user
$user = $_GET['user'];
$files = ['File 1', 'File 2', 'File 3']; // Mock data

echo json_encode($files);
?>
