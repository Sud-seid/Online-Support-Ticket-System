<?php
session_start();
if (!isset($_SESSION['user_id'])) {
  die("You must be logged in to create a ticket.");
}

$conn = new mysqli("localhost", "root", "", "ticket_support");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $user_id = $_SESSION['user_id'];
  $title = $_POST['title'];
  $description = $_POST['description'];
  $category = $_POST['category'];
  $priority = $_POST['priority'];

  // Prepared statement to prevent SQL injection
  $sql = "INSERT INTO tickets (user_id, title, description, category, priority) 
            VALUES (?, ?, ?, ?, ?)";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("issss", $user_id, $title, $description, $category, $priority);

  if ($stmt->execute()) {
    echo "Ticket created successfully!";
  } else {
    echo "Error: " . $stmt->error;
  }

  $stmt->close();
}

$conn->close();
