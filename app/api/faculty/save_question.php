<?php
require_once('../../data/Question.php');

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    die("Not allowed");
}

header('Content-Type: application/json;charset=utf-8');

$id = htmlspecialchars( $_POST['id']);
$title = htmlspecialchars($_POST['title']);
$type = htmlspecialchars($_POST['type']);
$course_id = htmlspecialchars($_POST['course_id']);
$mcq_options = $_POST['mcq_options'];

$data = [
    'success' => false,
    'message' => '',
    'id' => $id,
];


try {
    if ($id == -1) {
        $result = Question::insertQuestion($title, $type, $mcq_options, $course_id);
        $data['id'] = $result['last_insert_id'];
    } else {
        Question::updateQuestion($id, $title, $type, $mcq_options, $course_id);
    }

    $data['success'] = true;
    $data['message'] = 'Question saved successfully.';
} catch (PDOException $exc) {
    $data['success'] = false;
    $data['message'] = "Failed to save question.$exc";
}

echo json_encode($data);
