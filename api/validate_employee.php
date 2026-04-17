<?php
header('Content-Type: application/json');

$employeeId = isset($_GET['id']) ? trim($_GET['id']) : '';

if (empty($employeeId)) {
    echo json_encode(['valid' => false, 'message' => 'Employee number is required']);
    exit;
}

$formatted = strtoupper($employeeId);
if (strpos($formatted, 'EMP-') !== 0) {
    $formatted = 'EMP-' . str_pad($formatted, 3, '0', STR_PAD_LEFT);
}

$dataFile = __DIR__ . '/../data/employees.json';
if (!file_exists($dataFile)) {
    echo json_encode(['valid' => false, 'message' => 'Employee database not found']);
    exit;
}

$employees = json_decode(file_get_contents($dataFile), true);
if (!is_array($employees)) {
    echo json_encode(['valid' => false, 'message' => 'Employee database error']);
    exit;
}

if (!isset($employees[$formatted])) {
    echo json_encode(['valid' => false, 'message' => 'Employee number not found']);
    exit;
}

$emp = $employees[$formatted];

$authorizedPositions = ['Chief Executive Officer', 'IT Supervisor', 'IT Staff'];
$canDownload = in_array($emp['position'], $authorizedPositions);

echo json_encode([
    'valid' => true,
    'employee_id' => $formatted,
    'name' => $emp['name'],
    'department' => $emp['department'],
    'position' => $emp['position'],
    'can_download' => $canDownload,
    'has_pin' => isset($emp['pin']),
    'is_default_pin' => isset($emp['pin']) && $emp['pin'] === '1234'
]);
