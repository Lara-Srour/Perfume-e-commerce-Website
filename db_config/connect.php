<?php
$db_host = "localhost";
$db_username = "root";
$db_pass = "";
$db_name = "PerfumeProject";

// Establish the database connection
$con = mysqli_connect($db_host, $db_username, $db_pass, $db_name);

// Check the connection
if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

//echo "Connected successfully!";
?>
