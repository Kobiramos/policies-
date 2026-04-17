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

$employeesFile = __DIR__ . '/../data/employees.json';
$employees = [];
if (file_exists($employeesFile)) {
    $employees = json_decode(file_get_contents($employeesFile), true) ?: [];
}

foreach ($records as &$r) {
    if (empty($r['department']) || empty($r['position'])) {
        $empId = isset($r['employee_number']) ? strtoupper($r['employee_number']) : '';
        if (strpos($empId, 'EMP-') !== 0 && is_numeric($empId)) {
            $empId = 'EMP-' . str_pad($empId, 3, '0', STR_PAD_LEFT);
        }
        if (isset($employees[$empId])) {
            $r['department'] = $employees[$empId]['department'];
            $r['position'] = $employees[$empId]['position'];
            if (empty($r['employee_name']) || $r['employee_name'] === '') {
                $r['employee_name'] = $employees[$empId]['name'];
            }
        } else {
            $r['department'] = '';
            $r['position'] = '';
        }
    }
}
unset($r);

echo json_encode($records);
