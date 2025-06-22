<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

include('../includes/auth_check.php');
include('../includes/header.php');
include('../includes/navbar.php');
include('../database/db_connect.php');

// Allow only admin
if ($_SESSION['role'] !== 'admin') {
    echo "<p>Access denied. Admins only.</p>";
    include('../includes/footer.php');
    exit;
}

// === DELETE USER ===
if (isset($_GET['delete'])) {
    $delete_id = intval($_GET['delete']);
    mysqli_query($conn, "DELETE FROM users WHERE id = $delete_id");
    echo "<p style='color:red;'>🗑️ User deleted.</p>";
}

// === EDIT USER ===
$edit_mode = false;
if (isset($_GET['edit'])) {
    $edit_id = intval($_GET['edit']);
    $edit_query = mysqli_query($conn, "SELECT * FROM users WHERE id = $edit_id");
    $edit_user = mysqli_fetch_assoc($edit_query);
    $edit_mode = true;
}

// === UPDATE USER ===
if (isset($_POST['update_user'])) {
    $user_id = $_POST['user_id'];
    $role = $_POST['role'];
    $stmt = mysqli_prepare($conn, "UPDATE users SET role=? WHERE id=?");
    mysqli_stmt_bind_param($stmt, "si", $role, $user_id);
    mysqli_stmt_execute($stmt);
    echo "<p style='color:green;'>✅ User updated.</p>";
    $edit_mode = false;
}

// === ADD USER ===
if (isset($_POST['add_user'])) {
    $username = trim($_POST['username']);
    $password = $_POST['password'];
    $role = $_POST['role'];

    if ($username && $password && $role) {
        $hashed = password_hash($password, PASSWORD_DEFAULT);
        $stmt = mysqli_prepare($conn, "INSERT INTO users (username, password, role) VALUES (?, ?, ?)");
        mysqli_stmt_bind_param($stmt, "sss", $username, $hashed, $role);
        mysqli_stmt_execute($stmt);
        echo "<p style='color:green;'>✅ User added.</p>";
    } else {
        echo "<p style='color:red;'>❌ All fields required.</p>";
    }
}
?>

<h2><?= $edit_mode ? "Edit User" : "Add New User" ?></h2>

<form method="POST" action="">
    <?php if ($edit_mode): ?>
        <input type="hidden" name="user_id" value="<?= $edit_user['id'] ?>">
    <?php else: ?>
        <input type="hidden" name="add_user" value="1">
    <?php endif; ?>

    <label>Username:</label><br>
    <input type="text" name="username" value="<?= $edit_user['username'] ?? '' ?>" <?= $edit_mode ? 'readonly' : 'required' ?>><br><br>

    <?php if (!$edit_mode): ?>
        <label>Password:</label><br>
        <input type="password" name="password" required><br><br>
    <?php endif; ?>

    <label>Role:</label><br>
    <select name="role" required>
        <option value="">-- Select Role --</option>
        <option value="admin" <?= ($edit_user['role'] ?? '') == 'admin' ? 'selected' : '' ?>>Admin</option>
        <option value="manager" <?= ($edit_user['role'] ?? '') == 'manager' ? 'selected' : '' ?>>Manager</option>
        <option value="student" <?= ($edit_user['role'] ?? '') == 'student' ? 'selected' : '' ?>>Student</option>
    </select><br><br>

    <button type="submit" name="<?= $edit_mode ? 'update_user' : 'add_user' ?>">
        <?= $edit_mode ? "✏️ Update User" : "➕ Add User" ?>
    </button>
</form>

<hr>

<h3>All Users</h3>
<table border="1" cellpadding="8">
    <tr>
        <th>Username</th>
        <th>Role</th>
        <th>Actions</th>
    </tr>

    <?php
    $users = mysqli_query($conn, "SELECT * FROM users");
    while ($row = mysqli_fetch_assoc($users)): ?>
        <tr>
            <td><?= htmlspecialchars($row['username']) ?></td>
            <td><?= htmlspecialchars($row['role']) ?></td>
            <td>
                <a href="?edit=<?= $row['id'] ?>">✏️ Edit</a> |
                <a href="?delete=<?= $row['id'] ?>" onclick="return confirm('Delete this user?')">🗑️ Delete</a>
            </td>
        </tr>
    <?php endwhile; ?>
</table>

<?php include('../includes/footer.php'); ?>

