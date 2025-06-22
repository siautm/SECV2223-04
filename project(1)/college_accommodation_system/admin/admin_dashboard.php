<?php include('../includes/auth_check.php'); ?>

<?php
include('../includes/auth_check.php');
include('../includes/header.php');
include('../includes/navbar.php');
?>

<h2>🎓 Admin Dashboard</h2>
<p>Welcome, <?= $_SESSION['username'] ?>. You have full access.</p>

<?php include('../includes/footer.php'); ?>

