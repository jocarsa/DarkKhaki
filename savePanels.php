<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    echo json_encode(['status' => 'error', 'message' => 'Not authenticated']);
    exit;
}

$user_id = $_SESSION['user_id'];
$input = json_decode(file_get_contents('php://input'), true);
$panels = $input['panels'] ?? [];

$filename = "panels_{$user_id}.json";
file_put_contents($filename, json_encode($panels, JSON_PRETTY_PRINT));

echo json_encode(['status' => 'success']);

