<?php
session_start();
include '../includes/auth.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    logout();
}
?>

<nav class="flex-center">
    <ul class="flex-center">
        <li>
            <form action="../includes/nav.php" method="POST" class="flex-center">
                <button type="submit">Logout</button>
            </form>
        </li>
    </ul>
</nav>