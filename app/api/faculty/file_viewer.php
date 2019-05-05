<?php
header('Content-Type: application/json;charset=utf-8');

$response = [
    'content' => ''
];

$response['content'] = file_get_contents("../../../uploads/code.cpp");

echo json_encode($response);
