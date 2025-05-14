<?php
session_start();
// Redirect to login page if not logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
// Redirect to dashboard
header("Location: dashboard.php");
exit();
?>
