<?php
include_once '../includes/functions.php';

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