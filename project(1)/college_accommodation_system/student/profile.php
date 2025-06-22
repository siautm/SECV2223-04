<?php
session_start();
include('../includes/auth_check.php');
include('../includes/header.php');
include('../includes/navbar.php');
include('../database/db_connect.php');

// Get current user ID
$username = $_SESSION['username'];
$query_user = "SELECT id FROM users WHERE username = ?";
$stmt = mysqli_prepare($conn, $query_user);
mysqli_stmt_bind_param($stmt, "s", $username);
mysqli_stmt_execute($stmt);
$user_result = mysqli_stmt_get_result($stmt);
$user = mysqli_fetch_assoc($user_result);
$user_id = $user['id'];

// Fetch profile info
$query_profile = "SELECT * FROM profile WHERE user_id = ?";
$stmt = mysqli_prepare($conn, $query_profile);
mysqli_stmt_bind_param($stmt, "i", $user_id);
mysqli_stmt_execute($stmt);
$profile_result = mysqli_stmt_get_result($stmt);
$profile = mysqli_fetch_assoc($profile_result);
?>

<h2>Edit Profile</h2>
<form action="../process/process_update_profile.php" method="POST">
    <label>Full Name:</label><br>
    <input type="text" name="full_name" value="<?= $profile['full_name'] ?? '' ?>" required><br><br>

    <label>Phone:</label><br>
    <input type="text" name="phone" value="<?= $profile['phone'] ?? '' ?>" required><br><br>

    <label>Address:</label><br>
    <textarea name="address" rows="4" required><?= $profile['address'] ?? '' ?></textarea><br><br>

    <button type="submit">Update Profile</button>
</form>

<?php include('../includes/footer.php'); ?>

