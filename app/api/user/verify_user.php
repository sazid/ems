<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    die("Not allowed");
}

header('Content-Type: application/json;charset=utf-8');

$username = htmlspecialchars($_POST['username']);
$password = htmlspecialchars($_POST['password']);

$data = [
    'success' => false,
    'userType' => ''
];

$users= simplexml_load_file("users.xml") or die("Error: Failed to load users.");

// Set the session variables here so that verify_session.php can be used to load
// the current user's info as required
foreach($users->children() as $user) {
    if ($user->username == $username and $user->password == $password) {
        $data['success'] = true;
        $data['userType'] = (string)$user->type;

        $_SESSION['loggedIn'] = true;
        $_SESSION['username'] = (string)$user->username;
        break;
    }
}

echo json_encode($data);
