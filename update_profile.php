<?php
session_start();
require 'db.php';

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}

$new_email = $_POST['email'];
$username = $_SESSION['username'];

$sql = "UPDATE users SET email=? WHERE username=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ss", $new_email, $username);
$stmt->execute();

header("Location: profile.php");
exit;
