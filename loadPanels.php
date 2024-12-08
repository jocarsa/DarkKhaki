<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    echo json_encode(['status' => 'error', 'message' => 'Not authenticated']);
    exit;
}

$user_id = $_SESSION['user_id'];
$filename = "panels_{$user_id}.json";

if (!file_exists($filename)) {
    // No panels yet for this user
    echo json_encode(['status' => 'success', 'panels' => []]);
    exit;
}

$panels = json_decode(file_get_contents($filename), true);
if (!is_array($panels)) {
    $panels = [];
}
echo json_encode(['status' => 'success', 'panels' => $panels]);

