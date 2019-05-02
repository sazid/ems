<?php
require_once('../../data/Course.php');

session_start();

header('Content-Type: application/json;charset=utf-8');

$id = htmlspecialchars($_GET['id']);

$data = [
    'success' => false,
    'course' => [],
    'exams' => [],
    'users' => [],
];

$courses = Course::getCourseById($id);
$exams = Course::getExams($id);
$users = Course::getUsers($id, 'student');

$data['success'] = true;

$data['course'] = $courses->fetchAll()[0];

foreach ($exams->fetchAll() as $exam) {
    array_push($data['exams'], $exam);
}

foreach ($users->fetchAll() as $user) {
    $user['password'] = '';
    array_push($data['users'], $user);
}

echo json_encode($data);
