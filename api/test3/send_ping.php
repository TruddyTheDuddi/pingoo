<?php
session_start();
include "../db_connect.php";

// Check if last ping timestamp stored in session is older than 3 second
if (isset($_SESSION['last_ping']) && $_SESSION['last_ping'] > time() - 3) {
    // If it is, don't do anything
    echo "Script 2 > You can ping again in " . ($_SESSION['last_ping'] - time() + 3) . " seconds.";
    exit;
}

// Add a new ping in the db
$sql = "INSERT INTO `pings` (`id`) VALUES (NULL)";
mysqli_query($db, $sql);

// Update last ping timestamp in session
$_SESSION['last_ping'] = time();

echo "Script 2 > Pinged!" . (rand(0, 20) == 10 ? " (Lol you do be pinging)" : "");

?>