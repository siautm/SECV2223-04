<?php
session_start();
include('../includes/auth_check.php');
include('../includes/header.php');
include('../includes/navbar.php');
include('../database/db_connect.php');

// Only manager
if ($_SESSION['role'] !== 'manager') {
    echo "Access denied.";
    exit;
}

// Sorting logic
$sort = $_GET['sort'] ?? 'date';
$sort_sql = match($sort) {
    'name' => 'profile.full_name',
    'status' => 'application.status',
    default => 'application.created_at'
};

$query = "
SELECT users.username, profile.full_name, college.college_name,
       application.notes, application.status, application.created_at
FROM application
JOIN users ON application.user_id = users.id
JOIN profile ON users.id = profile.user_id
JOIN college ON application.college_id = college.id
ORDER BY $sort_sql ASC
";

$result = mysqli_query($conn, $query);
?>

<h2>All Applications Report</h2>

<form method="GET">
    Sort by:
    <select name="sort" onchange="this.form.submit()">
        <option value="date" <?= $sort === 'date' ? 'selected' : '' ?>>Date</option>
        <option value="name" <?= $sort === 'name' ? 'selected' : '' ?>>Name</option>
        <option value="status" <?= $sort === 'status' ? 'selected' : '' ?>>Status</option>
    </select>
</form>

<table border="1" cellpadding="8">
    <tr>
        <th>Student</th>
        <th>College</th>
        <th>Notes</th>
        <th>Status</th>
        <th>Applied At</th>
    </tr>

    <?php while ($row = mysqli_fetch_assoc($result)): ?>
        <tr>
            <td><?= $row['full_name'] ?> (<?= $row['username'] ?>)</td>
            <td><?= $row['college_name'] ?></td>
            <td><?= $row['notes'] ?></td>
            <td><?= ucfirst($row['status']) ?></td>
            <td><?= $row['created_at'] ?></td>
        </tr>
    <?php endwhile; ?>
</table>

<?php include('../includes/footer.php'); ?>

