<?php

function decode_str($string){
	return iconv('UTF-8', 'windows-1252', $string);
}
if($evote->verifyUser($_SESSION["user"], 0)){
	// Generate and send .CSV file
	header('Content-Type: text/csv; charset=utf-8');
	header('Content-Disposition: attachment; filename=codes.csv');

	$csv_output_stream = fopen('php://output', 'w');

	fputcsv($csv_output_stream, ['Personal code']);

	foreach ($codes as $c) {
		fputcsv($csv_output_stream, [$c]);	# Second parameter must be array
	}
}else{
	echo "Fy! Så får du inte göra.";
}
?>
