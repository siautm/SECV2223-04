<?php
// Enable error reporting and start session
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();

// Use relative includes instead of absolute paths
include('../includes/auth_check.php');
include('../includes/header.php');
include('../includes/navbar.php');
include('../database/db_connect.php');

// Fetch available colleges from DB
$query = "SELECT * FROM college";
$result = mysqli_query($conn, $query);
?>

<h2>Apply for College Accommodation</h2>

<form action="/college_accommodation_system/process/process_apply.php" method="POST">
    <label>Select College:</label><br>
    <select name="college_id" required>
        <option value="">-- Select College --</option>
        <?php while ($row = mysqli_fetch_assoc($result)): ?>
            <option value="<?= $row['id'] ?>"><?= $row['college_name'] ?></option>
        <?php endwhile; ?>
    </select><br><br>

    <label>Additional Notes:</label><br>
    <textarea name="notes" rows="4" cols="50" placeholder="Optional..."></textarea><br><br>

    <button type="submit">Submit Application</button>
</form>

<?php include('../includes/footer.php'); ?>

