<!-- 
  Group Members:
  1. AIN NAJIHA BINTI JUNAIDI (A23CS0038)
  2. MUHAMMAD ZULQARNAIN BIN ALI (A23CS0139)
  3. SIA JUN YI (A23CS0178)
-->

<?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $name = trim($_POST["name"]);
        $email = trim($_POST["email"]);
        $message = trim($_POST["message"]);

        $host = "sql100.infinityfree.com";
        $username = "if0_39233150";     
        $password = "tplj4GhvUkArN";         
        $dbname = "if0_39233150_myass3";   

        // Connect to MySQL
        $conn = new mysqli($host, $username, $password, $dbname);
        
        // Check connection
        if ($conn->connect_error) {
            die("Connect failed: " . $conn->connect_error);
        }

        // Create table if it doesn't exist
        $sql = "CREATE TABLE IF NOT EXISTS ContactMsgs (
            id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            fullname VARCHAR(100) NOT NULL,
            email VARCHAR(100) NOT NULL,
            con_message TEXT NOT NULL, 
            msg_time TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        )";

        if (!$conn->query($sql)) {
            die("Table creation failed: " . $conn->error);
        }

        // Insert data
        $data = "INSERT INTO ContactMsgs (fullname, email, con_message)
                VALUES ('$name', '$email', '$message')";

        if (mysqli_query($conn, $data)) {
            echo "<script>
                    alert('Your message has been sent successfully!');
                    window.history.back();
                </script>";
        } else {
            echo "<script>
                    alert('Error: Unable to send message. :(');
                    window.history.back();
                </script>";
        }

        mysqli_close($conn);
    }
?>
