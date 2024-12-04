<?php
include 'db.php';
function user_list(): array
{
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

function user_info(int $id): array {
    global $mysqli;

    $stmt = $mysqli->prepare("SELECT id, email FROM users WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    // Fetch a single record
    $user = $result->fetch_assoc();

    $stmt->close();
    return $user ?: []; // Return an empty array if no user is found
}
