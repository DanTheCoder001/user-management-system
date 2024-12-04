<?php
session_start();
if (isset($_SESSION['email'])) {
    header('Location: dashboard.php');
    exit();
}

$error = $_GET['error'] ?? '';
?>
<!DOCTYPE html>
<html lang="en">
<?php include '../includes/header.php'; ?>
<body>
<main>
    <div class="login flex-center">
        <h1>Login</h1>
        <form method="POST" action="../includes/login.php" class="flex-center">
            <label>Email:</label>
            <label>
                <input type="email" name="email" id="email" required class="login-input">
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
</body>
</html>