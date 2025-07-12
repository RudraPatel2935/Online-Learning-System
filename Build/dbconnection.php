<?php
$server = "localhost:3308";
$username = "root";
$password = "";
$database = "proj";

// Attempt to connect to MySQL database
$conn = mysqli_connect($server, $username, $password, $database);

// Check connection
if (!$conn) {
    // If connection fails, display error message
    die("Connection failed: " . mysqli_connect_error());
} 
?>