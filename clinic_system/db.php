<?php
$servername = "localhost";
$username = "root"; // Default for XAMPP
$password = "";     // Default is empty
$dbname = "clinic_system_db"; // Your database name
$port = 3307;

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname, $port);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
