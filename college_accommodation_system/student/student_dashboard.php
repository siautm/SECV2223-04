<?php
include('../includes/auth_check.php');
include('../includes/header.php');
include('../includes/navbar.php');
?>

<main class="main-center">
    <div class="dashboard-card">
        <h2>🎓 Student Dashboard</h2>
        <p>Welcome, <strong><?= htmlspecialchars($_SESSION['username']) ?></strong>! You can apply for accommodation and track your application status.</p>

        <section class="dashboard-section">
            <h3>📝 Actions</h3>
            <div class="button-group">
                <a href="apply.php" class="button-link">🏠 Apply for Accommodation</a>
                <a href="status.php" class="button-link secondary">📄 View Application Status</a>
            </div>
        </section>

        <section class="dashboard-section">
            <h3>📘 Tips</h3>
            <p>Use the "Apply" page to submit your application. You can always check your application status and update your profile as needed.</p>
        </section>
    </div>
</main>

<?php include('../includes/footer.php'); ?>
