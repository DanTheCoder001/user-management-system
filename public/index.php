<?php
include_once '../includes/functions.php';

$error = $_GET['error'] ?? '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    if ($email === '' || $password === '') {
        header('Location: index.php?error=' . urlencode('Please enter email and password.'));
        exit();
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        header('Location: index.php?error=' . urlencode('Invalid email format.'));
        exit();
    }

    if (authenticate($email, $password)) {
        header('Location: dashboard.php');
        exit();
    }

    header('Location: index.php?error=' . urlencode('Invalid email or password.'));
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<?php include '../includes/header.php'; ?>
<body>
<main>
    <div>
        <h1>Login</h1>
        <form method="POST" action="index.php">
            <label>Email:</label>
            <label>
                <input type="email" name="email" id="email" required>
            </label>

            <label>Password:</label>
            <label>
                <input type="password" name="password" required>
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