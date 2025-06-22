<?php
    $host = 'localhost';#"sql100.infinityfree.com";
    $username = 'root';#"if0_39233150";     
    $password = '';#"tplj4GhvUkArN";         
    $dbname = 'accommodation_college';#"if0_39233150_myass3"; 

    // Create connection
    $conn = new mysqli($host, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

?>