<?php

// Define the port (you can change this)
$port = 8000;

// Function to handle requests (you can expand this for routing)
function handleRequest() {
    $uri = $_SERVER['REQUEST_URI'];
    switch ($uri) {
        case '/':
            include 'index.html';
            break;
        // Add more routes as needed...
        default:
            http_response_code(404);
            echo "Page not found";
            break;
    }
}


// Create a server socket
$socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
if ($socket === false) {
    echo "socket_create() failed: reason: " . socket_strerror(socket_last_error()) . "\n";
    exit;
}

// Reuse the address to avoid "Address already in use" errors
if (!socket_set_option($socket, SOL_SOCKET, SO_REUSEADDR, 1)) {
    echo "socket_set_option() failed: reason: " . socket_strerror(socket_last_error($socket)) . "\n";
    exit;
}



// Bind the socket to the specified port
if (!socket_bind($socket, 'localhost', $port)) { // Use 0.0.0.0 for all interfaces
    echo "socket_bind() failed: reason: " . socket_strerror(socket_last_error($socket)) . "\n";
    exit;
}

// Listen for incoming connections
if (!socket_listen($socket, 5)) { // 5 is the backlog size
    echo "socket_listen() failed: reason: " . socket_strerror(socket_last_error($socket)) . "\n";
    exit;
}

// Log the server port (IMPORTANT: Do this AFTER successfully binding)
echo "PHP server started on http://localhost:" . $port . PHP_EOL;



// Main server loop
while (true) {
    // Accept incoming connections
    $client = socket_accept($socket);
    if ($client === false) {
        echo "socket_accept() failed: reason: " . socket_strerror(socket_last_error($socket)) . "\n";
        continue; // Continue to the next iteration of the loop
    }


    // Handle the request (this is where you process the client's request)
    handleRequest();




    // Close the client socket
    socket_close($client);
}




// Close the server socket (this will only be reached if the loop is broken)
socket_close($socket);



?>