<?php
session_start();

if (!isset($_SESSION['can_download']) || $_SESSION['can_download'] !== true) {
    http_response_code(403);
    echo 'Access denied.';
    exit;
}

$dataFile = __DIR__ . '/../data/records.json';
$employeesFile = __DIR__ . '/../data/employees.json';

$records = [];
if (file_exists($dataFile)) {
    $records = json_decode(file_get_contents($dataFile), true) ?: [];
}

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
            if (empty($r['employee_name'])) {
                $r['employee_name'] = $employees[$empId]['name'];
            }
        } else {
            $r['department'] = '';
            $r['position'] = '';
        }
    }
}
unset($r);

$xmlHeader = '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
$xmlHeader .= '<?mso-application progid="Excel.Sheet"?>' . "\n";

$xml = $xmlHeader;
$xml .= '<Workbook xmlns="urn:schemas-microsoft-com:office:spreadsheet"
 xmlns:o="urn:schemas-microsoft-com:office:office"
 xmlns:x="urn:schemas-microsoft-com:office:excel"
 xmlns:ss="urn:schemas-microsoft-com:office:spreadsheet">
<Styles>
 <Style ss:ID="Default">
  <Font ss:FontName="Calibri" ss:Size="11"/>
 </Style>
 <Style ss:ID="Title">
  <Font ss:FontName="Calibri" ss:Size="14" ss:Bold="1" ss:Color="#FFFFFF"/>
  <Interior ss:Color="#0D9488" ss:Pattern="Solid"/>
  <Alignment ss:Horizontal="Center" ss:Vertical="Center"/>
 </Style>
 <Style ss:ID="Header">
  <Font ss:FontName="Calibri" ss:Size="11" ss:Bold="1" ss:Color="#FFFFFF"/>
  <Interior ss:Color="#14B8A6" ss:Pattern="Solid"/>
  <Alignment ss:Horizontal="Center" ss:Vertical="Center"/>
  <Borders>
   <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="1" ss:Color="#0D9488"/>
   <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Weight="1" ss:Color="#0D9488"/>
   <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="1" ss:Color="#0D9488"/>
   <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Weight="1" ss:Color="#0D9488"/>
  </Borders>
 </Style>
 <Style ss:ID="Data">
  <Font ss:FontName="Calibri" ss:Size="11"/>
  <Alignment ss:Vertical="Center"/>
  <Borders>
   <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="1" ss:Color="#E5E7EB"/>
   <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Weight="1" ss:Color="#E5E7EB"/>
   <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="1" ss:Color="#E5E7EB"/>
  </Borders>
 </Style>
 <Style ss:ID="DataAlt">
  <Font ss:FontName="Calibri" ss:Size="11"/>
  <Interior ss:Color="#F0FDFA" ss:Pattern="Solid"/>
  <Alignment ss:Vertical="Center"/>
  <Borders>
   <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="1" ss:Color="#E5E7EB"/>
   <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Weight="1" ss:Color="#E5E7EB"/>
   <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="1" ss:Color="#E5E7EB"/>
  </Borders>
 </Style>
 <Style ss:ID="Footer">
  <Font ss:FontName="Calibri" ss:Size="9" ss:Italic="1" ss:Color="#999999"/>
  <Alignment ss:Horizontal="Center"/>
 </Style>
</Styles>
<Worksheet ss:Name="Policy Records">
 <Table ss:DefaultRowHeight="20">
  <Column ss:Width="30"/>
  <Column ss:Width="130"/>
  <Column ss:Width="80"/>
  <Column ss:Width="120"/>
  <Column ss:Width="200"/>
  <Column ss:Width="180"/>
  <Column ss:Width="220"/>
';

$xml .= '  <Row ss:Height="35">
   <Cell ss:MergeAcross="6" ss:StyleID="Title"><Data ss:Type="String">Brand Soluxions Inc. - Policy Acknowledgment Records</Data></Cell>
  </Row>' . "\n";

$xml .= '  <Row ss:Height="25">
   <Cell ss:StyleID="Header"><Data ss:Type="String">#</Data></Cell>
   <Cell ss:StyleID="Header"><Data ss:Type="String">Date</Data></Cell>
   <Cell ss:StyleID="Header"><Data ss:Type="String">Time</Data></Cell>
   <Cell ss:StyleID="Header"><Data ss:Type="String">Employee No.</Data></Cell>
   <Cell ss:StyleID="Header"><Data ss:Type="String">Employee Name</Data></Cell>
   <Cell ss:StyleID="Header"><Data ss:Type="String">Department</Data></Cell>
   <Cell ss:StyleID="Header"><Data ss:Type="String">Position</Data></Cell>
  </Row>' . "\n";

$rowNum = 1;
foreach ($records as $r) {
    $style = ($rowNum % 2 === 0) ? 'DataAlt' : 'Data';
    $name = htmlspecialchars($r['employee_name'] ?? '', ENT_XML1);
    $dept = htmlspecialchars($r['department'] ?? '', ENT_XML1);
    $pos = htmlspecialchars($r['position'] ?? '', ENT_XML1);
    $empNo = htmlspecialchars($r['employee_number'] ?? '', ENT_XML1);
    $date = htmlspecialchars($r['date'] ?? '', ENT_XML1);
    $time = htmlspecialchars($r['time'] ?? '', ENT_XML1);

    $xml .= '  <Row ss:Height="22">';
    $xml .= '<Cell ss:StyleID="' . $style . '"><Data ss:Type="Number">' . $rowNum . '</Data></Cell>';
    $xml .= '<Cell ss:StyleID="' . $style . '"><Data ss:Type="String">' . $date . '</Data></Cell>';
    $xml .= '<Cell ss:StyleID="' . $style . '"><Data ss:Type="String">' . $time . '</Data></Cell>';
    $xml .= '<Cell ss:StyleID="' . $style . '"><Data ss:Type="String">' . $empNo . '</Data></Cell>';
    $xml .= '<Cell ss:StyleID="' . $style . '"><Data ss:Type="String">' . $name . '</Data></Cell>';
    $xml .= '<Cell ss:StyleID="' . $style . '"><Data ss:Type="String">' . $dept . '</Data></Cell>';
    $xml .= '<Cell ss:StyleID="' . $style . '"><Data ss:Type="String">' . $pos . '</Data></Cell>';
    $xml .= '</Row>' . "\n";
    $rowNum++;
}

$xml .= '  <Row><Cell/></Row>' . "\n";
$xml .= '  <Row>
   <Cell ss:MergeAcross="6" ss:StyleID="Footer"><Data ss:Type="String">Generated on ' . date('F d, Y \a\t h:i A') . ' | Brand Soluxions Inc.</Data></Cell>
  </Row>' . "\n";

$xml .= ' </Table>
</Worksheet>
</Workbook>';

$filename = 'Policy_Records_' . date('Y-m-d') . '.xls';
header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment; filename="' . $filename . '"');
header('Cache-Control: max-age=0');

echo $xml;
