<?php
session_start();
include('../database/db_connect.php');

$student = $_SESSION['username'];
$college_id = $_POST['college_id'];
$notes = $_POST['notes'];
$date_applied = date('Y-m-d');
$status_id = 1; // default: Pending

// Get user ID from `users`
$getUser = mysqli_query($conn, "SELECT id FROM users WHERE username = '$student'");
$user = mysqli_fetch_assoc($getUser);
$student_id = $user['id'];

$sql = "INSERT INTO application (student_id, college_id, notes, date_applied, status_id) 
        VALUES (?, ?, ?, ?, ?)";

$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "iissi", $student_id, $college_id, $notes, $date_applied, $status_id);
mysqli_stmt_execute($stmt);

header("Location: ../student/status.php");
exit();

