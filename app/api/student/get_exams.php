<?php
require_once('../../data/Exam.php');

session_start();

header('Content-Type: application/json;charset=utf-8');

// Filter query
$q = htmlspecialchars($_GET['q']);

$data = [
    'success' => false,
    'exams' => [],
];

$exams = Exam::getExamsForUser($q, $_SESSION['user_id']);

$data['success'] = true;
foreach ($exams->fetchAll() as $exam) {
    array_push($data['exams'], $exam);
}

echo json_encode($data);
