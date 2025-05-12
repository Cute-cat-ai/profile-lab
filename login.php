<?php
session_start();
require 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE username=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    
    $result = $stmt->get_result();
    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();
        if ($password === $user['password']) {
            $_SESSION['username'] = $user['username'];
            header("Location: profile.php");
            exit;
        } else {
            echo "❌ Invalid password!";
        }
    } else {
        echo "❌ User not found!";
    }
}
?>

<!-- HTML Form -->
<form method="POST">
    Username: <input type="text" name="username" required><br>
    Password: <input type="text" name="password" required><br>
    <button type="submit">Login</button>
</form>
