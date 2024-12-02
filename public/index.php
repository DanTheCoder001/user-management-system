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

    if ($username === '' || $password === '') {
        $error = 'Please enter username and password';
    }
    else {
        if (authenticate($username, $password)) {
            $_SESSION['username'] = $username;
            header('Location: dashboard.php');
            exit();
        }

        $error = "Invalid username or password.";
    }

    echo '<script>
        window.onload = function() {
            document.getElementById("username").focus();
        };
    </script>';
}
?>

<!DOCTYPE html>
<html lang="en">
<?php include '../includes/header.php'; ?>
<body>
<main>
    <div class="login flex-center">
        <h1>Login</h1>
        <form method="POST" action="index.php" class="flex-center">
            <label>Username:</label>
            <label>
                <input type="text" name="username" id="username" required class="login-input">
            </label>

            <label>Password:</label>
            <label>
                <input type="password" name="password" required class="login-input">
            </label>

            <?php if ($error): ?>
                <p id="error"><?php echo $error; ?></p>
            <?php endif; ?>

            <input type="submit" value="Login" id="submit">
        </form>
    </div>
</main>
<?php include '../includes/footer.php'; ?>
</body>
</html>