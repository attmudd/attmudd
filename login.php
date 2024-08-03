<?php
session_start();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Hardcoded username and password check
    if (($username == 'mudatt' && $password == '26112002ma') || ($username == 'attmudd' && $password == '26112002ma')) {
        $_SESSION['username'] = $username;
        header('Location: dashboard.php');
        exit();
    } else {
        $error = 'Invalid username or password';
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Please Login Madam/Sir</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <h2>Please Login Madam/Sir</h2>
        <?php if (isset($error)) { echo '<p style="color:red;">' . htmlspecialchars($error) . '</p>'; } ?>
        <form action="login.php" method="post">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required>
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>
            <input type="submit" value="Login">
        </form>
    </div>
    <footer>
        <p>Developed and designed by - Mohammed_Mudassir</p>
    </footer>
</body>
</html>
