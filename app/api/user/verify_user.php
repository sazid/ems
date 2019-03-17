<?php

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    die("Not allowed");
}

header('Content-Type: application/json');
$data = [
    'success' => false,
    'name' => '',
    'type' => ''
];

$users= simplexml_load_file("users.xml") or die("Error: Failed to load users.");

foreach($users->children() as $user) {
    if ($user->username == $_POST['username'] and $user->password == $_POST['password']) {
        $data['success'] = true;
        $data['name'] = ($user->name)[0];
        $data['type'] = $user->type;
        break;
    }
}

echo json_encode($data);
