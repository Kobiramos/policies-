<?php
session_start();
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['success' => false, 'message' => 'Invalid request method']);
    exit;
}

$employee_number = isset($_POST['employee_number']) ? trim($_POST['employee_number']) : '';

if (empty($employee_number)) {
    echo json_encode(['success' => false, 'message' => 'Employee number is required']);
    exit;
}

$formatted = strtoupper($employee_number);
if (strpos($formatted, 'EMP-') !== 0) {
    $formatted = 'EMP-' . str_pad($formatted, 3, '0', STR_PAD_LEFT);
}

$employeesFile = __DIR__ . '/../data/employees.json';
if (!file_exists($employeesFile)) {
    echo json_encode(['success' => false, 'message' => 'Employee database not available']);
    exit;
}

$employees = json_decode(file_get_contents($employeesFile), true);
if (!is_array($employees) || !isset($employees[$formatted])) {
    echo json_encode(['success' => false, 'message' => 'Employee number not found in our records']);
    exit;
}

$emp = $employees[$formatted];
$employee_name = $emp['name'];

$pin = isset($_POST['pin']) ? trim($_POST['pin']) : '';
if (empty($pin)) {
    echo json_encode(['success' => false, 'pin_error' => true, 'message' => 'Please enter your PIN']);
    exit;
}

$storedPin = isset($emp['pin']) ? $emp['pin'] : '1234';
if ($pin !== $storedPin) {
    echo json_encode(['success' => false, 'pin_error' => true, 'message' => 'Incorrect PIN']);
    exit;
}

$dataDir = __DIR__ . '/../data';
$dataFile = $dataDir . '/records.json';

if (!is_dir($dataDir)) {
    mkdir($dataDir, 0755, true);
}

$records = [];
if (file_exists($dataFile)) {
    $content = file_get_contents($dataFile);
    $records = json_decode($content, true);
    if (!is_array($records)) {
        $records = [];
    }
}

date_default_timezone_set('Asia/Manila');

$record = [
    'date' => date('F d, Y'),
    'time' => date('h:i A'),
    'employee_number' => $formatted,
    'employee_name' => $employee_name,
    'department' => $emp['department'],
    'position' => $emp['position']
];

$records[] = $record;

$result = file_put_contents($dataFile, json_encode($records, JSON_PRETTY_PRINT));

if ($result === false) {
    echo json_encode(['success' => false, 'message' => 'Failed to save record. Please try again.']);
    exit;
}

$authorizedPositions = ['Chief Executive Officer', 'IT Supervisor', 'IT Staff'];
$canDownload = in_array($emp['position'], $authorizedPositions);

$_SESSION['employee_name'] = $employee_name;
$_SESSION['employee_number'] = $formatted;
$_SESSION['employee_department'] = $emp['department'];
$_SESSION['employee_position'] = $emp['position'];
$_SESSION['can_download'] = $canDownload;
$_SESSION['is_default_pin'] = ($storedPin === '1234');

echo json_encode(['success' => true, 'message' => 'Record saved successfully']);
