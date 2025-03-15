// login.php (For user login)
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
$username = $_POST['username'];
$password = $_POST['password'];

$conn = new mysqli("localhost", "root", "", "ticket_support");

$sql = "SELECT id, password FROM users WHERE username = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
$row = $result->fetch_assoc();
if (password_verify($password, $row['password'])) {
$_SESSION['user_id'] = $row['id'];
echo "Login successful!";
} else {
echo "Incorrect password.";
}
} else {
echo "No user found.";
}

$stmt->close();
$conn->close();
}