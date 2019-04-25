<?php
require_once('../../data/User.php');

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
$active = htmlspecialchars($_POST['active']);
$name = htmlspecialchars($_POST['name']);

$data = [
    'success' => false,
    'message' => ''
];

if (strlen($email) > 0 and !verify_email($email)) {
    $data['success'] = false;
    $data['message'] = 'Invalid email';
} else {
    try {
        User::insertUser($username, $password, $type, $email, $active, $name);

        $data['success'] = true;
        $data['message'] = 'User added successfully.';
    } catch (PDOException $exc) {
        $data['success'] = false;
        $data['message'] = "Failed to add user.\n$exc";
    }
}

echo json_encode($data);
