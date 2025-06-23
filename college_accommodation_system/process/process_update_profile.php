<?php
session_start();
include('../database/db_connect.php');

$username = $_SESSION['username'];
$full_name = $_POST['full_name'];
$phone = $_POST['phone'];
$address = $_POST['address'];

// Get user ID
$getUser = mysqli_query($conn, "SELECT id FROM users WHERE username = '$username'");
$user = mysqli_fetch_assoc($getUser);
$user_id = $user['id'];

$sql = "UPDATE profile SET full_name = ?, phone = ?, address = ? WHERE user_id = ?";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "sssi", $full_name, $phone, $address, $user_id);
mysqli_stmt_execute($stmt);

header("Location: ../student/profile.php");
exit();

