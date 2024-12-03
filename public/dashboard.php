<?php
include '../includes/user_list.php';

$users = user_list();
?>

<!DOCTYPE html>
<html lang="en">
<?php include '../includes/header.php'; ?>
<body>
<?php include '../includes/nav.php'; ?>
<main>
<h1>Users</h1>
<table>
    <thead>
    <tr>
        <th>ID</th>
        <th>Email</th>
    </tr>
    </thead>
    <tbody>
    <?php if (!empty($users)): ?>
        <?php foreach ($users as $user): ?>
            <tr>
                <td><?php echo htmlspecialchars($user['id']); ?></td>
                <td><?php echo htmlspecialchars($user['email']); ?></td>
            </tr>
        <?php endforeach; ?>
    <?php else: ?>
        <tr>
            <td colspan="2">No users found.</td>
        </tr>
    <?php endif; ?>
    </tbody>
</table>
</main>
<?php include '../includes/footer.php'; ?>
</body>
</html>