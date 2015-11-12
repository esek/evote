<?php
if($evote->verifyUser($_SESSION["user"], 0)){
	require("../fpdf/fpdf.php");
	$pdf = new FPDF();
	$pdf->AddPage();
	$pdf->SetFont('Courier','B',16);
	
	$title = "E-vote - PERSONLIGA KODER";
	$pdf->Cell(190,10,$title);
	$pdf->Ln();
	

	$pdf->SetFont('Courier','',15);
        
	$out = "";
	$lenght = 0;
	$breaklenght = 6;
	$line = "";
	for($i=0;$i<(6+3)*$breaklenght;$i++)
		$line .= "-";
	
	foreach($codes as $c){
		if($lenght >= $breaklenght){
			$out .= "|\n";
			$out .= $line."\n";
			$lenght = 0; 
		}
		$out .= "| ".$c." ";
		$lenght++;
	}
	$out .= "|";
	
	$pdf->Multicell(190,10,$out);
	$pdf->Output();
}else{
	echo "Fy! Så får du inte göra.";
}
?>
