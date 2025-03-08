<?php
session_start();
require 'config.php';

// Set JSON header
header('Content-Type: application/json');

// Submit a Ticket
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit_ticket'])) {
  // Check if user is logged in
  if (!isset($_SESSION['user_id'])) {
    echo json_encode(["error" => "User not logged in"]);
    exit();
  }

  // Validate input
  $user_id = $_SESSION['user_id'];
  $subject = $_POST['subject'];
  $description = $_POST['description'];
  $priority = $_POST['priority'];

  if (empty($subject) || empty($description) || empty($priority)) {
    echo json_encode(["error" => "All fields are required"]);
    exit();
  }

  // Insert ticket into database
  try {
    $stmt = $db->prepare("INSERT INTO tickets (user_id, subject, description, priority) VALUES (:user_id, :subject, :description, :priority)");
    $stmt->execute([
      'user_id' => $user_id,
      'subject' => $subject,
      'description' => $description,
      'priority' => $priority
    ]);
    echo json_encode(["message" => "Ticket submitted successfully!"]);
  } catch (PDOException $e) {
    echo json_encode(["error" => "Database error: " . $e->getMessage()]);
  }
}

// Get All Tickets (For Agents/Admins)
if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['get_tickets'])) {
  try {
    $stmt = $db->query("SELECT * FROM tickets");
    $tickets = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($tickets);
  } catch (PDOException $e) {
    echo json_encode(["error" => "Database error: " . $e->getMessage()]);
  }
}

// Update Ticket Status
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update_ticket'])) {
  // Validate input
  $ticket_id = $_POST['ticket_id'];
  $status = $_POST['status'];

  if (empty($ticket_id) || empty($status)) {
    echo json_encode(["error" => "Ticket ID and status are required"]);
    exit();
  }

  // Update ticket status
  try {
    $stmt = $db->prepare("UPDATE tickets SET status = :status WHERE ticket_id = :ticket_id");
    $stmt->execute([
      'status' => $status,
      'ticket_id' => $ticket_id
    ]);
    echo json_encode(["message" => "Ticket status updated!"]);
  } catch (PDOException $e) {
    echo json_encode(["error" => "Database error: " . $e->getMessage()]);
  }
}
