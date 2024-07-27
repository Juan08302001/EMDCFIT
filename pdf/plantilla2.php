<?php
	
	require 'fpdf/fpdf.php';

	class PDF extends FPDF
	{
		function Header()
		{
			$this->Image('../img/Mejor.png', 245, 5, 35); //logo de la empresa,moverDerecha,moverAbajo,tamañoIMG

      		$this->SetFont('Arial', 'B', 19); //tipo fuente, negrita(B-I-U-BIU), tamañoTexto
      		$this->Cell(45); // Movernos a la derecha
      		$this->SetTextColor(0, 0, 0); //color
      		//creamos una celda o fila
      		$this->Cell(180, 15,('Reporte de productos'), 0, 5, 'C', ); // AnchoCelda,AltoCelda,titulo,borde(1-0),saltoLinea(1-0),posicion(L-C-R),ColorFondo(1-0)
      		$this->Ln(3); // Salto de línea
      		$this->SetTextColor(103); //color

      		/* UBICACION */
      		$this->Cell(190);  // mover a la derecha
      		$this->SetFont('Arial', '', 10); // <-- Establecer la fuente y tamaño de letra
      		$this->Cell(96, 10, utf8_decode("Ubicación : Calle ###"), 0, 0, '', 0); // <-- Decodificar texto a UTF-8
      		$this->Ln(5);

      		/* TELEFONO */
      		$this->Cell(190);  // mover a la derecha
      		$this->SetFont('Arial', '', 10); // <-- Establecer la fuente y tamaño de letra
      		$this->Cell(59, 10, utf8_decode("Teléfono : 444 832 2228"), 0, 0, '', 0); // <-- Decodificar texto a UTF-8
      		$this->Ln(5);

      		/* COREO */
      		$this->Cell(190);  // mover a la derecha
      		$this->SetFont('Arial', '', 10); // <-- Establecer la fuente y tamaño de letra
      		$this->Cell(85, 10, utf8_decode("Correo : EMDCFIT@gmail.com"), 0, 0, '', 0); // <-- Decodificar texto a UTF-8
      		$this->Ln(5);

      		

      		/* TITULO DE LA TABLA */
      		//color
      		$this->SetTextColor(0, 0, 0);
      		$this->Cell(100); // mover a la derecha
      		$this->SetFont('Arial', 'B', 15);
      		$this->Cell(80, 10, (""), 0, 1, 'C', 0);
      		$this->Ln(7);

		}
		
		function Footer()
		{
			$this->SetY(-15); // Posición: a 1,5 cm del final
      		$this->SetFont('Arial', 'I', 8); //tipo fuente, negrita(B-I-U-BIU), tamañoTexto
      		$this->Cell(0, 10, utf8_decode('Página ') . $this->PageNo() . '/{nb}', 0, 0, 'C'); //pie de pagina(numero de pagina)

      		$this->SetY(-15); // Posición: a 1,5 cm del final
      		$this->SetFont('Arial', 'I', 8); //tipo fuente, cursiva, tamañoTexto
      		$hoy = date('d/m/Y');
      		$this->Cell(355, 10, ($hoy), 0, 0, 'C'); // pie de pagina(fecha de pagina)
		}		
	}
?>
