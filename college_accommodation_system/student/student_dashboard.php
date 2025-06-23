<?php include('../includes/auth_check.php'); ?>

<?php
include('../includes/auth_check.php');
include('../includes/header.php');
include('../includes/navbar.php');
?>

<h2>🎓 Student Dashboard</h2>
<p>Welcome, <?= $_SESSION['username'] ?>. You can apply for accommodation here.</p>

<?php include('../includes/footer.php'); ?>

