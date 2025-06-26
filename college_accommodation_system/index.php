<?php
session_start();
include('includes/header.php');
include('includes/navbar.php');
?>


<main class="home-container">
    <div class="card home">
        <h1>🏠 College Accommodation System</h1>

        <?php if (isset($_SESSION['username'])): ?>
            <div class="user-info">
                <p>Welcome, <strong><?= htmlspecialchars($_SESSION['username']) ?></strong> <i>!</i></p>
                <p>Your role: <strong><?= ucfirst(htmlspecialchars($_SESSION['role'])) ?></strong></p>
            </div>
        <?php else: ?>
            <p>You are not logged in.</p>
            <a class="login-link" href="login.php">🔐 Login Here</a>
        <?php endif; ?>
    </div>
</main>

<?php include('includes/footer.php'); ?>
