<?php
$files = scandir('uploads');
?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="container">
    <a href="upload.php" class="button"><button>Upload File</button></a>
    <h2>Uploaded Files</h2>
    <div class="file-container">
        <?php
        $files = scandir('uploads');
        foreach ($files as $file) {
            if ($file === '.' || $file === '..') continue;
            $filePath = 'uploads/' . $file;
            // Assuming the use of placeholders or generated thumbnails for display
            $thumbnailPath = 'thumbnails/' . $file; // Placeholder, adjust accordingly
			$dir = pathinfo($thumbnailPath, PATHINFO_DIRNAME);
			$filename = pathinfo($thumbnailPath, PATHINFO_FILENAME);

			// Reconstruct the path with a .jpg extension
			$thumbnailPathJpg = $dir . '/' . $filename . '.jpg';
            echo "<div class='card'>";
            echo "<img src='$thumbnailPathJpg' alt='$file' />"; // Use actual image/video thumbnails if available
            echo "<h3>" . htmlspecialchars($file) . "</h3>";
            echo "<a href='stream.php?file=$file'><button>View</button></a>";
            echo "</div>";
        }
        ?>
    </div>
</div>

</body>
</html>