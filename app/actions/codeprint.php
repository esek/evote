<?php

function decode_str($string){
	return iconv('UTF-8', 'windows-1252', $string);
}
if($evote->verifyUser($_SESSION["user"], 0)){

	require("../fpdf/fpdf.php");
	$pdf = new FPDF();
	$pdf->AddPage();
	$pdf->SetFont('Courier','B',16);

	$count = 0;
	$instr_per_page = 3;
	$instructions = decode_str(file_get_contents(__DIR__."/../data/code_instr.txt"));
	foreach($codes as $c){
		$count ++;
		$pdf->SetFont('Courier','B',16);
		$title = decode_str(getLocalizedText("E-vote, E-sektionen's voting system")." ".$_SERVER['SERVER_NAME']);
		$pdf->Ln();
		$pdf->Cell(190,10,$title);
		$pdf->Ln();
		$pdf->SetFont('Arial','',8);
		$pdf->Multicell(190, 4, $instructions);
		$pdf->SetFont('Arial','',12);
		$pdf->Ln();
		$pdf->Multicell(190,10,decode_str(getLocalizedText("Your personal code is")), 0, 'C', false);
		$pdf->SetFont('Times','B',16);
		$pdf->SetFillColor(215, 215, 215);
		$pdf->Multicell(190,10,$c, 0, 'C', true);
		$pdf->Ln();
		if($count % $instr_per_page == 0){
			$pdf->AddPage();
		}
	}
	$pdf->Output();
}else{
	echo getLocalizedText("Boo! You are not allowed to do that.");
}
?>
