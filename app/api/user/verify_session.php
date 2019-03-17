<?php
session_start();
header('Content-Type: application/json;charset=utf-8');

// If user is logged in, then send the user details
// otherwise return false

$username = '';

$data = [
    'loggedIn' => false,
    'name' => '',
    'type' => ''
];

if (isset($_SESSION['loggedIn']) and $_SESSION['loggedIn']) {
    $username = $_SESSION['username'];

    $users = simplexml_load_file("users.xml") or die("Error: Failed to load users.");

    foreach ($users->children() as $user) {
        if ($user->username == $username) {
            $data['loggedIn'] = true;
            $data['name'] = (string)$user->name;
            $data['type'] = (string)$user->type;
            break;
        }
    }
}

echo json_encode($data);
