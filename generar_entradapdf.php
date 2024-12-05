<?php
// Desactivar la visualización de errores
error_reporting(0);
ini_set('display_errors', 0);

// Iniciar el buffer de salida para evitar problemas con la salida antes de generar el PDF
ob_start();

// Ruta correcta a fpdf.php
require_once($_SERVER['DOCUMENT_ROOT'] . "/inventario/libs/fpdf/fpdf.php");
include_once($_SERVER['DOCUMENT_ROOT'] . "/inventario/controller/EntradaController.php");
include_once($_SERVER['DOCUMENT_ROOT'] . "/inventario/model/EntradaDetalle.php");

// Obtener el ID de la entrada de la URL
$idEntrada = isset($_GET['idEntrada']) ? $_GET['idEntrada'] : null;

// Verificar si se proporciona ID de Entrada
if (!$idEntrada) {
    die('ID de Entrada no proporcionado.');
}

// Crear instancia de FPDF
$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial', 'B', 16);

// Procesar la información de entrada
$controllerEntrada = new EntradaController();
$controllerEntrada->ConsultarEntradaPerId($idEntrada);

if (!$controllerEntrada->Entrada) {
    die('No se encontró la Entrada con el ID proporcionado.');
}

$entradaDetalle = new EntradaDetalle();
$entradaDetalle->identrada = $idEntrada;
$detallesEntrada = $entradaDetalle->ConsultarDetallesPerIdDetalle();

$pdf->Cell(0, 10, 'Registro de Entrada de Inventario', 0, 1, 'C');
$pdf->Ln(10);

$pdf->SetFont('Arial', '', 12);
$pdf->Cell(50, 10, 'Tipo de Movimiento: ', 0, 0);
$pdf->Cell(0, 10, $controllerEntrada->Entrada->movimiento, 0, 1);
$pdf->Cell(50, 10, 'Fecha de Entrada: ', 0, 0);
$pdf->Cell(0, 10, $controllerEntrada->Entrada->fecha, 0, 1);
$pdf->Cell(50, 10, 'Tipo de Movimiento: ', 0, 0);
$pdf->Cell(0, 10, $controllerEntrada->Entrada->tipomov, 0, 1);


$pdf->Ln(10);
$pdf->SetFont('Arial', 'B', 14);
$pdf->Cell(0, 10, 'Detalle de la Entrada:', 0, 1);

$pdf->SetFont('Arial', '', 12);
$pdf->Cell(50, 10, 'Producto', 1, 0, 'C');
$pdf->Cell(40, 10, 'Cantidad', 1, 0, 'C');
$pdf->Cell(30, 10, 'Precio Unitario', 1, 0, 'C');
$pdf->Cell(50, 10, 'Observaciones', 1, 1, 'C');

foreach ($detallesEntrada as $detalle) {
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
header('Content-Disposition: inline; filename="Entrada_Inventario_' . $idEntrada . '.pdf"');
readfile($tempFile);

// Liberar recursos y eliminar el archivo temporal
unlink($tempFile);
unset($pdf);

// Finalizar el buffer de salida
ob_end_flush();
?>
