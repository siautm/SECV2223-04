<?php
include('../includes/auth_check.php');
include('../includes/header.php');
include('../includes/navbar.php');
?>

<main class="main-center">
    <div class="dashboard-card">
        <h2>🎓 Manager Dashboard</h2>
        <p>Welcome, <strong><?= htmlspecialchars($_SESSION['username']) ?></strong>! Here you can manage accommodation tasks effectively.</p>

        <section class="dashboard-section">
            <h3>📋 Quick Actions</h3>
            <div class="button-group">
                <a href="review_application.php" class="button-link">📄 Review Applications</a>
            </div>
        </section>

        <section class="dashboard-section">
            <h3>🧭 Navigation Tips</h3>
            <p>Use the "Review Applications" page to approve or reject student submissions</p>
        </section>
    </div>
</main>

<?php include('../includes/footer.php'); ?>
