<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();


include('database/db_connect.php');

$username = $_POST['username'];
$password = $_POST['password'];

$sql = "SELECT * FROM users WHERE username = ?";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "s", $username);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

if ($row = mysqli_fetch_assoc($result)) {
    if (password_verify($password, $row['password'])) {
        $_SESSION['username'] = $row['username'];
        $_SESSION['role'] = $row['role'];
        $_SESSION['role'] = $row['role'];

        setcookie('last_username', $username, time() + (86400 * 30), "/"); // 30 days


        header("Location: index.php");
        exit();
    } else {
        echo "❌ Incorrect password. <a href='login.php'>Try again</a>";
    }
} else {
    echo "❌ User not found. <a href='login.php'>Try again</a>";
}
?>

