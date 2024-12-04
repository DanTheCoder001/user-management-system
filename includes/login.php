<?php
function authenticate($email, $password): bool
{
    global $mysqli;

    $stmt = $mysqli->prepare("SELECT id, email, password FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($id, $stored_email, $stored_password);
        $stmt->fetch();

        if (password_verify($password, $stored_password)) {
            session_start();
            $_SESSION['user_id'] = $id;
            $_SESSION['email'] = $stored_email;
            return true;
        }
    }

    return false;
}

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

header('Location: index.php');
exit();