<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();
echo "Reached process_review.phppp<br>";

include('../includes/auth_check.php');
include('../database/db_connect.php');


if (isset($_GET['id']) && isset($_GET['action'])) {
    $app_id = intval($_GET['id']);
    $action = $_GET['action'];

    if ($action === 'approve') {
        $status = 'approved';
    } elseif ($action === 'reject') {
        $status = 'rejected';
    } else {
        echo "Invalid action.";
        exit;
    }

    $query = "UPDATE application SET status = ? WHERE id = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "si", $status, $app_id);
    mysqli_stmt_execute($stmt);

    header("Location: /college_accommodation_system/manager/review_application.php");
    exit();
} else {
    echo "Missing parameters.";
}

