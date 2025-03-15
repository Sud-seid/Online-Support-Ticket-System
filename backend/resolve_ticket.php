<?php
session_start();
if ($_SESSION['role'] !== 'agent') {
  die("Access Denied");
}

$conn = new mysqli("localhost", "root", "", "ticket_support");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $ticket_id = $_POST['ticket_id'];
  $sql = "UPDATE tickets SET status='Resolved' WHERE id='$ticket_id'";

  if ($conn->query($sql) === TRUE) {
    echo "Ticket marked as resolved!";
  } else {
    echo "Error: " . $conn->error;
  }
}

$conn->close();
