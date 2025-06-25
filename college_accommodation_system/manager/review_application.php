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

    // Get college_id of the application
    $query_app = "SELECT college_id FROM application WHERE id = ?";
    $stmt_app = mysqli_prepare($conn, $query_app);
    mysqli_stmt_bind_param($stmt_app, "i", $app_id);
    mysqli_stmt_execute($stmt_app);
    mysqli_stmt_bind_result($stmt_app, $college_id);
    mysqli_stmt_fetch($stmt_app);
    mysqli_stmt_close($stmt_app);

    if ($action === 'approve') {
        // Check current capacity
        $query_capacity = "SELECT capacity FROM college WHERE id = ?";
        $stmt_cap = mysqli_prepare($conn, $query_capacity);
        mysqli_stmt_bind_param($stmt_cap, "i", $college_id);
        mysqli_stmt_execute($stmt_cap);
        mysqli_stmt_bind_result($stmt_cap, $capacity);
        mysqli_stmt_fetch($stmt_cap);
        mysqli_stmt_close($stmt_cap);

        if ($capacity > 0) {
            // Update application status to approved
            $status_id = 2;
            $query_update = "UPDATE application SET status_id = ?, status = 'approved' WHERE id = ?";
            $stmt = mysqli_prepare($conn, $query_update);
            mysqli_stmt_bind_param($stmt, "ii", $status_id, $app_id);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);

            // Decrease college capacity by 1
            $query_dec = "UPDATE college SET capacity = capacity - 1 WHERE id = ?";
            $stmt_dec = mysqli_prepare($conn, $query_dec);
            mysqli_stmt_bind_param($stmt_dec, "i", $college_id);
            mysqli_stmt_execute($stmt_dec);
            mysqli_stmt_close($stmt_dec);

            echo "<div style='text-align: center; color: green; margin-top: 20px;'>✅ Application ID $app_id approved. College capacity updated.</div>";
        } else {
            echo "<div style='text-align: center; color: red; margin-top: 20px;'>⚠️ Cannot approve. College is full.</div>";
        }
    } elseif ($action === 'reject') {
        $status_id = 3;
        $query_update = "UPDATE application SET status_id = ?, status = 'rejected' WHERE id = ?";
        $stmt = mysqli_prepare($conn, $query_update);
        mysqli_stmt_bind_param($stmt, "ii", $status_id, $app_id);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);

        echo "<div style='text-align: center; color: green; margin-top: 20px;'>❌ Application ID $app_id rejected.</div>";
    }
}

// Fetch all pending applications with capacity
$query = "
    SELECT 
        application.id, 
        users.username, 
        profile.full_name, 
        college.college_name, 
        college.capacity, 
        application.notes
    FROM application
    JOIN users ON application.student_id = users.id
    JOIN profile ON users.id = profile.user_id
    JOIN college ON application.college_id = college.id
    WHERE application.status_id = 1
";
$result = mysqli_query($conn, $query);
?>

<main class="main-center">
    <div class="dashboard-card" style="max-width: 800px;">
        <h2>📋 Pending Applications</h2>

        <table>
            <thead>
                <tr>
                    <th>Student</th>
                    <th>College (Capacity Left)</th>
                    <th>Notes</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = mysqli_fetch_assoc($result)): ?>
                    <tr>
                        <td>
                            <?= htmlspecialchars($row['full_name']) ?><br><small>(<?= htmlspecialchars($row['username']) ?>)</small>
                        </td>
                        <td><?= htmlspecialchars($row['college_name']) ?> (<?= $row['capacity'] ?> left)</td>
                        <td><?= htmlspecialchars($row['notes']) ?></td>
                        <td>
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

