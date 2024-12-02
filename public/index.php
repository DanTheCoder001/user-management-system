<?php
session_start();
if (isset($_SESSION['username'])) {
    header('Location: dashboard.php');
    exit();
}

$error = isset($_GET['error']) ? $_GET['error'] : '';
?>
<!DOCTYPE html>
<html lang="en">
<?php include '../includes/header.php'; ?>
<body>
<main>
    <div class="login flex-center">
        <h1>Login</h1>
        <form method="POST" action="login.php" class="flex-center">
            <label>Username:</label>
            <label>
                <input type="text" name="username" id="username" required class="login-input">
            </label>

            <label>Password:</label>
            <label>
                <input type="password" name="password" required class="login-input">
            </label>

            <?php if ($error): ?>
                <p id="error"><?php echo htmlspecialchars($error); ?></p>
            <?php endif; ?>

            <input type="submit" value="Login" id="submit">
        </form>
    </div>
</main>
<?php include '../includes/footer.php'; ?>
<script>
    window.onload = function() {
        document.getElementById("username").focus();
    };
</script>
</body>
</html>