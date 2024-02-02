<?php
function createThumbnail($filePath, $thumbnailPath, $time = '00:00:01', $size = '200x200') {
    // Determine whether the file is an image or a video
    $fileType = strtolower(pathinfo($filePath, PATHINFO_EXTENSION));
    if (in_array($fileType, ['jpg', 'jpeg', 'png', 'gif'])) {
        // For images, use ffmpeg to resize (no need for $time)
        $cmd = "ffmpeg -i '$filePath' -vf scale=$size -frames:v 1 '$thumbnailPath' 2>&1";
    } elseif (in_array($fileType, ['mp4', 'mov', 'avi', 'mkv'])) {
        // For videos, capture a frame at the specified time
        $cmd = "ffmpeg -ss $time -i '$filePath' -vf scale=$size -frames:v 1 '$thumbnailPath' 2>&1";
    } else {
        // Unsupported file type
        return false;
    }
    echo($cmd);
    $return_var = shell_exec($cmd);
    if ($return_var === null) {
        echo "Command execution failed or command returned an error.";
    } else {
        echo "Command executed successfully. Output:\n$return_var";
    }
    
    return true; // True if the command executed successfully
}
?>
