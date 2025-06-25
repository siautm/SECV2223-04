<?php
include('../includes/auth_check.php');
include('../includes/header.php');
include('../includes/navbar.php');
?>

<main class="main-center">
    <div class="dashboard-card">
        <h2>🎓 Admin Dashboard</h2>
        <p>Welcome, <strong><?= htmlspecialchars($_SESSION['username']) ?></strong>! You have full administrative control.</p>

        <section class="dashboard-section">
            <h3>🔧 Admin Tools</h3>
            <div class="button-group">
                <a href="manage_users.php" class="button-link">👥 Manage Users</a>
            </div>
        </section>

        <section class="dashboard-section">
            <h3>📘 Tips</h3>
            <p>Use the "Manage Users" page to add or remove users and assign roles. Ensure user roles are up to date for system integrity.</p>
        </section>
    </div>
</main>

<?php include('../includes/footer.php'); ?>
