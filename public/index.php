<?php
session_start();
include '../includes/auth.php';

if (isset($_SESSION['username'])) {
    header('Location: dashboard.php');
    exit();
}

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    if (authenticate($username, $password)) {
        $_SESSION['username'] = $username;
        header('Location: dashboard.php');
        exit();
    }

    $error = "Invalid username or password.";
}
?>

<!DOCTYPE html>
<html lang="en">
<?php include '../includes/header.php'; ?>
    <body>
        <main>
            <div class="login">
                <h1>Login</h1>
                <?php if ($error): ?>
                    <p id="error"><?php echo $error; ?></p>
                <?php endif; ?>

                <form method="POST" action="index.php">
                    <label>Username:</label>
                    <label>
                        <input type="text" name="username" required class="login-input">
                    </label>

                    <label>Password:</label>
                    <label>
                        <input type="password" name="password" required class="login-input">
                    </label>

                    <input type="submit" value="Login" id="submit">
                </form>
            </div>
        </main>
        <?php include '../includes/footer.php'; ?>
    </body>
</html>