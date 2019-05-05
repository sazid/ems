<?php
require_once('../../data/Exam.php');
require_once('../../data/Question.php');

session_start();

header('Content-Type: application/json;charset=utf-8');

// Filter query
$exam_id = htmlspecialchars($_GET['exam_id']);

$data = [
    'success' => false,
    'exam' => [],
    'questions' => [],
];

$data['success'] = true;

$data['exam'] = Exam::getExamById($exam_id)->fetchAll()[0];

$questions = Question::getQuestionsForExam($exam_id);

foreach ($questions->fetchAll() as $question) {
    $question['options'] = [];

    $options = Question::getAnswerForQuestion($question['id']);
    foreach ($options->fetchAll() as $option) {
        array_push($question['options'], $option);
    }

    array_push($data['questions'], $question);
}

echo json_encode($data);
