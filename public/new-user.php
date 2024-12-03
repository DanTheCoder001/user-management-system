<?php
include_once '../includes/db.php';

$error = $_GET['error'] ?? '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    if ($email === '' || $password === '') {
        header('Location: new-user.php?error=' . urlencode('Please enter email and password.'));
        exit();
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        header('Location: new-user.php?error=' . urlencode('Invalid email format.'));
        exit();
    }
    
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    global $mysqli;
    
    $stmt = $mysqli->prepare("INSERT INTO users (email, password) VALUES (?, ?)");
    
    $stmt->bind_param("ss", $email, $hashed_password);
    
    if ($stmt->execute()) {
        header("Location: dash-board.php");
        exit;
    }

    echo "Error: " . $stmt->error;

    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<?php include '../includes/header.php'; ?>
<body>
<?php include '../includes/nav.php'; ?>
<main>
    <h1>New User Screen</h1>
    <form method="POST" action="new-user.php">
        <label>
            <input type="text" name="email" required>
        </label>
        <label>
            <input type="password" name="password" required>
        </label>
        <input type="submit">
    </form>
    <?php if ($error): ?>
        <p id="error"><?php echo htmlspecialchars($error); ?></p>
    <?php endif; ?>
</main>
<?php include '../includes/footer.php'; ?>
</body>
</html>