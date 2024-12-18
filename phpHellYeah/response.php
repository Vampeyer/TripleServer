<?php
// server.php

// Set the path to the HTML file
$file = __DIR__ . '/hellyeah.html';

// Check if the file exists
if (file_exists($file)) {
    // Set the content type header to text/html
    header('Content-Type: text/html');
    
    // Read the file and output its contents
    readfile($file);
} else {
    // If the file doesn't exist, return a 404 Not Found error
    http_response_code(404);
    echo "404 Not Found: The requested file does not exist.";
}
?>