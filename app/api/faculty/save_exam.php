<?php
require_once('../../data/Exam.php');

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    die("Not allowed");
}

header('Content-Type: application/json;charset=utf-8');

$id = htmlspecialchars($_POST['id']);
$name = htmlspecialchars($_POST['name']);
$start = htmlspecialchars($_POST['start']);
$end = htmlspecialchars($_POST['end']);
$course_id = htmlspecialchars($_POST['course_id']);
$questions = $_POST['questions'];

$data = [
    'success' => false,
    'message' => '',
    'id' => $id,
];


try {
    if ($id == -1) {
        $result = Exam::insertExam($name, $start, $end, $course_id, $questions);
        $data['id'] = $result['last_insert_id'];
    } else {
        Exam::updateExam($id, $name, $start, $end, $course_id);
        Exam::updateQuestions($id, $questions);
    }

    $data['success'] = true;
    $data['message'] = 'Exam saved successfully.';
} catch (PDOException $exc) {
    $data['success'] = false;
    $data['message'] = "Failed to save exam.$exc";
}

echo json_encode($data);
