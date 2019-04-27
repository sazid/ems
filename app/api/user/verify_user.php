<?php
require_once('../../data/User.php');

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

$users = User::getUserByUsernamePassword($username, $password);

foreach($users->fetchAll() as $user) {
    $data['success'] = true;
    $data['userType'] = $user['type'];

    $_SESSION['loggedIn'] = true;
    $_SESSION['user_id'] = $user['id'];
    $_SESSION['username'] = $user['username'];
}

echo json_encode($data);
