<?php

// Include Composer's autoloader if PHP-FFMpeg is installed via Composer
require_once 'vendor/autoload.php';

use FFMpeg\FFMpeg;
use FFMpeg\Coordinate\TimeCode;

// Check if the form was submitted
if(isset($_POST['submit']) && isset($_FILES['file'])) {
    $targetDir = "uploads/";
    $thumbnailsDir = "thumbnails/";
    $fileName = basename($_FILES['file']['name']);
    $targetFilePath = $targetDir . $fileName;
    $fileType = strtolower(pathinfo($targetFilePath, PATHINFO_EXTENSION));

    // Attempt to move the uploaded file to the target directory
    if(move_uploaded_file($_FILES['file']['tmp_name'], $targetFilePath)) {
        echo "File uploaded successfully.<br>";

        // Initialize PHP-FFMpeg
        $ffmpeg = FFMpeg::create();
        $thumbnailPath = $thumbnailsDir . pathinfo($fileName, PATHINFO_FILENAME) . '.jpg';

        if(in_array($fileType, ['mp4', 'avi', 'mov', 'wmv', 'flv'])) {
            // Handle video file
            $video = $ffmpeg->open($targetFilePath);
            $video->frame(TimeCode::fromSeconds(10))->save($thumbnailPath);
            echo "Thumbnail generated for video at $thumbnailPath.<br>";
            header('Location: index.php');
        } elseif(in_array($fileType, ['png', 'jpg', 'jpeg', 'gif'])) {
            // Handle image file, using FFMpeg to generate a thumbnail
            $ffmpeg->open($targetFilePath)
                   ->frame(TimeCode::fromSeconds(0))
                   ->save($thumbnailPath);
            echo "Thumbnail generated for image at $thumbnailPath.<br>";
            header('Location: index.php');
        } else {
            echo "Unsupported file type.<br>";
        }
    } else {
        echo "There was an error uploading your file.<br>";
    }
}
?>


<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="container">
    <a href="index.php" class="button"><button>Back to Home</button></a>
    <form action="upload.php" method="post" enctype="multipart/form-data">
        <h2>Select file to upload:</h2>
        <input type="file" name="file" id="file">
        <input type="submit" value="Upload File" name="submit">
    </form>
</div>

</body>
</html>