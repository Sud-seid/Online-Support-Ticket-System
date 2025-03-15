<?php
session_start();
$conn = new mysqli("localhost", "root", "", "ticket_support");

$user_id = $_SESSION['user_id'];
$sql = "SELECT * FROM tickets WHERE user_id = '$user_id'";
$result = $conn->query($sql);

echo "<h2>Your Tickets</h2>";
while ($row = $result->fetch_assoc()) {
  echo "<p><strong>{$row['title']}</strong> - {$row['status']}</p>";
}

$conn->close();
