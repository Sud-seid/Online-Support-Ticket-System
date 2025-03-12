document.addEventListener("DOMContentLoaded", () => {
  const ticketForm = document.getElementById("ticketForm");
  const ticketsTable = document.getElementById("ticketsTable");

  if (ticketForm) {
    ticketForm.addEventListener("submit", async (e) => {
      e.preventDefault();
      const subject = document.getElementById("subject").value;
      const description = document.getElementById("description").value;
      const priority = document.getElementById("priority").value;

      const user = JSON.parse(localStorage.getItem("user"));
      if (!user) {
        window.location.href = "login.html";
        return;
      }

      const response = await fetch("http://localhost/backend/tickets.php", {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify({
          user_id: user.user_id,
          subject,
          description,
          priority,
          submit_ticket: true,
        }),
      });

      const data = await response.json();
      document.getElementById("ticketMessage").textContent = data.message;
    });
  }

  if (ticketsTable) {
    const user = JSON.parse(localStorage.getItem("user"));
    if (!user) {
      window.location.href = "login.html";
      return;
    }

    fetch("http://localhost/backend/tickets.php?get_tickets=true")
      .then((response) => response.json())
      .then((tickets) => {
        const tbody = ticketsTable.querySelector("tbody");
        tbody.innerHTML = tickets
          .map(
            (ticket) => `
                  <tr>
                      <td>${ticket.ticket_id}</td>
                      <td>${ticket.subject}</td>
                      <td>${ticket.status}</td>
                      <td>${ticket.priority}</td>
                      <td>${ticket.created_at}</td>
                  </tr>
              `
          )
          .join("");
      });
  }
});
