<?php
session_start();
include '../includes/auth.php';

if($_SERVER['REQUEST_METHOD'] === 'POST') {
    logout();
}
?>

<!DOCTYPE html>
<html lang="en">
    <?php include '../includes/header.php'; ?>
    <body>
        <?php include '../includes/nav.php'; ?>
        <main>
            <form method="POST" action="dashboard.php">
                <input type="submit" value="Logout" id="submit">
            </form>
        </main>
        <?php include '../includes/footer.php'; ?>
    </body>
</html>