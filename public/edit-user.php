<?php
include_once '../includes/database.php';

$id = $_GET['id'] ?? null;
$error = $_GET['error'] ?? '';

global $mysqli;

$stmt = $mysqli->prepare("SELECT id, email FROM users WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

$user = $result->fetch_assoc();

$stmt->close();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    if ($email === '' || $password === '') {
        header('Location: edit-user.php?error=' . urlencode('Please enter email and password.'));
        exit();
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        header('Location: edit-user.php?error=' . urlencode('Invalid email format.'));
        exit();
    }

    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    global $mysqli;

    try {
        $stmt = $mysqli->prepare("UPDATE users SET email = ?, password = ? WHERE id = ?");
        if (!$stmt) {
            throw new mysqli_sql_exception("Failed to prepare the statement: " . $mysqli->error);
        }

        $stmt->bind_param("ssi", $email, $hashed_password, $id);
        $stmt->execute();

        if ($stmt->affected_rows === 0) {
            // Optionally handle cases where the update didn't modify any rows.
            throw new mysqli_sql_exception("No rows updated. User ID might not exist.");
        }

        header("Location: dashboard.php");
        exit();
    } catch (mysqli_sql_exception $e) {
        // Log the error for debugging (do not expose detailed errors to users in production).
        error_log("Database error: " . $e->getMessage());

        // Optionally, display a user-friendly error message.
        echo "There was a problem updating your information. Please try again later.";
    } finally {
        $stmt?->close();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<?php include '../includes/header.php'; ?>
<body>
<?php include '../includes/nav.php'; ?>
<main>
    <h1>Edit User</h1>
    <div class="container">
        <?php if ($user): ?>
            <form action="edit-user.php" method="post">
                <label for="email">Email:</label>
                <input type="email" name="email" value="<?php echo htmlspecialchars($user['email']); ?>" id="email" 
                       placeholder="Email address" required>

                <label for="password">Password:</label>
                <input type="password" name="password" id="password" placeholder="Enter a new password" required>

                <input type="submit" value="Update">
            </form>
        <?php else: ?>
            <p>User not found or invalid ID.</p>
        <?php endif; ?>
        <?php if ($error): ?>
            <p id="error"><?php echo htmlspecialchars($error); ?></p>
        <?php endif; ?>
    </div>
</main>
<?php include '../includes/footer.php'; ?>
</body>
</html>