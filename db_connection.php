<?php
$host = 'localhost';      // or your host name
$db   = 'plant';  // replace with your database name
$user = 'root';  // your DB username
$pass = '';  // your DB password

// Create connection
$conn = new mysqli($host, $user, $pass, $db);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
