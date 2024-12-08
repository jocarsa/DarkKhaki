<?php
session_start();

// If no file, no users
if (!file_exists('users.json')) {
    echo json_encode(['status' => 'error', 'message' => 'No users registered']);
    exit;
}

$data = json_decode(file_get_contents('users.json'), true);
$username = $_POST['username'] ?? '';
$password = $_POST['password'] ?? '';

foreach ($data['users'] as $user) {
    if ($user['username'] === $username && password_verify($password, $user['password_hash'])) {
        $_SESSION['user_id'] = $user['id'];
        echo json_encode(['status' => 'success']);
        exit;
    }
}

echo json_encode(['status' => 'error', 'message' => 'Invalid credentials']);

