<?php
session_start();
if ($_SESSION['role'] !== 'admin') {
  die("Access Denied");
}

$conn = new mysqli("localhost", "root", "", "ticket_support");
$sql = "SELECT * FROM tickets";
$result = $conn->query($sql);

echo "<h2>All Tickets</h2>";
while ($row = $result->fetch_assoc()) {
  echo "<p><strong>{$row['title']}</strong> - {$row['status']}</p>";
  echo "<form action='assign_ticket.php' method='POST'>
            <input type='hidden' name='ticket_id' value='{$row['id']}' />
            <select name='agent_id'>";

  $agents = $conn->query("SELECT id, name FROM users WHERE role='agent'");
  while ($agent = $agents->fetch_assoc()) {
    echo "<option value='{$agent['id']}'>{$agent['name']}</option>";
  }

  echo "</select>
          <button type='submit'>Assign</button>
          </form>";
}

$conn->close();
