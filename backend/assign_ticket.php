<?php
session_start();
if ($_SESSION['role'] !== 'admin') {
  die("Access Denied");
}

$conn = new mysqli("localhost", "root", "", "ticket_support");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $ticket_id = $_POST['ticket_id'];
  $agent_id = $_POST['agent_id'];

  $sql = "UPDATE tickets SET assigned_to='$agent_id', status='In Progress' WHERE id='$ticket_id'";

  if ($conn->query($sql) === TRUE) {
    echo "Ticket assigned successfully!";
  } else {
    echo "Error: " . $conn->error;
  }
}

$conn->close();
