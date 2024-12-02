<?php
session_start();
include '../includes/auth.php';

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    logout();
}
?>

<form method="POST" action="dashboard.php">
    <input type="submit" value="Logout" id="submit">
</form>
