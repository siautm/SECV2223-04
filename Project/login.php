<?php
    session_start();
    require_once('config.php');

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $username = trim($_POST['username']);
        $password = trim($_POST['password']);

        $stmt = $conn->prepare("SELECT * FROM users WHERE username=? AND password=?");
        $stmt->bind_param('ss', $username, $password);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($user = $result->fetch_assoc()) {
            $_SESSION['username'] = $username;
            $_SESSION['role'] = $user['role'];
            echo "Right user, success login";
            #header("Location: dashboard.php");
            if ($user['role'] === 'admin'){
                header("Location: admin.php");
            } 
            elseif ($user['role'] === 'manager'){
                header("Location: manager.php");
            }
            elseif ($user['role'] === 'student'){
                header("Location: student.php");
            }

        } else {
		    header("location:login.php?message=fail");
            #echo "<script>alert('Invalid login'); history.back();</script>";
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <style>
        div, table, tr{
            padding:10px;
        }
        button{
            background-color: purple;
            color: white;
            border-radius: 5px;
            border: none;
            padding: 5px 15px;
        }
        input {
            border-radius: 3px;
            border: none;
            background-color: lightgray;
            color: gray;
            padding: 5px;
        }
    </style>
</head>
<body>
    <div>
        <h1>Login Page</h1>

        <div>
            <?php 
            if(isset($_GET['message'])){
                if($_GET['message']=="fail"){
                    echo "<div style='background-color:pink; width:25em; padding:10px; border-radius:5px; color:darkred;'>
                    Login failed, try again!</div>";
                }
            }
            ?>
        </div>

        <form method="post">
            <table>
                    <tr><td><label for="username">Username</label></td></tr>
                    <tr><td><input type="text" name="username" id="username" required></td></tr>
                    <tr><td><label for="password">Password</label></td></tr>
                    <tr><td><input type="text" name="password" id="password" required></td></tr>
                    <tr><td><button type="submit">Login</button></td></tr>
            </table>    
        </form>
    </div>
</body>
</html>