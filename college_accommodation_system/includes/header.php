<?php
// Check and apply theme from cookie
$theme = $_COOKIE['theme'] ?? 'light';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>College Accommodation System</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Link to CSS and JavaScript -->
    <link rel="stylesheet" href="/college_accommodation_system/assets/css/styles.css">
    <script src="/college_accommodation_system/assets/js/script.js" defer></script>
</head>
<body class="<?= htmlspecialchars($_COOKIE['theme'] ?? 'light') ?>">


