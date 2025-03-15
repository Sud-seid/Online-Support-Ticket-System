<?php
$conn = new mysqli("localhost", "root", "", "ticket_support");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $name = $_POST['name'];
  $email = $_POST['email'];
  $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
  $role = $_POST['role'];

  $sql = "INSERT INTO users (name, email, password, role) VALUES ('$name', '$email', '$password', '$role')";

  if ($conn->query($sql) === TRUE) {
    echo "User registered successfully!";
  } else {
    echo "Error: " . $conn->error;
  }
}

$conn->close();
