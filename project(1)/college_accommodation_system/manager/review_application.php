<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();

include('../includes/auth_check.php');
include('../includes/header.php');
include('../includes/navbar.php');
include('../database/db_connect.php');

// Only allow manager
if ($_SESSION['role'] !== 'manager') {
    echo "Access denied.";
    exit;
}

// Process Approve/Reject directly here
if (isset($_GET['id']) && isset($_GET['action'])) {
    $app_id = intval($_GET['id']);
    $action = $_GET['action'];

    if ($action === 'approve') {
        $status_id = 2;
    } elseif ($action === 'reject') {
        $status_id = 3;
    } else {
        $status_id = 1;
    }

    if ($status_id !== 1) {
        $query_update = "UPDATE application SET status_id = ? WHERE id = ?";
        $stmt = mysqli_prepare($conn, $query_update);
        mysqli_stmt_bind_param($stmt, "ii", $status_id, $app_id);
        mysqli_stmt_execute($stmt);

        echo "<p style='color:green;'>Application ID $app_id has been updated (Status ID: $status_id).</p>";
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

<h2>Pending Applications</h2>

<table border="1" cellpadding="8">
    <tr>
        <th>Student</th>
        <th>College</th>
        <th>Notes</th>
        <th>Action</th>
    </tr>

    <?php while ($row = mysqli_fetch_assoc($result)): ?>
        <tr>
            <td><?= htmlspecialchars($row['full_name']) ?> (<?= htmlspecialchars($row['username']) ?>)</td>
            <td><?= htmlspecialchars($row['college_name']) ?></td>
            <td><?= htmlspecialchars($row['notes']) ?></td>
            <td>
                <a href="review_application.php?id=<?= $row['id'] ?>&action=approve">✅ Approve</a> |
                <a href="review_application.php?id=<?= $row['id'] ?>&action=reject">❌ Reject</a>
            </td>
        </tr>
    <?php endwhile; ?>
</table>

<?php include('../includes/footer.php'); ?>

