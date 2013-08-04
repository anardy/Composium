<?php

$headers = array('Content-Type' => 'application/pdf');
$pdf = new Fpdf();
return Response::make($pdf->Output(), 200, $headers);
	?>