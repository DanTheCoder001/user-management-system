<?php
session_start();
include '../includes/auth.php';

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
        header('Location: dash-board.php');
        exit();
    }

    header('Location: index.php?error=' . urlencode('Invalid email or password.'));
    exit();
}

header('Location: index.php');
exit();