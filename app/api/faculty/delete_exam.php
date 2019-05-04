<?php
require_once('../../data/Exam.php');

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    die("Not allowed");
}

header('Content-Type: application/json;charset=utf-8');

$id = htmlspecialchars($_POST['id']);

$data = [
    'success' => false,
    'message' => '',
    'id' => $id,
];


try {
    Exam::deleteExam($id);

    $data['success'] = true;
    $data['message'] = 'Exam deleted successfully.';
} catch (PDOException $exc) {
    $data['success'] = false;
    $data['message'] = "Failed to delete exam.$exc";
}

echo json_encode($data);
