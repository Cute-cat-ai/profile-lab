<?php
session_start();
require 'db.php';

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}

$username = $_SESSION['username'];
$sql = "SELECT * FROM users WHERE username=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();
?>

<h2>👤 Profile Page</h2>
<p><strong>Username:</strong> <?= htmlspecialchars($user['username']) ?></p>
<p><strong>Email:</strong> <?= htmlspecialchars($user['email']) ?></p>

<h3>✏️ Edit Email</h3>
<form method="POST" action="update_profile.php">
    <label>New Email: </label>
    <input type="email" name="email" value="<?= htmlspecialchars($user['email']) ?>" required>
    <button type="submit">Update</button>
</form>

<a href="logout.php">Logout</a>
