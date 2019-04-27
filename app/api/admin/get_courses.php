<?php
require_once('../../data/Course.php');

session_start();

header('Content-Type: application/json;charset=utf-8');

// Filter query
$q = htmlspecialchars($_GET['q']);

$data = [
    'success' => false,
    'courses' => [],
];

$courses = Course::getCourses($q);

$data['success'] = true;
foreach ($courses->fetchAll() as $course) {
    $user_course_map = Course::getUsersForCourse($course['id']);

    $course['users'] = [];
    foreach($user_course_map->fetchAll() as $mapp) {
        array_push($course['users'], $mapp['user_id']);
    }

    array_push($data['courses'], $course);
}

echo json_encode($data);
