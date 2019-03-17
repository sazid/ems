<?php

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    die("Not allowed");
}

header('Content-Type: application/json;charset=utf-8');

function verify_email($email) {
    $result = false;
    $email = trim($email);
    
    if (strlen($email) == 0) return false;

    $at_pos = strrpos($email, "@");
    $dot_pos = strrpos($email, ".");

    if ($at_pos
        and $dot_pos
        and !strpos($email, "#")
        and $at_pos > 0
        and $dot_pos < strlen($email)-1
        and substr_count($email, "@") == 1) {
            if (substr_count($email, ".") > 1)
                return strpos($email, ".") < $at_pos and $dot_pos > @at_pos;
            return true;
    }
    else
        return false;

    
    return $result;
}

$username = htmlspecialchars($_POST['username']);
$password = htmlspecialchars($_POST['password']);
$email = htmlspecialchars($_POST['email']);
$type = htmlspecialchars($_POST['type']);
$name = htmlspecialchars($_POST['name']);

$data = [
    'success' => false,
    'message' => ''
];

if (strlen($email) > 0 and !verify_email($email)) {
    $data['success'] = false;
    $data['message'] = 'Invalid email';
} else {
    $users= simplexml_load_file("../user/users.xml") or die("Error: Failed to load users.");

    $user = $users->addChild('user');
    $user->addChild('name', $name);
    $user->addChild('username', $username);
    $user->addChild('password', $password);
    $user->addChild('email', $email);
    $user->addChild('type', $type);

    // Save the file
    $users->asXML("../user/users.xml");

    $data['success'] = true;
    $data['message'] = 'User added successfully.';
}

echo json_encode($data);