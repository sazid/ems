<?php
require_once('../../data/User.php');

session_start();

header('Content-Type: application/json;charset=utf-8');

// Filter query
$q = htmlspecialchars($_GET['q']);
$type = htmlspecialchars($_GET['type']);

$data = [
    'success' => false,
    'users' => []
];

$users = User::getUsers($q, $type);

$data['success'] = true;
foreach ($users->fetchAll() as $user) {
    $user['password'] = '';
    array_push($data['users'], $user);
}

echo json_encode($data);
