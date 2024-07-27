<?php
	include 'plantilla2.php';
	require 'conexion.php';
	
	$query = "SELECT * FROM  productos";
	$resultado = $mysqli->query($query);
	
	$pdf = new PDF();
	$pdf->AliasNbPages();
	$pdf->AddPage('L');
	
	$pdf->SetFillColor(0, 0, 0);
	$pdf->SetDrawColor(163, 163, 163); // colorBorde
	$pdf->SetTextColor(255, 255, 255); // color de las letras en blanco
    $pdf->SetFont('Arial', 'B', 11);
    $pdf->Cell(40, 10, ('Nombre'), 1, 0, 'C', 1);
    $pdf->Cell(50, 10, ('Cantidad'), 1, 0, 'C', 1);
    $pdf->Cell(50, 10, utf8_decode('Cantidad Mínima'), 1, 0, 'C', 1);
    $pdf->Cell(50, 10, ('Precio'), 1, 0, 'C', 1);
    $pdf->Cell(40, 10, ('Marca'), 1, 0, 'C', 1);
	$pdf->Cell(50, 10, ('Categoria'), 1, 1, 'C', 1);
	
    // Cambiar color de texto a negro para los datos
	$pdf->SetTextColor(0, 0, 0);
	$pdf->SetFont('Arial', '', 10);
	
	while($row = $resultado->fetch_assoc())
	{
		$pdf->Cell(40,10,($row['nombre']), 1, 0, 'C', 0); // Mostrar el nombre del producto en lugar del ID
		$pdf->Cell(50,10,($row['cantidad']), 1, 0, 'C', 0);
		$pdf->Cell(50,10,($row['cantidad_minima']), 1, 0, 'C', 0);
		$pdf->Cell(50,10,($row['precio']), 1, 0, 'C', 0);
		$pdf->Cell(40,10,($row['marca']), 1, 0, 'C', 0);
		$pdf->Cell(50,10,($row['categoria']), 1, 1, 'C', 0);
	}
	$pdf->Output();
?>
