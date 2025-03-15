// Theme Toggle
const themeToggle = document.getElementById("theme-toggle");
const themeIcon = document.getElementById("theme-icon");

themeToggle.addEventListener("click", () => {
  document.body.classList.toggle("dark-mode");
  themeIcon.className = document.body.classList.contains("dark-mode")
    ? "icon sun"
    : "icon moon";
});

// Form Validation
document
  .getElementById("ticketForm")
  .addEventListener("submit", function (event) {
    let name = document.getElementById("name").value.trim();
    let email = document.getElementById("email").value.trim();
    let message = document.getElementById("message").value.trim();

    if (name === "" || email === "" || message === "") {
      alert("Please fill in all fields.");
      event.preventDefault();
    }
  });

// Ticket Creation
document.getElementById("ticketForm").addEventListener("submit", function (e) {
  e.preventDefault();

  const name = document.getElementById("name").value;
  const email = document.getElementById("email").value;
  const message = document.getElementById("message").value;

  const formData = new FormData();
  formData.append("name", name);
  formData.append("email", email);
  formData.append("message", message);

  createTicket(formData).then((response) => {
    if (response.success) {
      alert(`Ticket created! Your Ticket ID: ${response.ticketID}`);
    } else {
      alert("Error creating ticket.");
    }
  });
});

// Check Ticket Status
document
  .getElementById("checkTicketForm")
  .addEventListener("submit", function (e) {
    e.preventDefault();

    const ticketID = document.getElementById("ticketID").value;

    checkTicketStatus(ticketID).then((response) => {
      const statusDiv = document.getElementById("ticketStatus");
      if (response.success) {
        statusDiv.innerHTML = `Ticket ID: ${ticketID}<br>Status: ${response.message}`;
      } else {
        statusDiv.innerHTML = `Ticket not found.`;
      }
    });
  });
