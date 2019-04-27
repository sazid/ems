<?php
require_once('../../data/Course.php');

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    die("Not allowed");
}

header('Content-Type: application/json;charset=utf-8');

$id = htmlspecialchars( $_POST['id']);
$active = htmlspecialchars($_POST['active']);
$name = htmlspecialchars($_POST['name']);
$code = htmlspecialchars($_POST['code']);

$data = [
    'success' => false,
    'message' => '',
    'id' => $id,
];


try {
    if ($id == -1) {
        $result = Course::insertCourse($name, $code, $active);
        $data['id'] = $result['last_insert_id'];
    } else {
        Course::updateCourse($id, $name, $code, $active);
    }

    $data['success'] = true;
    $data['message'] = 'Course saved successfully.';
} catch (PDOException $exc) {
    $data['success'] = false;
    $data['message'] = "Failed to save course.$exc";
}

echo json_encode($data);
