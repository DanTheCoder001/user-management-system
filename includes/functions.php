<?php
include_once 'database.php';

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

function userList() : array {
    $users = [];

    global $mysqli;

    $stmt = $mysqli->prepare("SELECT id, email FROM users");
    $stmt->execute();
    $result = $stmt->get_result();

    while ($row = $result->fetch_assoc()) {
        $users[] = $row;
    }

    $stmt->close();
    return $users;
}

function logout(): void
{
    session_destroy();
    header('Location: ../public/index.php');
}