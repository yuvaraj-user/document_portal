<?php
// Define the base path where the images are located
$basePath = 'C:/AppServ/www/kanagaraj/DEV/QCFIELD/Images/';

// Check if the 'image' query parameter is set
if (isset($_GET['image'])) {
    $url_arr = explode('/',$_GET['image']);
    $image = end($url_arr);

    $imageName = basename($image); // Get the image name from the query parameter (sanitize the input)
    $filePath = $basePath . $imageName; // Create the full file path

    // Check if the file exists
    if (file_exists($filePath)) {
        // Get the file's mime type (for setting the proper Content-Type header)
        $mimeType = mime_content_type($filePath);
        header('Content-Type: ' . $mimeType); // Set the correct Content-Type header

        // Output the image content
        readfile($filePath);
    } else {
        echo "Image not found.";
    }
} else {
    echo "No image specified.";
}
