<?php

require('./fpdf.php');

class PDF extends FPDF
{

   // Cabecera de página
   function Header()
   {
      $conexion = new mysqli("localhost", "root", "", "thomson");

      $consulta_info = $conexion->query(" select *from llenados ");//traemos datos de la empresa desde BD
      $dato_info = $consulta_info->fetch_object();
      $this->Image('logo.png', 185, 5, 20); //logo de la empresa,moverDerecha,moverAbajo,tamañoIMG
      $this->SetFont('Arial', 'B', 19); //tipo fuente, negrita(B-I-U-BIU), tamañoTexto
      $this->Cell(45); // Movernos a la derecha
      $this->SetTextColor(0, 0, 0); //color
      //creamos una celda o fila
      $this->Cell(110, 15, utf8_decode('LLENADO DE BOTELLONES'), 1, 1, 'C', 0); // AnchoCelda,AltoCelda,titulo,borde(1-0),saltoLinea(1-0),posicion(L-C-R),ColorFondo(1-0)
      $this->Ln(3); // Salto de línea
      $this->SetTextColor(103); //color


      /* COREEO */
      $this->Cell(110);  // mover a la derecha
      $this->SetFont('Arial', 'B', 10);
      $this->Cell(85, 10, utf8_decode("Correo : LLENADOSTHOMSON@GMAIL.COM"), 0, 0, '', 0);
      $this->Ln(5);

      /* SUCURSAL */
      $this->Cell(110);  // mover a la derecha
      $this->SetFont('Arial', 'B', 10);
      $this->Cell(85, 10, utf8_decode("Sucursal : Maracaibo "), 0, 0, '', 0);
      $this->Ln(10);

      /* TITULO DE LA TABLA */
      //color
      $this->SetTextColor(228, 100, 0);
      $this->Cell(50); // mover a la derecha
      $this->SetFont('Arial', 'B', 15);
      $this->Cell(100, 10, utf8_decode("REPORTE DE LLENADOS "), 0, 1, 'C', 0);
      $this->Ln(7);

      /* CAMPOS DE LA TABLA */
      //color
      $this->SetFillColor(125, 173, 0); //colorFondo
      $this->SetTextColor(255, 255, 255); //colorTexto
      $this->SetDrawColor(163, 163, 163); //colorBorde
      $this->SetFont('Arial', 'B', 11);
      $this->Cell(18, 10, utf8_decode('N°'), 1, 0, 'C', 1);
      $this->Cell(20, 10, utf8_decode('Cliente'), 1, 0, 'C', 1);
      $this->Cell(30, 10, utf8_decode('Zona'), 1, 0, 'C', 1);
      $this->Cell(25, 10, utf8_decode('Cantidad'), 1, 0, 'C', 1);
      $this->Cell(70, 10, utf8_decode('Fechay hora'), 1, 0, 'C', 1);
      $this->Cell(25, 10, utf8_decode('ESTADO'), 1, 1, 'C', 1);
   }

   // Pie de página
   function Footer()
   {
      $this->SetY(-15); // Posición: a 1,5 cm del final
      $this->SetFont('Arial', 'I', 8); //tipo fuente, negrita(B-I-U-BIU), tamañoTexto
      $this->Cell(0, 10, utf8_decode('Página ') . $this->PageNo() . '/{nb}', 0, 0, 'C'); //pie de pagina(numero de pagina)

      $this->SetY(-15); // Posición: a 1,5 cm del final
      $this->SetFont('Arial', 'I', 8); //tipo fuente, cursiva, tamañoTexto
      $hoy = date('d/m/Y');
      $this->Cell(355, 10, utf8_decode($hoy), 0, 0, 'C'); // pie de pagina(fecha de pagina)
   }
}

$conexion = new mysqli("localhost", "root", "", "thomson");


$pdf = new PDF();
$pdf->AddPage(); /* aqui entran dos para parametros (horientazion,tamaño)V->portrait H->landscape tamaño (A3.A4.A5.letter.legal) */
$pdf->AliasNbPages(); //muestra la pagina / y total de paginas

$i = 0;
$pdf->SetFont('Arial', '', 12);
$pdf->SetDrawColor(163, 163, 163); //colorBorde

$consulta_reporte_llenados = $conexion->query("SELECT llenados.cliente, llenados.zona, llenados.cantidad, llenados.fecha FROM llenados ");

while ($datos_reporte = $consulta_reporte_llenados->fetch_object()) {    
   $i = $i + 1;
/* TABLA */
$pdf->Cell(18, 10, utf8_decode("$i"), 1, 0, 'C', 0);
$pdf->Cell(20, 10, utf8_decode("$datos_reporte->cliente"), 1, 0, 'C', 0);
$pdf->Cell(30, 10, utf8_decode("$datos_reporte->zona"), 1, 0, 'C', 0);
$pdf->Cell(25, 10, utf8_decode("$datos_reporte->cantidad"), 1, 0, 'C', 0);
$pdf->Cell(70, 10, utf8_decode("$datos_reporte->fecha"), 1, 0, 'C', 0);
$pdf->Cell(25, 10, utf8_decode("Atendido"), 1, 1, 'C', 0);
}


$pdf->Output('Prueba.pdf', 'I');//nombreDescarga, Visor(I->visualizar - D->descargar)
