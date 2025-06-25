<?php
session_start();
include('../includes/header.php');
include('../includes/navbar.php');
?>

<main class="main-center">
    <div class="dashboard-card" style="text-align: center;">
        <h2 style="color: green;">✅ Profile Updated Successfully</h2>
        <p>Your profile information has been saved.</p>
        <a href="../includes/profile.php" class="submit-button">🔙 Back to Profile</a>
    </div>
</main>

<?php include('../includes/footer.php'); ?>
