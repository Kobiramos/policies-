<?php
session_start();
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['success' => false, 'message' => 'Invalid request method']);
    exit;
}

if (!isset($_SESSION['employee_number'])) {
    echo json_encode(['success' => false, 'message' => 'Not logged in']);
    exit;
}

$empId = $_SESSION['employee_number'];
$currentPin = isset($_POST['current_pin']) ? trim($_POST['current_pin']) : '';
$newPin = isset($_POST['new_pin']) ? trim($_POST['new_pin']) : '';
$confirmPin = isset($_POST['confirm_pin']) ? trim($_POST['confirm_pin']) : '';

if (empty($currentPin)) {
    echo json_encode(['success' => false, 'message' => 'Current PIN is required']);
    exit;
}

if (empty($newPin)) {
    echo json_encode(['success' => false, 'message' => 'New PIN is required']);
    exit;
}

if (!preg_match('/^\d{4,6}$/', $newPin)) {
    echo json_encode(['success' => false, 'message' => 'New PIN must be 4-6 digits']);
    exit;
}

if ($newPin !== $confirmPin) {
    echo json_encode(['success' => false, 'message' => 'New PIN and confirmation do not match']);
    exit;
}

if ($currentPin === $newPin) {
    echo json_encode(['success' => false, 'message' => 'New PIN must be different from current PIN']);
    exit;
}

$dataFile = __DIR__ . '/../data/employees.json';
if (!file_exists($dataFile)) {
    echo json_encode(['success' => false, 'message' => 'Employee database not found']);
    exit;
}

$employees = json_decode(file_get_contents($dataFile), true);
if (!is_array($employees) || !isset($employees[$empId])) {
    echo json_encode(['success' => false, 'message' => 'Employee not found']);
    exit;
}

$storedPin = isset($employees[$empId]['pin']) ? $employees[$empId]['pin'] : '1234';
if ($currentPin !== $storedPin) {
    echo json_encode(['success' => false, 'message' => 'Current PIN is incorrect']);
    exit;
}

$employees[$empId]['pin'] = $newPin;

$result = file_put_contents($dataFile, json_encode($employees, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
if ($result === false) {
    echo json_encode(['success' => false, 'message' => 'Failed to save new PIN. Please try again.']);
    exit;
}

$_SESSION['is_default_pin'] = ($newPin === '1234');

echo json_encode(['success' => true, 'message' => 'PIN changed successfully']);
