<?php

$servername = "localhost";
$username = "root";
$password = ""; // Keep empty for XAMPP
$dbname = "orphan"; // Make sure the database name matches

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


?>