<?php
// apply.php

session_start();
include('../includes/auth_check.php');
include('../includes/header.php');
include('../includes/navbar.php');
include('../database/db_connect.php');

$query = "SELECT * FROM college";
$result = mysqli_query($conn, $query);
?>

<main class="main-center">
    <div class="dashboard-card" style="max-width: 600px;">
        <h2 >🏫 Apply for Accommodation</h2>
        <?php
            if(isset($_GET['update'])){
                if($_GET['update']=="success"){
                    echo "<div style='background-color:lightgreen; padding:10px; border-radius:5px; color:darkgreen;'>
                    ✅ Application has been sent!</div><br>";
                }
            }
        ?>
        <form action="/process/process_apply.php" method="POST">
            <label style="font-weight: bold;">Select College:</label><br>
            <select name="college_id" required class = "select">
                <option value="">-- Select College --</option>
                <?php while ($row = mysqli_fetch_assoc($result)): ?>
                    <option value="<?= $row['id'] ?>"><?= $row['college_name'] ?></option>
                <?php endwhile; ?>
            </select>

            <label style="font-weight: bold;">Additional Notes:</label><br>
            <textarea name="notes" rows="4" placeholder="Optional..." class = "text"></textarea>

            <button type="submit" class = "submit-button">📤 Submit Application</button>
        </form>
    </div>
</main>

<?php include('../includes/footer.php'); ?>
