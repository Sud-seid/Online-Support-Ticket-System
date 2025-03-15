<?php
session_start();
if ($_SESSION['role'] !== 'agent') {
  die("Access Denied");
}

$conn = new mysqli("localhost", "root", "", "ticket_support");

$agent_id = $_SESSION['user_id'];
$sql = "SELECT * FROM tickets WHERE assigned_to = '$agent_id'";
$result = $conn->query($sql);

echo "<h2>Assigned Tickets</h2>";
while ($row = $result->fetch_assoc()) {
  echo "<p><strong>{$row['title']}</strong> - {$row['status']}</p>";
  echo "<form action='resolve_ticket.php' method='POST'>
            <input type='hidden' name='ticket_id' value='{$row['id']}' />
            <button type='submit'>Mark as Resolved</button>
          </form>";
}

$conn->close();
