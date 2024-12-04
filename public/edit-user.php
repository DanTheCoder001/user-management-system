<?php
include '../includes/user-list.php';

$id = $_GET['id'] ?? null;
$user = $id ? user_info((int)$id) : null;
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
            <form action="update-user.php" method="post">
                <input type="hidden" name="id" value="<?php echo htmlspecialchars($user['id']); ?>">
                <label for="email">Email:</label>
                <input type="email" name="email" value="<?php echo htmlspecialchars($user['email']); ?>" id="email" placeholder="Email address" required>

                <label for="password">Password:</label>
                <input type="password" name="password" id="password" placeholder="Enter a new password">

                <input type="submit" value="Update">
            </form>
        <?php else: ?>
            <p>User not found or invalid ID.</p>
        <?php endif; ?>
    </div>
</main>
<?php include '../includes/footer.php'; ?>
</body>
</html>