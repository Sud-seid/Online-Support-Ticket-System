<?php
$host = 'localhost'; // XAMPP default
$dbname = 'support_ticket_system'; // Your database name
$username = 'root'; // XAMPP default username
$password = ''; // XAMPP default password (empty)

try {
  $db = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
  $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
  die("Database connection failed: " . $e->getMessage());
}
