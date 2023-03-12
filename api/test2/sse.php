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
while($count < 10){
    // Check if the client has closed the connection
    if(connection_aborted()) {
        break;
    }

    // Send a new SSE message
    echo "data: Server 1 > I'm alive!\n\n";
    ob_flush();
    flush();

    // Sleep for some time before sending the next update
    sleep(1);
    $count++;
}


// Close the connection
echo "data: Server 1 > I died.\n\n";
ob_flush();
flush();

?>