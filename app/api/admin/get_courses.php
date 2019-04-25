<?php
require_once('../../data/Course.php');

session_start();

header('Content-Type: application/json;charset=utf-8');

// Filter query
$q = htmlspecialchars($_GET['q']);

$data = [
    'success' => false,
    'courses' => []
];

$courses = Course::getCourses($q);

$data['success'] = true;
foreach ($courses->fetchAll() as $user) {
    array_push($data['courses'], $user);
}

echo json_encode($data);
