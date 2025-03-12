<?php
require 'config.php';


if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['escalate_tickets'])) {
  $stmt = $db->prepare("SELECT * FROM tickets WHERE status = 'open' AND created_at < NOW() - INTERVAL 24 HOUR");
  $stmt->execute();
  $tickets = $stmt->fetchAll(PDO::FETCH_ASSOC);

  foreach ($tickets as $ticket) {
    $stmt = $db->prepare("INSERT INTO escalations (ticket_id, escalation_reason, escalated_by) VALUES (:ticket_id, :reason, :escalated_by)");
    $stmt->execute([
      'ticket_id' => $ticket['ticket_id'],
      'reason' => 'Unresolved for 24 hours',
      'escalated_by' => 'system'
    ]);


    $stmt = $db->prepare("UPDATE tickets SET status = 'escalated' WHERE ticket_id = :ticket_id");
    $stmt->execute(['ticket_id' => $ticket['ticket_id']]);
  }

  echo json_encode(["message" => "Tickets escalated successfully!"]);
}
