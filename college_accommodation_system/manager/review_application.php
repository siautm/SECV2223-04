<?php
session_start();
include('../includes/auth_check.php');
include('../includes/header.php');
include('../includes/navbar.php');
include('../database/db_connect.php');

// Only allow manager
if ($_SESSION['role'] !== 'manager') {
    echo "<main style='padding: 40px; text-align: center;'><h2 style='color: red;'>🚫 Access Denied</h2><p>You do not have permission to view this page.</p></main>";
    include('../includes/footer.php');
    exit;
}

// Process Approve/Reject
if (isset($_GET['id']) && isset($_GET['action'])) {
    $app_id = intval($_GET['id']);
    $action = $_GET['action'];
    $status_id = ($action === 'approve') ? 2 : (($action === 'reject') ? 3 : 1);

    if ($status_id !== 1) {
        $query_update = "UPDATE application SET status_id = ? WHERE id = ?";
        $stmt = mysqli_prepare($conn, $query_update);
        mysqli_stmt_bind_param($stmt, "ii", $status_id, $app_id);
        mysqli_stmt_execute($stmt);

        echo "<div style='text-align: center; color: green; margin-top: 20px;'>✅ Application ID $app_id updated successfully.</div>";
    }
}

// Fetch all pending applications
$query = "
    SELECT application.id, users.username, profile.full_name, college.college_name, application.notes
    FROM application
    JOIN users ON application.student_id = users.id
    JOIN profile ON users.id = profile.user_id
    JOIN college ON application.college_id = college.id
    WHERE application.status_id = 1
";
$result = mysqli_query($conn, $query);
?>



<main class="main-center">
    <div class="dashboard-card" style="max-width: 600px;">
        <h2 >📋 Pending Applications</h2>

        <table >
            <thead s>
                <tr>
                    <th >Student</th>
                    <th>College</th>
                    <th >Notes</th>
                    <th >Action</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = mysqli_fetch_assoc($result)): ?>
                    <tr>
                        <td >
                            <?= htmlspecialchars($row['full_name']) ?> <br><small>(<?= htmlspecialchars($row['username']) ?>)</small>
                        </td>
                        <td ><?= htmlspecialchars($row['college_name']) ?></td>
                        <td ><?= htmlspecialchars($row['notes']) ?></td>
                        <td >
                            <a href="review_application.php?id=<?= $row['id'] ?>&action=approve" style="color: green; font-weight: bold; text-decoration: none;">✅ Approve</a> |
                            <a href="review_application.php?id=<?= $row['id'] ?>&action=reject" style="color: red; font-weight: bold; text-decoration: none;">❌ Reject</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</main>

<?php include('../includes/footer.php'); ?>

