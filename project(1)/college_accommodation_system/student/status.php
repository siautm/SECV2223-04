<?php
session_start();
include('../includes/auth_check.php');
include('../includes/header.php');
include('../includes/navbar.php');
include('../database/db_connect.php');

// Get student user ID
$username = $_SESSION['username'];
$sql = "SELECT id FROM users WHERE username = ?";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "s", $username);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$user = mysqli_fetch_assoc($result);
$student_id = $user['id'];

// Fetch applications for this student
$query = "SELECT application.date_applied, college.college_name, status.status_name, application.notes
          FROM application
          JOIN college ON application.college_id = college.id
          JOIN status ON application.status_id = status.id
          WHERE application.student_id = ?
          ORDER BY application.date_applied DESC";

$stmt = mysqli_prepare($conn, $query);
mysqli_stmt_bind_param($stmt, "i", $student_id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
?>

<h2>My Accommodation Applications</h2>
<table border="1" cellpadding="8">
    <tr>
        <th>Date</th>
        <th>College</th>
        <th>Status</th>
        <th>Notes</th>
    </tr>
    <?php while ($row = mysqli_fetch_assoc($result)): ?>
    <tr>
        <td><?= $row['date_applied'] ?></td>
        <td><?= $row['college_name'] ?></td>
        <td><?= $row['status_name'] ?></td>
        <td><?= $row['notes'] ?></td>
    </tr>
    <?php endwhile; ?>
</table>

<?php include('../includes/footer.php'); ?>

