<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();

include(__DIR__ . '/auth_check.php');
include(__DIR__ . '/header.php');
include(__DIR__ . '/navbar.php');
include(__DIR__ . '/../database/db_connect.php'); // Go up one folder to access db_connect

// Get current user's info
$username = $_SESSION['username'];
$role = $_SESSION['role'];

// Get user ID
$query_user = "SELECT id FROM users WHERE username = ?";
$stmt = mysqli_prepare($conn, $query_user);
mysqli_stmt_bind_param($stmt, "s", $username);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$user = mysqli_fetch_assoc($result);
$user_id = $user['id'];

// Get profile info
$query_profile = "SELECT * FROM profile WHERE user_id = ?";
$stmt = mysqli_prepare($conn, $query_profile);
mysqli_stmt_bind_param($stmt, "i", $user_id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$profile = mysqli_fetch_assoc($result);
if (!$profile) {
    $insert_query = "INSERT INTO profile (user_id, full_name, phone, address) VALUES (?, '', '', '')";
    $insert_stmt = mysqli_prepare($conn, $insert_query);
    mysqli_stmt_bind_param($insert_stmt, "i", $user_id);
    mysqli_stmt_execute($insert_stmt);

    // Re-fetch
    $stmt = mysqli_prepare($conn, $query_profile);
    mysqli_stmt_bind_param($stmt, "i", $user_id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $profile = mysqli_fetch_assoc($result);
}
?>


<h2><?= ucfirst($role) ?> Profile</h2>



<form action="/college_accommodation_system/process/process_update_profile.php" method="POST">
    <label>Full Name:</label><br>
    <input type="text" name="full_name" value="<?= $profile['full_name'] ?? '' ?>" required><br><br>

    <label>Phone:</label><br>
    <input type="text" name="phone" value="<?= $profile['phone'] ?? '' ?>" required><br><br>

    <label>Address:</label><br>
    <textarea name="address" rows="4" required><?= $profile['address'] ?? '' ?></textarea><br><br>

    <button type="submit">Update Profile</button>
</form>

<?php include(__DIR__ . '/footer.php'); ?>

