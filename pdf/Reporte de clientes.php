<?php
	include 'plantilla.php';
	require 'conexion.php';
	
	$query = "SELECT * FROM clientes where rol='cliente'";
	$resultado = $mysqli->query($query);
	
	$pdf = new PDF();
	$pdf->AliasNbPages();
	$pdf->AddPage("L");
	
	// Configuración para los títulos de las celdas
	$pdf->SetFillColor(0, 0, 0);
	$pdf->SetDrawColor(163, 163, 163); // colorBorde
	$pdf->SetTextColor(255, 255, 255); // color de las letras en blanco
	$pdf->SetFont('Arial', 'B', 11);
	$pdf->Cell(40, 10, 'Nombre', 1, 0, 'C', 1);
	$pdf->Cell(50, 10, 'Direccion', 1, 0, 'C', 1);
	$pdf->Cell(30, 10, 'Telefono', 1, 0, 'C', 1);
	$pdf->Cell(70, 10, 'Correo electronico', 1, 0, 'C', 1);
	$pdf->Cell(50, 10, 'Nombre usuario', 1, 0, 'C', 1);
	$pdf->Cell(40, 10, 'Foto', 1, 1, 'C', 1);
	
	// Cambiar color de texto a negro para los datos
	$pdf->SetTextColor(0, 0, 0);
	$pdf->SetFont('Arial', '', 10);
	
	while($row = $resultado->fetch_assoc())
	{
		$pdf->Cell(40, 10, $row['nombre'], 1, 0, 'C');
		$pdf->Cell(50, 10, $row['direccion'], 1, 0, 'C');
		$pdf->Cell(30, 10, $row['telefono'], 1, 0, 'C');
		$pdf->Cell(70, 10, $row['correo_electronico'], 1, 0, 'C');
		$pdf->Cell(50, 10, $row['nombre_usuario'], 1, 0, 'C');
		
		// Verificar si la imagen existe y agregarla al PDF
		if (file_exists($row['foto'])) {
			$pdf->Cell(40, 10, $pdf->Image($row['foto'], $pdf->GetX(), $pdf->GetY(), 10), 1, 1, 'C', 0);
		} else {
			$pdf->Cell(40, 10, 'No Image', 1, 1, 'C');
		}
	}
	
	$pdf->Output();
?>
