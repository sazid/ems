<?php
require_once('../../data/User.php');

session_start();
header('Content-Type: application/json;charset=utf-8');

// If user is logged in, then send the user details
// otherwise return false

$data = [
    'loggedIn' => false,
    'name' => '',
    'type' => ''
];

if (isset($_SESSION['loggedIn']) and $_SESSION['loggedIn']) {
    $username = $_SESSION['username'];
    $users = User::getUserByUsername($username);

    foreach ($users->fetchAll() as $user) {
        $data['loggedIn'] = true;
        $data['name'] = $user['name'];
        $data['type'] = $user['type'];
    }
}

echo json_encode($data);
