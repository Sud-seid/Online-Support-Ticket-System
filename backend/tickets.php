<?php
session_start();
require 'config.php';

// Submit a Ticket
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit_ticket'])) {
  $user_id = $_SESSION['user_id'];
  $subject = $_POST['subject'];
  $description = $_POST['description'];
  $priority = $_POST['priority'];

  $stmt = $db->prepare("INSERT INTO tickets (user_id, subject, description, priority) VALUES (:user_id, :subject, :description, :priority)");
  $stmt->execute([
    'user_id' => $user_id,
    'subject' => $subject,
    'description' => $description,
    'priority' => $priority
  ]);

  echo json_encode(["message" => "Ticket submitted successfully!"]);
}

// Get All Tickets (For Agents/Admins)
if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['get_tickets'])) {
  $stmt = $db->query("SELECT * FROM tickets");
  $tickets = $stmt->fetchAll(PDO::FETCH_ASSOC);
  echo json_encode($tickets);
}

// Update Ticket Status
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update_ticket'])) {
  $ticket_id = $_POST['ticket_id'];
  $status = $_POST['status'];

  $stmt = $db->prepare("UPDATE tickets SET status = :status WHERE ticket_id = :ticket_id");
  $stmt->execute([
    'status' => $status,
    'ticket_id' => $ticket_id
  ]);

  echo json_encode(["message" => "Ticket status updated!"]);
}
