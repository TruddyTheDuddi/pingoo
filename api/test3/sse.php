<?php
include_once "../db_connect.php";
header('Content-Type: text/event-stream');
header('Cache-Control: no-cache');

// Set up an initial SSE message
echo "data: Server Hello\n\n";
ob_flush();
flush();

// Get the last ping
$sql = "SELECT count(*) AS c FROM `pings`";
$result = mysqli_query($db, $sql);
$old_ping = mysqli_fetch_assoc($result)['c'];

echo "data: Script 1 > Initial ping count: $old_ping\n\n";
ob_flush();
flush();

$count = 0;

// Keep sending SSE updates for 1 minute
while($count < 60 * 5){
    // Check if the client has closed the connection
    if(connection_aborted()) {
        break;
    }

    // Check if the databse has changed
    $sql = "SELECT count(*) AS c FROM `pings`";
    $result = mysqli_query($db, $sql);
    $ping = mysqli_fetch_assoc($result)['c'];

    if($ping != $old_ping) {
        echo "data: Script 1 > NEW PINGS! Count: $ping\n\n";
        ob_flush();
        flush();
        $old_ping = $ping;
    }

    // Sleep for 0.2 seconds
    usleep(200000);
    $count++;
}


// Close the connection
echo "data: Script 1 > Sorry I died after 1 minute.\n\n";
ob_flush();
flush();

?>