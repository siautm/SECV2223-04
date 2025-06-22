<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manager Page</title>
</head>
<body>
    <?php 
	session_start();

	// cek apakah yang mengakses halaman ini sudah login
	if($_SESSION['role']==""){
		header("location:login.php?message=fail");
	}
	?>
    
	<h1>Manager Page</h1>

	<p>Welcome <b><?php echo $_SESSION['username']; ?></b>! You are logged in as a <b><?php echo $_SESSION['role']; ?></b>.</p>
	<a href="logout.php">LOGOUT</a>

	<br/>
	<br/>
</body>
</html>