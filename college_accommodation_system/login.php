<?php
session_start();
$last_username = $_COOKIE['last_username'] ?? '';
include('includes/header.php');
include('includes/navbar.php');
?>


<main class="login-container">
    <div class="card login">
        <h2>🔐 Login</h2>
        <form action="process_login.php" method="POST">
            <?php
            if(isset($_GET['message'])){
                if($_GET['message']=="failpw"){
                    echo "<div style='background-color:pink; padding:10px; border-radius:5px; color:darkred;'>
                    ❌ Login failed, incorrect password!</div><br>";
                }
                if($_GET['message']=="failuser"){
                    echo "<div style='background-color:pink; padding:10px; border-radius:5px; color:darkred;'>
                    ❌ Login failed, user not found!</div><br>";
                }
            }
            ?>

            <label for="username">Username:</label>
            <input type="text" name="username" id="username" value="<?= htmlspecialchars($last_username) ?>" required>

            <label for="password">Password:</label>
            <input type="password" name="password" id="password" required>

            <label>
                <input type="checkbox" name="remember" value="1"> Remember Me
            </label>

            <input type="submit" value="Login">
        </form>
    </div>
</main>

<?php include('includes/footer.php'); ?>
