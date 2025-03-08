<?php
session_start();
require 'config.php';

// User Registration
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['register'])) {
  $username = $_POST['username'];
  $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
  $email = $_POST['email'];
  $role = 'customer'; // Default role

  $stmt = $db->prepare("INSERT INTO users (username, password, email, role) VALUES (:username, :password, :email, :role)");
  $stmt->execute([
    'username' => $username,
    'password' => $password,
    'email' => $email,
    'role' => $role
  ]);

  echo json_encode(["message" => "User registered successfully!"]);
}

// User Login
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['login'])) {
  $username = $_POST['username'];
  $password = $_POST['password'];

  $stmt = $db->prepare("SELECT * FROM users WHERE username = :username");
  $stmt->execute(['username' => $username]);
  $user = $stmt->fetch(PDO::FETCH_ASSOC);

  if ($user && password_verify($password, $user['password'])) {
    $_SESSION['user_id'] = $user['user_id'];
    $_SESSION['role'] = $user['role'];
    echo json_encode(["message" => "Login successful!", "user" => $user]);
  } else {
    echo json_encode(["message" => "Invalid credentials!"]);
  }
}

// User Logout
if (isset($_GET['logout'])) {
  session_destroy();
  echo json_encode(["message" => "Logged out successfully!"]);
}
