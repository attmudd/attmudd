<?php
session_start();
if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit();
}
$username = $_SESSION['username'];
$user_upload_dir = ($username == 'mudatt') ? 'uploads/muds_files' : 'uploads/atts_files';
$other_upload_dir = ($username == 'mudatt') ? 'uploads/atts_files' : 'uploads/muds_files';
$user_display_name = ($username == 'mudatt') ? "Mud's Files" : "Att's Files";
$other_display_name = ($username == 'mudatt') ? "Att's Files" : "Mud's Files";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <h2><?php echo htmlspecialchars($username == 'mudatt' ? 'Welcome, Mud!' : 'Welcome, Dr. ATTU!'); ?></h2>
        <h3 style="text-align: center;">السلام عليكم ورحمة الله وبركاته</h3>
        
        <!-- File upload form -->
        <form action="upload.php" method="post" enctype="multipart/form-data">
            <label for="file">Upload File:</label>
            <input type="file" id="file" name="file" required>
            <input type="submit" value="Upload">
        </form>

        <!-- Display uploaded files -->
        <div class="files-container">
            <!-- Display other user's files first -->
            <div class="user-files">
                <h3><?php echo htmlspecialchars($other_display_name); ?></h3>
                <?php
                $other_files = scandir($other_upload_dir);
                foreach ($other_files as $file) {
                    if ($file !== '.' && $file !== '..') {
                        $file_path = $other_upload_dir . '/' . $file;
                        echo '<div class="file-item">';
                        echo '<p>' . htmlspecialchars($file) . '</p>';
                        if (preg_match('/\.(mp4|webm|m4v)$/', $file)) {
                            echo '<video class="video" controls>
                                    <source src="' . htmlspecialchars($file_path) . '" type="video/mp4">
                                    Your browser does not support the video tag.
                                  </video>';
                        } elseif (preg_match('/\.(mp3|wav|m4a)$/', $file)) {
                            echo '<audio class="audio" controls>
                                    <source src="' . htmlspecialchars($file_path) . '" type="audio/mpeg">
                                    Your browser does not support the audio tag.
                                  </audio>';
                        } elseif (preg_match('/\.(jpg|jpeg|png|gif)$/', $file)) {
                            echo '<img src="' . htmlspecialchars($file_path) . '" alt="' . htmlspecialchars($file) . '" style="max-width: 100%; height: auto;">';
                        }
                        echo '<form action="download.php" method="post">';
                        echo '<input type="hidden" name="file" value="' . htmlspecialchars($file_path) . '">';
                        echo '<input type="submit" value="Download" class="download-btn">';
                        echo '</form>';
                        echo '</div>';
                    }
                }
                ?>
            </div>
            
            <!-- Display logged-in user's files next -->
            <div class="user-files">
                <h3><?php echo htmlspecialchars($user_display_name); ?></h3>
                <?php
                $user_files = scandir($user_upload_dir);
                foreach ($user_files as $file) {
                    if ($file !== '.' && $file !== '..') {
                        $file_path = $user_upload_dir . '/' . $file;
                        echo '<div class="file-item">';
                        echo '<p>' . htmlspecialchars($file) . '</p>';
                        if (preg_match('/\.(mp4|webm|m4v)$/', $file)) {
                            echo '<video class="video" controls>
                                    <source src="' . htmlspecialchars($file_path) . '" type="video/mp4">
                                    Your browser does not support the video tag.
                                  </video>';
                        } elseif (preg_match('/\.(mp3|wav|m4a)$/', $file)) {
                            echo '<audio class="audio" controls>
                                    <source src="' . htmlspecialchars($file_path) . '" type="audio/mpeg">
                                    Your browser does not support the audio tag.
                                  </audio>';
                        } elseif (preg_match('/\.(jpg|jpeg|png|gif)$/', $file)) {
                            echo '<img src="' . htmlspecialchars($file_path) . '" alt="' . htmlspecialchars($file) . '" style="max-width: 100%; height: auto;">';
                        }
                        echo '<form action="download.php" method="post">';
                        echo '<input type="hidden" name="file" value="' . htmlspecialchars($file_path) . '">';
                        echo '<input type="submit" value="Download" class="download-btn">';
                        echo '</form>';
                        echo '</div>';
                    }
                }
                ?>
            </div>
        </div>

        <!-- Chat box -->
        <div class="chat-container">
            <h3>Guft'gu</h3>
            <div class="chat-box">
                <?php
                if (file_exists('chat.txt')) {
                    echo nl2br(htmlspecialchars(file_get_contents('chat.txt')));
                }
                ?>
            </div>
            <form action="chat.php" method="post">
                <input type="text" name="message" required>
                <input type="submit" value="Send">
            </form>
        </div>

        <!-- Logout form -->
        <form action="logout.php" method="post">
            <input type="submit" value="Logout">
        </form>
    </div>
    <footer>
        <p>Developed and designed by - Mohammed_Mudassir</p>
    </footer>
</body>
</html>
