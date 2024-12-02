<?php
session_start();
include '../includes/authentication.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $password = $_POST['password'];

    if ($username === '' || $password === '') {
        header('Location: index.php?error=' . urlencode('Please enter username and password.'));
        exit();
    }

    if (authenticate($username, $password)) {
        $_SESSION['username'] = $username;
        header('Location: dashboard.php');
        exit();
    } else {
        header('Location: index.php?error=' . urlencode('Invalid username or password.'));
        exit();
    }
} else {
    header('Location: index.php');
    exit();
}