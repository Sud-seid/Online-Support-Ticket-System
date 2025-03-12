<?php
session_start();
require 'config.php';

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['register'])) {

  $username = $_POST['username'];
  $password = $_POST['password'];
  $email = $_POST['email'];

  if (empty($username) || empty($password) || empty($email)) {
    echo json_encode(["error" => "All fields are required"]);
    exit();
  }

  $passwordHash = password_hash($password, PASSWORD_BCRYPT);
  $role = 'customer';

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

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['login'])) {

  $username = $_POST['username'];
  $password = $_POST['password'];

  if (empty($username) || empty($password)) {
    echo json_encode(["error" => "Username and password are required"]);
    exit();
  }

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

if (isset($_GET['logout'])) {
  session_destroy();
  echo json_encode(["message" => "Logged out successfully!"]);
}
