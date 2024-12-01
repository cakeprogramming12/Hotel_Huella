<?php
session_start();
include('includes/config.php');
require('includes/fpdf/fpdf.php');

// Obtener fechas del formulario
$start_date = $_POST['start_date'];
$end_date = $_POST['end_date'];

// Validar fechas
if (!$start_date || !$end_date) {
    die("Por favor, selecciona un rango de fechas válido.");
}

// Obtener datos filtrados por fechas y confirmada = 1
$query = "SELECT id, roomno, feespm, firstName, middleName, lastName, stayfrom, duration, confirmada 
          FROM registration 
          WHERE confirmada = 1 AND stayfrom BETWEEN ? AND ?";
$stmt = $mysqli->prepare($query);
$stmt->bind_param('ss', $start_date, $end_date);
$stmt->execute();
$result = $stmt->get_result();

// Verificar si hay datos
if ($result->num_rows == 0) {
    die("No se encontraron registros para el rango de fechas seleccionado.");
}

// Crear el PDF
$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial', 'B', 16);
$pdf->Cell(0, 10, 'Reporte de Ganancias', 0, 1, 'C');
$pdf->Ln(10);

// Encabezados
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(10, 10, 'ID', 1, 0, 'C');
$pdf->Cell(40, 10, 'Nombre Cliente', 1, 0, 'C');
$pdf->Cell(20, 10, 'Habitacion', 1, 0, 'C');
$pdf->Cell(30, 10, 'Monto (MXN)', 1, 0, 'C');
$pdf->Cell(40, 10, 'Fecha Inicio', 1, 0, 'C');
$pdf->Cell(20, 10, 'Duracion', 1, 1, 'C');

// Datos
$pdf->SetFont('Arial', '', 10);
$total = 0;

while ($row = $result->fetch_object()) {
    $nombre = $row->firstName . ' ' . $row->middleName . ' ' . $row->lastName;
    $pdf->Cell(10, 10, $row->id, 1, 0, 'C');
    $pdf->Cell(40, 10, $nombre, 1, 0, 'C');
    $pdf->Cell(20, 10, $row->roomno, 1, 0, 'C');
    $pdf->Cell(30, 10, number_format($row->feespm, 2), 1, 0, 'C');
    $pdf->Cell(40, 10, $row->stayfrom, 1, 0, 'C');
    $pdf->Cell(20, 10, $row->duration . ' dias', 1, 1, 'C');
    $total += $row->feespm;
}

// Total
$pdf->SetFont('Arial', 'B', 12);
$pdf->Ln(5);
$pdf->Cell(140, 10, 'Total Ganancias:', 0, 0, 'R');
$pdf->Cell(30, 10, number_format($total, 2) . ' MXN', 0, 1, 'C');

// Salida del PDF
$pdf->Output('I', 'reporte_ganancias.pdf');
?>