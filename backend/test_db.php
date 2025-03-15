<?php
// test_db.php - Test database connection

$servername = "localhost";
$username = "root";
$password = "NewPassword";
$dbname = "ticket_support";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
} else {
  echo "Connected successfully to the database!";
}

$conn->close();
