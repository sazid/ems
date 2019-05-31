<?php
session_start();
require_once('../../data/Submission.php');

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    die("Not allowed");
}

header('Content-Type: application/json;charset=utf-8');

$submissions = $_POST['submissions'];

$data = [
    'success' => false,
    'message' => '',
];

try {
    for ($i = 0; $i < count($submissions); ++$i) {
        $s = $submissions[$i];
        $s['user_id'] = $_SESSION['user_id'];
        Submission::insertSubmission(
            $s['type'],
            $s['value'],
            date('Y-m-d H:i:s'),
            $s['user_id'],
            $s['question_id'],
            $s['exam_id']
        );
    }

    $data['success'] = true;
    $data['message'] = 'Submission successful.';
} catch (PDOException $exc) {
    $data['success'] = false;
    $data['message'] = "Failed to save question.$exc";
}

echo json_encode($data);
