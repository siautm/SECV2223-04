<?php
session_start();
include('includes/header.php');
include('includes/navbar.php');
?>

<h2 style="text-align:center;">Login</h2>

<form action="process_login.php" method="POST" style="max-width:300px; margin:auto;">
    <label>Username:</label>
    <input type="text" name="username" required><br>
    
    <label>Password:</label>
    <input type="password" name="password" required><br>
    
    <input type="submit" value="Login">
</form>

<?php include('includes/footer.php'); ?>

