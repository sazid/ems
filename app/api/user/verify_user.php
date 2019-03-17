<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    die("Not allowed");
}

header('Content-Type: application/json;charset=utf-8');

$username = $_POST['username'];
$password = $_POST['password'];

$data = [
    'success' => false,
    'name' => '',
    'type' => ''
];

$users= simplexml_load_file("users.xml") or die("Error: Failed to load users.");

foreach($users->children() as $user) {
    if ($user->username == $username and $user->password == $password) {
        $data['success'] = true;
        $data['name'] = (string)$user->name;
        $data['type'] = (string)$user->type;

        $_SESSION['username'] = (string)$user->username;
        $_SESSION['loggedIn'] = true;
        
        break;
    }
}

echo json_encode($data);
