<?php
session_start();
include('includes/header.php');
include('includes/navbar.php');
?>

<main style="text-align:center;">
    <h1>🏠 Home</h1>

    <?php if (isset($_SESSION['username'])): ?>
        <p>Welcome, <strong><?= $_SESSION['username'] ?></strong>!</p>
        <p>Your role: <?= $_SESSION['role'] ?></p>
    <?php else: ?>
        <p>You are not logged in. <a href="login.php">Login here</a></p>
    <?php endif; ?>
</main>

<?php include('includes/footer.php'); ?>

