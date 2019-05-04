<?php
require_once('../../data/Question.php');

session_start();

header('Content-Type: application/json;charset=utf-8');

// Filter query
$course_id = htmlspecialchars($_GET[ 'course_id']);
$exam_id = htmlspecialchars($_GET['exam_id']);

$data = [
    'success' => false,
    'questions' => [],
    'selected' => []
];

$questions = Question::getQuestionsForCourse($course_id);
$selected = Question::getQuestionsForExam($exam_id);

$data['success'] = true;
foreach ($questions->fetchAll() as $question) {
    array_push($data['questions'], $question);
}

foreach ($selected->fetchAll() as $question) {
    array_push($data['selected'], $question);
}

echo json_encode($data);
