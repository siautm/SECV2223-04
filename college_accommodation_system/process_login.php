
<?php
session_start();

include('database/db_connect.php');

$username = trim($_POST['username']);
$password = $_POST['password'];

$sql = "SELECT * FROM users WHERE username = ?";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "s", $username);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

if ($row = mysqli_fetch_assoc($result)) {
    if (password_verify($password, $row['password'])) {
        // Store login session
        $_SESSION['username'] = $row['username'];
        $_SESSION['role'] = $row['role'];

        // Store last username in cookie
        setcookie('last_username', $username, time() + (86400 * 30), "/");

        // Redirect to homepage
        header("Location: index.php");
        exit();
    } else {
        // Wrong password
        //$error = "Incorrect password.";
        header("Location: login.php?message=failpw");
    }
} else {
    // No user found
    //$error = "User not found.";
    header("Location: login.php?message=failuser");
}
