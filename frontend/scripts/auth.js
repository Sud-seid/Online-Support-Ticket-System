document.addEventListener("DOMContentLoaded", () => {
  const loginForm = document.getElementById("loginForm");
  const registerForm = document.getElementById("registerForm");
  const logoutButton = document.getElementById("logout");

  if (loginForm) {
    loginForm.addEventListener("submit", async (e) => {
      e.preventDefault();
      const username = document.getElementById("username").value;
      const password = document.getElementById("password").value;

      const response = await fetch("http://localhost/backend/auth.php", {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify({ username, password, login: true }),
      });

      const data = await response.json();
      if (data.message === "Login successful!") {
        localStorage.setItem("user", JSON.stringify(data.user));
        window.location.href = "dashboard.html";
      } else {
        document.getElementById("loginMessage").textContent = data.message;
      }
    });
  }

  if (registerForm) {
    registerForm.addEventListener("submit", async (e) => {
      e.preventDefault();
      const username = document.getElementById("username").value;
      const email = document.getElementById("email").value;
      const password = document.getElementById("password").value;

      const response = await fetch("http://localhost/backend/auth.php", {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify({ username, email, password, register: true }),
      });

      const data = await response.json();
      document.getElementById("registerMessage").textContent = data.message;
    });
  }

  if (logoutButton) {
    logoutButton.addEventListener("click", async () => {
      const response = await fetch(
        "http://localhost/backend/auth.php?logout=true"
      );
      const data = await response.json();
      localStorage.removeItem("user");
      window.location.href = "index.html";
    });
  }

  // Display username on dashboard
  const usernameElement = document.getElementById("username");
  if (usernameElement) {
    const user = JSON.parse(localStorage.getItem("user"));
    if (user) {
      usernameElement.textContent = user.username;
    } else {
      window.location.href = "login.html";
    }
  }
});
