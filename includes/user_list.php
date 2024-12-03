<?php
include 'db.php';
function user_list() {
    global $mysqli;

    $stmt = $mysqli->prepare("SELECT id, email FROM users");
    $stmt->execute();
    $result = $stmt->get_result();

    $users = [];
    while ($row = $result->fetch_assoc()) {
        $users[] = $row;
    }

    $stmt->close();
    return $users;
}
?>