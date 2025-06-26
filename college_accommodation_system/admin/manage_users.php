<?php
session_start();

include('../includes/auth_check.php');
include('../includes/header.php');
include('../includes/navbar.php');
include('../database/db_connect.php');

// Allow only admin
if ($_SESSION['role'] !== 'admin') {
    echo "<main style='padding: 40px; text-align: center;'><h2 style='color: red;'>🚫 Access Denied</h2><p>Admins only.</p></main>";
    include('../includes/footer.php');
    exit;
}

// === DELETE USER ===
if (isset($_GET['delete'])) {
    $delete_id = intval($_GET['delete']);
    mysqli_query($conn, "DELETE FROM users WHERE id = $delete_id");
    echo "<div style='text-align:center; color:red;'>🗑️ User deleted.</div>";
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
    echo "<div style='text-align:center; color:green;'>✅ User updated.</div>";
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
        echo "<div style='text-align:center; padding:10px 0px 0px; color:green;'>✅ User added.</div>";
    } else {
        echo "<div style='text-align:center; padding:10px 0px 0px color:red;'>❌ All fields are required.</div>";
    }
}
?>



<main style="padding: 10px; max-width: 700px; margin: auto;">
    <div style="background: white; padding: 30px; border-radius: 12px; box-shadow: 0 0 15px rgba(0,0,0,0.1); height:80%; overflow-y:auto;">
        <h2 style="text-align: center; color: #003366; margin-bottom: 20px;">
            <?= $edit_mode ? "✏️ Edit User" : "➕ Add New User" ?>
        </h2>

        <form method="POST" action="" style="margin-bottom: 40px;">
            <?php if ($edit_mode): ?>
                <input type="hidden" name="user_id" value="<?= $edit_user['id'] ?>">
            <?php else: ?>
                <input type="hidden" name="add_user" value="1">
            <?php endif; ?>

            <label><strong>Username:</strong></label><br>
            <input type="text" name="username" value="<?= $edit_user['username'] ?? '' ?>" <?= $edit_mode ? 'readonly' : 'required' ?>
                style="width: 100%; padding: 10px; margin-bottom: 15px; border: 1px solid #ccc; border-radius: 5px;">

            <?php if (!$edit_mode): ?>
                <label><strong>Password:</strong></label><br>
                <input type="password" name="password" required
                    style="width: 100%; padding: 10px; margin-bottom: 15px; border: 1px solid #ccc; border-radius: 5px;">
            <?php endif; ?>

            <label><strong>Role:</strong></label><br>
            <select name="role" required style="width: 100%; padding: 10px; margin-bottom: 20px; border: 1px solid #ccc; border-radius: 5px;">
                <option value="">-- Select Role --</option>
                <option value="admin" <?= ($edit_user['role'] ?? '') == 'admin' ? 'selected' : '' ?>>Admin</option>
                <option value="manager" <?= ($edit_user['role'] ?? '') == 'manager' ? 'selected' : '' ?>>Manager</option>
                <option value="student" <?= ($edit_user['role'] ?? '') == 'student' ? 'selected' : '' ?>>Student</option>
            </select>

            <button type="submit" name="<?= $edit_mode ? 'update_user' : 'add_user' ?>" style="width: 100%; padding: 12px; background-color: #003366; color: white; border: none; border-radius: 6px; font-size: 1rem; cursor: pointer;">
                <?= $edit_mode ? "✏️ Update User" : "➕ Add User" ?>
            </button>
        </form>

        <h3 style="margin-bottom: 10px;">👥 All Users</h3>
        <table >
            <thead s>
                <tr>
                    <th >Username</th>
                    <th>Role</th>
                    <th >Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $users = mysqli_query($conn, "SELECT * FROM users");
                while ($row = mysqli_fetch_assoc($users)): ?>
                    <tr >
                        <td ><?= htmlspecialchars($row['username']) ?></td>
                        <td ><?= htmlspecialchars($row['role']) ?></td>
                        <td >
                            <a href="?edit=<?= $row['id'] ?>" style="color: #007bff; text-decoration: none;">✏️ Edit</a> |
                            <a href="?delete=<?= $row['id'] ?>" onclick="return confirm('Delete this user?')" style="color: red; text-decoration: none;">🗑️ Delete</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</main>

<?php include('../includes/footer.php'); ?>
