<?php
// Desactivar la visualización de errores
error_reporting(0);
ini_set('display_errors', 0);

// Iniciar el buffer de salida para evitar problemas con la salida antes de generar el PDF
ob_start();

// Ruta correcta a fpdf.php
require_once($_SERVER['DOCUMENT_ROOT'] . "/inventario/libs/fpdf/fpdf.php");
include_once($_SERVER['DOCUMENT_ROOT'] . "/inventario/controller/SalidaController.php");
include_once($_SERVER['DOCUMENT_ROOT'] . "/inventario/model/SalidaDetalle.php");

// Obtener el ID de la salida de la URL
$idSalida = isset($_GET['idSalida']) ? $_GET['idSalida'] : null;

// Verificar si se proporciona ID de Salida
if (!$idSalida) {
    die('ID de Salida no proporcionado.');
}

// Crear instancia de FPDF
$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial', 'B', 16);

// Procesar la información de salida
$controllerSalida = new SalidaController();
$controllerSalida->ConsultarSalidaPerId($idSalida);

if (!$controllerSalida->Salida) {
    die('No se encontró la Salida con el ID proporcionado.');
}

$salidaDetalle = new SalidaDetalle();
$salidaDetalle->idsalida = $idSalida;
$detallesSalida = $salidaDetalle->ConsultarDetallesPerIdSalida();

$pdf->Cell(0, 10, 'Registro de Salida de Inventario', 0, 1, 'C');
$pdf->Ln(10);

$pdf->SetFont('Arial', '', 12);
$pdf->Cell(50, 10, 'Tipo de Movimiento: ', 0, 0);
$pdf->Cell(0, 10, $controllerSalida->Salida->movimiento, 0, 1);
$pdf->Cell(50, 10, 'Fecha de Salida: ', 0, 0);
$pdf->Cell(0, 10, $controllerSalida->Salida->fecha, 0, 1);
$pdf->Cell(50, 10, 'Usuario que Registro: ', 0, 0);
$pdf->Cell(0, 10, $controllerSalida->Salida->usuarioregistra, 0, 1);
$pdf->Cell(50, 10, 'Usuario que Asigno: ', 0, 0);
$pdf->Cell(0, 10, $controllerSalida->Salida->usuarioasigna, 0, 1);

$pdf->Ln(10);
$pdf->SetFont('Arial', 'B', 14);
$pdf->Cell(0, 10, 'Detalle de la Salida:', 0, 1);

$pdf->SetFont('Arial', '', 12);
$pdf->Cell(50, 10, 'Producto', 1, 0, 'C');
$pdf->Cell(40, 10, 'Cantidad', 1, 0, 'C');
$pdf->Cell(30, 10, 'Precio Unitario', 1, 0, 'C');
$pdf->Cell(50, 10, 'Observaciones', 1, 1, 'C');

foreach ($detallesSalida as $detalle) {
    $pdf->Cell(50, 10, $detalle['producto'], 1, 0, 'C');
    $pdf->Cell(40, 10, $detalle['cantidad'], 1, 0, 'C');
    $pdf->Cell(30, 10, '$' . number_format($detalle['precio'], 2), 1, 0, 'C');
    $pdf->Cell(50, 10, $detalle['observaciones'], 1, 1, 'C');
}

// Guardar el PDF en un archivo temporal
$tempFile = tempnam(sys_get_temp_dir(), 'pdf');
$pdf->Output('F', $tempFile);

// Encabezados para la descarga del PDF
header('Content-Type: application/pdf');
header('Content-Disposition: inline; filename="Salida_Inventario_' . $idSalida . '.pdf"');
readfile($tempFile);

// Liberar recursos y eliminar el archivo temporal
unlink($tempFile);
unset($pdf);

// Finalizar el buffer de salida
ob_end_flush();
?>
