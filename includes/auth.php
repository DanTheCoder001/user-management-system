<?php
function authenticate($username, $password)
{
    return $username == 'Daniel' && $password == 'PHPForTheWin!';
}

function logout()
{
    session_destroy();
    header('Location: ../public/index.php');
}