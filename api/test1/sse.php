<?php
header('Content-Type: text/event-stream');
header('Cache-Control: no-cache');

// Set up an initial SSE message
echo "data: Server Hello\n\n";
ob_flush();
flush();

sleep(1);

$count = 0;

// Keep sending SSE updates until the connection is closed
while($count < 4){
    // Check if the client has closed the connection
    if(connection_aborted()) {
        break;
    }

    // Send a new SSE message
    echo "data: Server: message $count\n\n";
    ob_flush();
    flush();

    // Sleep for some time before sending the next update
    sleep(1);
    $count++;
}


// Close the connection
echo "event: close\n";
echo "data: > The server is closing the connection.\n\n";
ob_flush();
flush();

?>