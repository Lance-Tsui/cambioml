<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document Upload</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>Upload Your PDF or Image</h1>
        <p>Please select a PDF or image file to upload.</p>
        <form action="upload.php" method="post" enctype="multipart/form-data" class="upload-form">
            <label for="fileToUpload" class="file-label">
                Choose File
                <input type="file" name="fileToUpload" id="fileToUpload" required>
                <span id="fileName" class="file-name"></span>
            </label>
            <button type="submit" name="submit" class="submit-button">Upload File</button>
        </form>
    </div>
    <div class="session-info">
        <?php
        session_start();
        $hasSessionData = false;
        if (isset($_SESSION['message'])) {
            echo "<p class='session-message'>" . $_SESSION['message'] . "</p>";
            $hasSessionData = true;
        }
        if (isset($_SESSION['uploads'])) {
            echo "<p class='upload-history'>Upload History: <br>" . implode(", ", $_SESSION['uploads']) . "</p>";
            $hasSessionData = true;
        }
        if (isset($_SESSION['extraction'])) {
            echo "<p class='latest-extraction'>Latest Extraction: " . $_SESSION['extraction'] . "</p>";
            $hasSessionData = true;
        }
        if (!$hasSessionData) {
            echo "<p class='no-records'>No upload records yet.</p>"; // Default message
        }
        ?>
    </div>
    <script src="app.js"></script>
</body>
</html>
