<?php
session_start();
include('includes/config.php');
require('includes/fpdf/fpdf.php');

// Obtener datos del usuario
$aid = $_SESSION['login'];
$ret = "SELECT * FROM registration WHERE emailid=?";
$stmt = $mysqli->prepare($ret);
$stmt->bind_param('s', $aid);
$stmt->execute();
$res = $stmt->get_result();
$row = $res->fetch_object();

if (!$row) {
    die('Datos no encontrados.');
}

// Obtener el tipo de habitación desde la tabla rooms
$room_type_query = "SELECT room_type FROM rooms WHERE room_no=?";
$room_stmt = $mysqli->prepare($room_type_query);
$room_stmt->bind_param('s', $row->roomno);
$room_stmt->execute();
$room_res = $room_stmt->get_result();
$room_data = $room_res->fetch_object();
$room_type = $room_data->room_type;

// Crear el PDF
$pdf = new FPDF();
$pdf->AddPage();

// Agregar logo
$pdf->Image('img/logofactura.png', 10, 10, 30); // Ruta del logo, posición x, posición y, tamaño
$pdf->SetFont('Arial', 'B', 16);
$pdf->Cell(0, 10, '   Holiday Inn Express Toluca', 0, 1, 'C');
$pdf->Ln(10);

// Encabezado principal
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(0, 10, 'Comprobante de Pago', 0, 1, 'C');
$pdf->Ln(5);

// Información General en Tabla
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(60, 10, 'Campo', 1, 0, 'C');
$pdf->Cell(130, 10, 'Detalle', 1, 1, 'C');

$pdf->SetFont('Arial', '', 10);
$pdf->Cell(60, 10, 'Banco', 1, 0);
$pdf->Cell(130, 10, 'HSBC', 1, 1);
$pdf->Cell(60, 10, 'Cuenta/No. Acuerdo', 1, 0);
$pdf->Cell(130, 10, 'Holiday Inn Express Toluca', 1, 1);

// Detalles de la Reserva
$pdf->Ln(5);
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(0, 10, 'Detalles de la Reserva', 0, 1);

$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(60, 10, 'Campo', 1, 0, 'C');
$pdf->Cell(130, 10, 'Detalle', 1, 1, 'C');

$pdf->SetFont('Arial', '', 10);
$pdf->Cell(60, 10, 'Numero de Habitacion', 1, 0);
$pdf->Cell(130, 10, $row->roomno, 1, 1);
$pdf->Cell(60, 10, 'Tipo de Habitacion', 1, 0);
$pdf->Cell(130, 10, $room_type, 1, 1);
$pdf->Cell(60, 10, 'Duracion', 1, 0);
$pdf->Cell(130, 10, $row->duration . ' noches', 1, 1);
$pdf->Cell(60, 10, 'Costo Total', 1, 0);
$pdf->Cell(130, 10, (($row->foodstatus == 1) ? (($row->duration * $row->feespm) + (200 * $row->duration)) : ($row->duration * $row->feespm)) . ' MXN', 1, 1);

// Información del Cliente
$pdf->Ln(5);
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(0, 10, 'Informacion del Cliente', 0, 1);

$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(60, 10, 'Campo', 1, 0, 'C');
$pdf->Cell(130, 10, 'Detalle', 1, 1, 'C');

$pdf->SetFont('Arial', '', 10);
$pdf->Cell(60, 10, 'Nombre', 1, 0);
$pdf->Cell(130, 10, $row->firstName . ' ' . $row->middleName . ' ' . $row->lastName, 1, 1);
$pdf->Cell(60, 10, 'Email', 1, 0);
$pdf->Cell(130, 10, $row->emailid, 1, 1);
$pdf->Cell(60, 10, 'Telefono', 1, 0);
$pdf->Cell(130, 10, $row->contactno, 1, 1);
$pdf->Cell(60, 10, 'Codigo de Reserva', 1, 0);
$pdf->Cell(130, 10, $row->codigo_alfanumerico, 1, 1);

// Referencia de Pago
$pdf->Ln(5);
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(0, 10, 'Referencia de Pago', 0, 1);

$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(60, 10, 'Campo', 1, 0, 'C');
$pdf->Cell(130, 10, 'Detalle', 1, 1, 'C');

$pdf->SetFont('Arial', '', 10);
$pdf->Cell(60, 10, 'Referencia de Pago', 1, 0);
$pdf->Cell(130, 10, uniqid(), 1, 1);
$pdf->Cell(60, 10, 'Fecha limite de pago', 1, 0);
$pdf->Cell(130, 10, date('d-m-Y'), 1, 1);
$pdf->Cell(60, 10, 'Monto Total del Pago', 1, 0);
$pdf->Cell(130, 10, (($row->foodstatus == 1) ? (($row->duration * $row->feespm) + (200 * $row->duration)) : ($row->duration * $row->feespm)) . ' MXN', 1, 1);

// Nota
$pdf->Ln(10);
$pdf->SetFont('Arial', '', 9);
$pdf->MultiCell(0, 7, "Estimado usuario, recuerde realizar el pago antes de la fecha limite. Utilice la referencia de pago proporcionada en la transferencia o deposito para evitar inconvenientes. Gracias por su preferencia.");

// Salida del PDF
$pdf->Output('I', 'comprobante_pago.pdf');
?>