<?php
    ##RUN PAGE NI ONCE ONLY

    $host = 'localhost';
    $username = 'root'; 
    $password = ''; 

    // Create connection
    $conn = new mysqli($host, $username, $password);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    #create database
    $sql = "CREATE DATABASE accommodation_college";

    if(mysqli_query($conn, $sql)){
        echo "Database created successfully!";
    } else {
        echo "Error creating database: ". mysqli_error($conn);
    }

    #create table
    $sql = "CREATE TABLE 'users' (
            'id' varchar(6) NOT NULL PRIMARY KEY,
            'fullname' varchar(255) NOT NULL,
            'username' varchar(50) NOT NULL UNIQUE KEY,
            'password' varchar(50) NOT NULL,
            'role' enum('admin','student','manager') NOT NULL
            )"; 

    if(mysqli_query($conn, $sql)){
        echo "Table users created successfully!";
    } else {
        echo "Error creating table: ". mysqli_error($conn);
    }

    #insert example value
    $sql = "INSERT INTO 'users' ('id', 'fullname', 'username', 'password', 'role') VALUES
            ('A01', 'Zakri', 'zakri', 'pwadmin', 'admin'),
            ('M01', 'Shida', 'shida', 'pwmanager', 'manager'),
            ('S01', 'Ali', 'ali', 'pwstudent', 'student')";

    if (mysqli_query($conn, $sql)){
        echo "New records created successfully!";
    } else {
        echo "Error: ". $sql . "<br>" . mysqli_error($conn);
    }

    #closing connection
    mysqli_close($conn);
?>

