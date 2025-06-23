<?php
session_start();
$theme = $_COOKIE['theme'] ?? 'light';
$last_username = $_COOKIE['last_username'] ?? '';
include('includes/header.php');
include('includes/navbar.php');
echo "Theme: " . ($_COOKIE['theme'] ?? 'none') . "<br>";
?>

<h2 style="text-align:center;">Login</h2>

<form action="process_login.php" method="POST" style="max-width:300px; margin:auto;">
    <label>Username:</label>
    <input type="text" name="username" value="<?= htmlspecialchars($last_username) ?>" required><br>
    
    <label>Password:</label>
    <input type="password" name="password" required><br>
    
    <label><input type="checkbox" name="remember" value="1"> Remember Me</label><br><br>
    
    <input type="submit" value="Login">
</form>

<?php include('includes/footer.php'); ?>

