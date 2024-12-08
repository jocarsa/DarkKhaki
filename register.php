<?php
if (!file_exists('users.json')) {
    file_put_contents('users.json', json_encode(['users' => [], 'last_user_id' => 0], JSON_PRETTY_PRINT));
}

$data = json_decode(file_get_contents('users.json'), true);

$username = $_POST['username'] ?? '';
$password = $_POST['password'] ?? '';

if ($username === '' || $password === '') {
    echo json_encode(['status' => 'error', 'message' => 'Username and password required']);
    exit;
}

// Check if user exists
foreach ($data['users'] as $user) {
    if ($user['username'] === $username) {
        echo json_encode(['status' => 'error', 'message' => 'User already exists']);
        exit;
    }
}

$data['last_user_id']++;
$newUser = [
    'id' => $data['last_user_id'],
    'username' => $username,
    'password_hash' => password_hash($password, PASSWORD_BCRYPT)
];
$data['users'][] = $newUser;

file_put_contents('users.json', json_encode($data, JSON_PRETTY_PRINT));

echo json_encode(['status' => 'success']);

