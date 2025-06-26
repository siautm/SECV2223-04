<?php
session_start();
include('../includes/auth_check.php');
include('../includes/header.php');
include('../includes/navbar.php');
include('../database/db_connect.php');

$username = $_SESSION['username'];
$sql = "SELECT id FROM users WHERE username = ?";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "s", $username);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$user = mysqli_fetch_assoc($result);
$student_id = $user['id'];

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

<main class="main-center">
    <div class="dashboard-card" style="height:90%; overflow-y:auto;">
        <h2 class="dashboard-title">📄 My Applications</h2>
        <table >
            <thead >
                <tr>
                    <th >Date</th>
                    <th >College</th>
                    <th >Status</th>
                    <th>Notes</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = mysqli_fetch_assoc($result)): 
                $status = $row['status_name'];
                $color = match($status) {
                    'Pending' => 'orange',
                    'Approved' => 'green',
                    'Rejected' => 'darkred',
                    default => 'black'
                };?>
                <tr >
                    <td ><?= $row['date_applied'] ?></td>
                    <td><?= $row['college_name'] ?></td>
                    <td style="color:<?= $color?>;">
                    <?= $row['status_name'] 
                    ?>
                    </td>
                    <td><?= $row['notes'] ?></td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</main>

<?php include('../includes/footer.php'); ?>
