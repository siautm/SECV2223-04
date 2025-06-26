<?php        
    $host = 'sql107.infinityfree.com';
    $user = 'if0_39316356';
    $pass = '0NBD6YpeKFuu2';
    $db = 'if0_39316356_accommodation_system';

    $conn = mysqli_connect($host, $user, $pass, $db);

    if (!$conn) {
        die("Database connection failed: " . mysqli_connect_error());
    }
?>
