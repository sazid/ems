<?php
require_once('../../data/Question.php');

session_start();

header('Content-Type: application/json;charset=utf-8');

// Filter query
$course_id = htmlspecialchars($_GET['course_id']);

$data = [
    'success' => false,
    'questions' => []
];

$questions = Question::getQuestionsForCourse($course_id);

$data['success'] = true;
foreach ($questions->fetchAll() as $question) {
    array_push($data['questions'], $question);
}

echo json_encode($data);
