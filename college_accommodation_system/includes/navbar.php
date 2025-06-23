<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$theme = $_COOKIE['theme'] ?? 'light';
?>

<nav style="background:#f0f0f0; padding:10px;">
    <a href="/college_accommodation_system/index.php">Home</a>

    <?php if (isset($_SESSION['role'])): ?>
        <a href="/college_accommodation_system/includes/profile.php">Profile</a>

        <?php if ($_SESSION['role'] === 'admin'): ?>
            <a href="/college_accommodation_system/admin/admin_dashboard.php">Admin Dashboard</a>
            <a href="/college_accommodation_system/admin/manage_users.php">Manage Users</a>

        <?php elseif ($_SESSION['role'] === 'manager'): ?>
            <a href="/college_accommodation_system/manager/manager_dashboard.php">Manager Dashboard</a>
            <a href="/college_accommodation_system/manager/review_application.php">Review Applications</a> 

        <?php elseif ($_SESSION['role'] === 'student'): ?>
            <a href="/college_accommodation_system/student/student_dashboard.php">Student Dashboard</a>
            <a href="/college_accommodation_system/student/apply.php">Apply</a>
            <a href="/college_accommodation_system/student/status.php">Application Status</a>
        <?php endif; ?>

        <a href="/college_accommodation_system/logout.php">Logout</a>
    <?php else: ?>
        <a href="/college_accommodation_system/login.php">Login</a>
    <?php endif; ?>


</nav>

