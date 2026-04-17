<?php
session_start();
header('Content-Type: application/json');

if (!isset($_SESSION['can_download']) || $_SESSION['can_download'] !== true) {
    http_response_code(403);
    echo json_encode(['error' => 'Access denied. Only authorized personnel can download records.']);
    exit;
}

$dataFile = __DIR__ . '/../data/records.json';

if (!file_exists($dataFile)) {
    echo json_encode([]);
    exit;
}

$content = file_get_contents($dataFile);
$records = json_decode($content, true);

if (!is_array($records)) {
    echo json_encode([]);
    exit;
}

echo json_encode($records);
