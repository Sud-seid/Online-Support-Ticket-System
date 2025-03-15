<?php
$host = 'localhost';
$username = 'root';    // Change if necessary
$password = 'NewPassword';        // Change if necessary
$dbname = 'support_ticket_system'; // Your DB name

// Create connection
$conn = new mysqli($host, $username, $password, $dbname);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
