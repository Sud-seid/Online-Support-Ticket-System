const apiUrl = "backend/";

// Create Ticket function
async function createTicket(data) {
  const response = await fetch(`${apiUrl}create_ticket.php`, {
    method: "POST",
    body: data,
  });
  return response.json();
}

// Check Ticket Status function
async function checkTicketStatus(ticketID) {
  const response = await fetch(
    `${apiUrl}check_ticket.php?ticketID=${ticketID}`
  );
  return response.json();
}
