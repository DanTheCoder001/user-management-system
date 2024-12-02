<?php
$host = 'localhost';
$username = 'root';
$password = '';
$db = 'user_management_system';

$mysqli = new mysqli($host, $username, $password, $db);

if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}