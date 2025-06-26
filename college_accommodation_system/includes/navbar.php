<nav style="background:#e0e0e0; padding:15px 20px; display:flex; flex-wrap:wrap; justify-content:space-between; align-items:center;">
    <div style="display: flex; gap: 15px; flex-wrap: wrap;">
        <a class="nav-bar" href="/index.php">Home</a>

        <?php 
        if (isset($_SESSION['role'])):  print(" | ");?>
            <a class="nav-bar" href="/includes/profile.php">Profile</a>

            <?php 
            if ($_SESSION['role'] === 'admin'): print(" | ");?>
                <a class="nav-bar" href="/admin/admin_dashboard.php">Dashboard</a>
                <?php print(" | "); ?>
                <a class="nav-bar" href="/admin/manage_users.php">Manage Users</a>

            <?php 
            elseif ($_SESSION['role'] === 'manager'): print(" | "); ?>
                <a class="nav-bar" href="/manager/manager_dashboard.php">Dashboard</a>
                <?php print(" | "); ?>
                <a class="nav-bar" href="/manager/review_application.php">Review Applications</a>

            <?php 
            elseif ($_SESSION['role'] === 'student'):  print(" | ");?>
                <a class="nav-bar" href="/student/student_dashboard.php">Dashboard</a>
                <?php print(" | "); ?>
                <a class="nav-bar" href="/student/apply.php">Apply</a>
                <?php print(" | "); ?>
                <a class="nav-bar" href="/student/status.php">Application Status</a>
            <?php endif; print(" | "); ?>

            <a class="nav-bar" href="/logout.php">Logout</a>
            
        <?php else: print(" | "); ?>
            <a class="nav-bar" href="/login.php">Login</a>
        <?php endif; ?>
    </div>

</nav>
