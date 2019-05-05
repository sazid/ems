<?php
// require_once('../../data/Course.php');

session_start();

header('Content-Type: application/json;charset=utf-8');

$target_dir = "../../../uploads/";
$time = time() . ".";
$file_name = $time . strtolower(pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION));
$file_path = $target_dir . $file_name;

$response = [
    'success' => false,
    'file_name' => $file_name
];

if (move_uploaded_file($_FILES['file']['tmp_name'], $file_path)) {
    $response['success'] = true;
}

echo json_encode($response);
