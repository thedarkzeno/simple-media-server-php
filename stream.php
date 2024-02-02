<?php
$fileName = $_GET['file'];
$filePath = 'uploads/' . $fileName;

// Simple file type check
$fileExtension = pathinfo($filePath, PATHINFO_EXTENSION);

?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="container">
    <a href="index.php" class="button"><button>Back to Home</button></a><br />
    <?php
        if(in_array($fileExtension, ['jpg', 'jpeg', 'png', 'gif'])) {
            // Display image
            echo "<img src='$filePath' />";
        } elseif(in_array($fileExtension, ['mp4', 'mov', 'avi'])) {
            // Display video
            echo "<video controls style='max-width:100%;'><source src='$filePath' type='video/$fileExtension'>Your browser does not support the video tag.</video>";
        } else {
            echo "File format not supported.";
        }// Your existing PHP code here for displaying images or videos
    ?>
    
</div>

</body>
</html>
