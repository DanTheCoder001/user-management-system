<?php
include 'db.php';

function authenticate($email, $password)
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

function logout()
{
    session_destroy();
    header('Location: ../public/index.php');
}