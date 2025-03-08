<?php
session_start();
require 'config.php';

// Set JSON header
header('Content-Type: application/json');

// User Registration
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['register'])) {
  // Validate input
  $username = $_POST['username'];
  $password = $_POST['password'];
  $email = $_POST['email'];

  if (empty($username) || empty($password) || empty($email)) {
    echo json_encode(["error" => "All fields are required"]);
    exit();
  }

  // Hash the password
  $passwordHash = password_hash($password, PASSWORD_BCRYPT);
  $role = 'customer'; // Default role

  // Insert user into database
  try {
    $stmt = $db->prepare("INSERT INTO users (username, password, email, role) VALUES (:username, :password, :email, :role)");
    $stmt->execute([
      'username' => $username,
      'password' => $passwordHash,
      'email' => $email,
      'role' => $role
    ]);
    echo json_encode(["message" => "User registered successfully!"]);
  } catch (PDOException $e) {
    echo json_encode(["error" => "Database error: " . $e->getMessage()]);
  }
}

// User Login
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['login'])) {
  // Validate input
  $username = $_POST['username'];
  $password = $_POST['password'];

  if (empty($username) || empty($password)) {
    echo json_encode(["error" => "Username and password are required"]);
    exit();
  }

  // Fetch user from database
  try {
    $stmt = $db->prepare("SELECT * FROM users WHERE username = :username");
    $stmt->execute(['username' => $username]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user['password'])) {
      $_SESSION['user_id'] = $user['user_id'];
      $_SESSION['role'] = $user['role'];
      echo json_encode(["message" => "Login successful!", "user" => [
        "user_id" => $user['user_id'],
        "username" => $user['username'],
        "role" => $user['role']
      ]]);
    } else {
      echo json_encode(["error" => "Invalid credentials!"]);
    }
  } catch (PDOException $e) {
    echo json_encode(["error" => "Database error: " . $e->getMessage()]);
  }
}

// User Logout
if (isset($_GET['logout'])) {
  session_destroy();
  echo json_encode(["message" => "Logged out successfully!"]);
}
