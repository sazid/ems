<?php
session_start();
require_once('../../data/Question.php');

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    die("Not allowed");
}

header('Content-Type: application/json;charset=utf-8');

$submissions = $_POST['submissions'];

$data = [
    'success' => false,
    'message' => '',
];

for ($i = 0; $i < count($submissions); ++$i) {
    $submissions[$i]['user_id'] = $_SESSION['user_id'];
}

// try {
//     if ($id == -1) {
//         $result = Question::insertQuestion($title, $type, $mcq_options, $course_id);
//         $data['id'] = $result['last_insert_id'];
//     } else {
//         Question::updateQuestion($id, $title, $type, $mcq_options, $course_id);
//     }

//     $data['success'] = true;
//     $data['message'] = 'Question saved successfully.';
// } catch (PDOException $exc) {
//     $data['success'] = false;
//     $data['message'] = "Failed to save question.$exc";
// }

echo json_encode($data);
