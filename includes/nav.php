<?php
function logout(): void
{
    session_destroy();
    header('Location: ../public/index.php');
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    logout();
}
?>

<nav>
    <ul>
        <li>
            <form action="nav.php" method="POST">
                <button type="submit">Logout</button>
            </form>
        </li>
    </ul>
</nav>